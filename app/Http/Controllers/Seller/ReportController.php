<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StockExport;
use App\Exports\StockByRatingExport;
use App\Exports\RestockExport;

class ReportController extends Controller
{
    /**
     * Display list of available reports
     */
    public function index(Request $request)
    {
        $seller = Auth::user()->seller;

        if (!$seller || $seller->status !== 'approved') {
            return redirect()->route('seller.dashboard')
                ->with('error', 'Anda harus memiliki toko yang sudah diverifikasi.');
        }

        return view('Seller.reports.index', compact('seller'));
    }

    /**
     * Laporan Daftar Produk Berdasarkan Stock (DESCENDING)
     */
    public function stock(Request $request)
    {
        $seller = Auth::user()->seller;
        
        if (!$seller || $seller->status !== 'approved') {
            return redirect()->route('seller.dashboard')
                ->with('error', 'Anda harus memiliki toko yang sudah diverifikasi.');
        }

        // SRS-12: Diurutkan berdasarkan stock secara MENURUN (desc)
        $products = Product::select(
                'products.id',
                'products.seller_id',
                'products.name',
                'products.description',
                'products.price',
                'products.stock',
                'products.category_slug',
                'products.image_url',
                'products.created_at',
                'products.updated_at',
                DB::raw('COALESCE(AVG(reviews.rating), 0) as avg_rating')
            )
            ->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
            ->where('products.seller_id', $seller->id)
            ->groupBy(
                'products.id',
                'products.seller_id',
                'products.name',
                'products.description',
                'products.price',
                'products.stock',
                'products.category_slug',
                'products.image_url',
                'products.created_at',
                'products.updated_at'
            )
            ->orderBy('products.stock', 'desc')
            ->get();

        return view('seller.reports.stock', compact('products', 'seller'));
    }

    /**
     * SRS-MartPlace-13: Laporan Daftar Produk Berdasarkan Rating
     */
    public function rating(Request $request)
    {
        $seller = Auth::user()->seller;
        
        if (!$seller || $seller->status !== 'approved') {
            return redirect()->route('seller.dashboard')
                ->with('error', 'Anda harus memiliki toko yang sudah diverifikasi.');
        }

        $products = Product::select(
                'products.id',
                'products.seller_id',
                'products.name',
                'products.description',
                'products.price',
                'products.stock',
                'products.category_slug',
                'products.image_url',
                'products.created_at',
                'products.updated_at',
                DB::raw('COALESCE(AVG(reviews.rating), 0) as avg_rating'),
                DB::raw('COUNT(reviews.id) as review_count')
            )
            ->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
            ->where('products.seller_id', $seller->id)
            ->groupBy(
                'products.id',
                'products.seller_id',
                'products.name',
                'products.description',
                'products.price',
                'products.stock',
                'products.category_slug',
                'products.image_url',
                'products.created_at',
                'products.updated_at'
            )
            ->orderBy('avg_rating', 'desc')
            ->get();

        return view('seller.reports.rating', compact('products', 'seller'));
    }

