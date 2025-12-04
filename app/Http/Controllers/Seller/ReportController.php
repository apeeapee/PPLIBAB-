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
     * SRS-MartPlace-12: Laporan Daftar Produk Berdasarkan Stock (DESCENDING)
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

        $products = Product::where('seller_id', $seller->id)
            ->where('stock', '<', $threshold)
            ->orderBy('stock', 'asc')
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

        $filename = 'Laporan_Stok_Produk_' . preg_replace('/[^A-Za-z0-9]/', '_', $seller->nama_toko) . '_' . date('Y-m-d') . '.xlsx';
        return Excel::download(new StockExport($request), $filename);
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

        $filename = 'Laporan_Rating_Produk_' . preg_replace('/[^A-Za-z0-9]/', '_', $seller->nama_toko) . '_' . date('Y-m-d') . '.xlsx';
        return Excel::download(new StockByRatingExport(), $filename);
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

        $products = Product::where('seller_id', $seller->id)
            ->where('stock', '<', $threshold)
            ->orderBy('stock', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        $pdf = Pdf::loadView('pdf.seller-restock', [
            'title' => 'Laporan Produk Perlu Restock',
            'products' => $products,
            'seller' => $seller,
            'threshold' => $threshold,
        ]);

        $filename = 'Laporan_Restock_' . preg_replace('/[^A-Za-z0-9]/', '_', $seller->nama_toko) . '_' . date('Y-m-d') . '.xlsx';
        return Excel::download(new RestockExport(), $filename);
    }
}