    /**
     * SRS-MartPlace-14: Laporan Daftar Produk Segera Dipesan (Restock)
     * Threshold default: stock < 2 sesuai SRS
     * Urutan: berdasarkan kategori dan produk alfabetis
     */
    public function restock(Request $request)
    {
        $seller = Auth::user()->seller;
        
        if (!$seller || $seller->status !== 'approved') {
            return redirect()->route('seller.dashboard')
                ->with('error', 'Anda harus memiliki toko yang sudah diverifikasi.');
        }

        // SRS-14: Default threshold adalah 2 (stock < 2)
        $threshold = $request->get('threshold', 2);

        // Total semua produk toko
        $totalProducts = Product::where('seller_id', $seller->id)->count();

        // SRS-14: Urutan berdasarkan kategori dan produk alfabetis
        $products = Product::where('seller_id', $seller->id)
            ->where('stock', '<', $threshold)
            ->orderBy('category_slug', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        return view('seller.reports.restock', compact('products', 'seller', 'threshold', 'totalProducts'));
    }

    /**
     * Export Methods PDF (SRS-12, 13, 14)
     */
    public function exportStock(Request $request)
    {
        $seller = Auth::user()->seller;
        
        if (!$seller || $seller->status !== 'approved') {
            return redirect()->route('seller.dashboard')
                ->with('error', 'Anda harus memiliki toko yang sudah diverifikasi.');
        }

        // SRS-12: Diurutkan berdasarkan stock secara MENURUN (desc)
        $products = Product::select(
                'products.id',
                'products.seller_id',
                'products.name',
                'products.description',
                'products.price',
                'products.stock',
                'products.category_slug',
                'products.image_url',
                'products.created_at',
                'products.updated_at',
                DB::raw('COALESCE(AVG(reviews.rating), 0) as avg_rating')
            )
            ->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
            ->where('products.seller_id', $seller->id)
            ->groupBy(
                'products.id',
                'products.seller_id',
                'products.name',
                'products.description',
                'products.price',
                'products.stock',
                'products.category_slug',
                'products.image_url',
                'products.created_at',
                'products.updated_at'
            )
            ->orderBy('products.stock', 'desc')
            ->get();

        $pdf = Pdf::loadView('pdf.seller-stock-professional', [
            'title' => 'LAPORAN DAFTAR PRODUK BERDASARKAN STOCK',
            'products' => $products,
            'seller' => $seller,
            'user' => auth()->user()->name ?? $seller->nama_pic,
            'generatedDate' => now(),
        ]);

        return $pdf->download('Laporan_Daftar_Produk_Stock_' . date('Y-m-d') . '.pdf');
    }

    public function exportRating(Request $request)
    {
        $seller = Auth::user()->seller;
        
        if (!$seller || $seller->status !== 'approved') {
            return redirect()->route('seller.dashboard')
                ->with('error', 'Anda harus memiliki toko yang sudah diverifikasi.');
        }

        // SRS-13: Diurutkan berdasarkan rating secara MENURUN
        $products = Product::select(
                'products.id',
                'products.seller_id',
                'products.name',
                'products.description',
                'products.price',
                'products.stock',
                'products.category_slug',
                'products.image_url',
                'products.created_at',
                'products.updated_at',
                DB::raw('COALESCE(AVG(reviews.rating), 0) as avg_rating'),
                DB::raw('COUNT(reviews.id) as review_count')
            )
            ->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
            ->where('products.seller_id', $seller->id)
            ->groupBy(
                'products.id',
                'products.seller_id',
                'products.name',
                'products.description',
                'products.price',
                'products.stock',
                'products.category_slug',
                'products.image_url',
                'products.created_at',
                'products.updated_at'
            )
            ->orderBy('avg_rating', 'desc')
            ->get();

        $pdf = Pdf::loadView('pdf.seller-rating-professional', [
            'title' => 'LAPORAN DAFTAR PRODUK BERDASARKAN RATING',
            'products' => $products,
            'seller' => $seller,
            'user' => auth()->user()->name ?? $seller->nama_pic,
            'generatedDate' => now(),
        ]);

        return $pdf->download('Laporan_Daftar_Produk_Rating_' . date('Y-m-d') . '.pdf');
    }

    public function exportRestock(Request $request)
    {
        $seller = Auth::user()->seller;
        
        if (!$seller || $seller->status !== 'approved') {
            return redirect()->route('seller.dashboard')
                ->with('error', 'Anda harus memiliki toko yang sudah diverifikasi.');
        }

        // SRS-14: Default threshold adalah 2 (stock < 2)
        $threshold = $request->get('threshold', 2);

        // SRS-14: Urutan berdasarkan kategori dan produk alfabetis
        $products = Product::where('seller_id', $seller->id)
            ->where('stock', '<', $threshold)
            ->orderBy('category_slug', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        $pdf = Pdf::loadView('pdf.seller-restock-professional', [
            'title' => 'LAPORAN DAFTAR PRODUK SEGERA DIPESAN',
            'products' => $products,
            'seller' => $seller,
            'threshold' => $threshold,
            'user' => auth()->user()->name ?? $seller->nama_pic,
            'generatedDate' => now(),
        ]);

        return $pdf->download('Laporan_Produk_Segera_Dipesan_' . date('Y-m-d') . '.pdf');
    }
}
