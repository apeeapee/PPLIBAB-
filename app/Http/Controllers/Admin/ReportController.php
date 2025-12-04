<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SellersExport;
use App\Exports\SellersByLocationExport;
use App\Exports\ProductRankingExport;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    /**
     * Report Index - Landing page for all reports
     */
    public function index()
    {
        return view('Admin.reports.index');
    }

    /**
     * SRS-09: Laporan Daftar Akun Penjual
     */
    public function sellers(Request $request)
    {
        $query = Seller::with('user');

        // Filter by search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_toko', 'like', "%{$search}%")
                  ->orWhere('nama_pic', 'like', "%{$search}%")
                  ->orWhere('email_pic', 'like', "%{$search}%")
                  ->orWhere('no_hp_pic', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->has('date_from') && $request->date_from != '') {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to != '') {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Sorting
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'name_asc':
                $query->orderBy('nama_toko', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('nama_toko', 'desc');
                break;
            default: // newest
                $query->orderBy('created_at', 'desc');
                break;
        }

        $sellers = $query->get();

        return view('Admin.reports.sellers', compact('sellers'));
    }

    /**
     * SRS-10: Laporan Daftar Penjual per Lokasi Provinsi
     */
    public function sellersByLocation(Request $request)
    {
        // SRS-10: Hardcode group by provinsi
        $groupBy = 'provinsi';

        $sellersByLocation = Seller::select($groupBy, DB::raw('count(*) as total'))
            ->where('status', 'approved')
            ->whereNotNull($groupBy)
            ->groupBy($groupBy)
            ->orderBy('total', 'desc')
            ->get();

        // Detail penjual per lokasi
        $selectedLocation = $request->get('location');
        $sellersDetail = null;
        if ($selectedLocation) {
            $sellersDetail = Seller::where('status', 'approved')
                ->where($groupBy, $selectedLocation)
                ->orderBy('nama_toko')
                ->get();
        }

        $totalSellers = Seller::where('status', 'approved')->count();

        return view('Admin.reports.sellers-by-location', compact('sellersByLocation', 'totalSellers', 'groupBy', 'sellersDetail', 'selectedLocation'));
    }

    /**
     * SRS-11: Laporan Peringkat Produk
     */
    public function productRanking(Request $request)
    {
        $limit = $request->get('limit', 50);
        $category = $request->get('category', null);
        $search = $request->get('search', null);
        $sort = $request->get('sort', 'rating_desc');

        $query = Product::select(
                'products.id',
                'products.name',
                'products.price',
                'products.stock',
                'products.image_url',
                'products.category_slug',
                'products.seller_id',
                'sellers.nama_toko',
                DB::raw('COALESCE(AVG(reviews.rating), 0) as avg_rating'),
                DB::raw('COUNT(reviews.id) as review_count')
            )
            ->join('sellers', 'products.seller_id', '=', 'sellers.id')
            ->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
            ->groupBy('products.id', 'products.name', 'products.price', 'products.stock', 'products.image_url', 'products.category_slug', 'products.seller_id', 'sellers.nama_toko');

        // Filter by category
        if ($category) {
            $query->where('products.category_slug', $category);
        }

        // Filter by search
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('products.name', 'like', "%{$search}%")
                  ->orWhere('sellers.nama_toko', 'like', "%{$search}%");
            });
        }

        // Sorting
        switch ($sort) {
            case 'rating_asc':
                $query->orderBy('avg_rating', 'asc')->orderBy('review_count', 'asc');
                break;
            case 'name_asc':
                $query->orderBy('products.name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('products.name', 'desc');
                break;
            case 'price_asc':
                $query->orderBy('products.price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('products.price', 'desc');
                break;
            default: // rating_desc
                $query->orderBy('avg_rating', 'desc')->orderBy('review_count', 'desc');
                break;
        }

        $products = $query->limit($limit)->get();

        $categories = Product::select('category_slug')->distinct()->pluck('category_slug');

        return view('Admin.reports.product-ranking', compact('products', 'categories', 'limit', 'category'));
    }

    /**
     * Export Methods - PDF
     */
    public function exportSellersPDF(Request $request)
    {
        $query = Seller::with('user');

        // Filter by search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_toko', 'like', "%{$search}%")
                  ->orWhere('nama_pic', 'like', "%{$search}%")
                  ->orWhere('email_pic', 'like', "%{$search}%")
                  ->orWhere('no_hp_pic', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->has('date_from') && $request->date_from != '') {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to != '') {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Sorting
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'name_asc':
                $query->orderBy('nama_toko', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('nama_toko', 'desc');
                break;
            default: // newest
                $query->orderBy('created_at', 'desc');
                break;
        }

        $sellers = $query->get();

        $pdf = Pdf::loadView('pdf.sellers-professional', [
            'title' => 'LAPORAN DAFTAR AKUN PENJUAL AKTIF DAN TIDAK AKTIF',
            'sellers' => $sellers,
            'user' => auth()->user()->name ?? 'Admin',
            'reportType' => 'Daftar Akun Penjual Aktif dan Tidak Aktif',
            'reportNumber' => 'RPT-SEL-' . date('Ymd-His'),
            'generatedDate' => now(),
        ]);

        $pdf->setPaper('A4', 'landscape');
        
        $filename = 'Laporan_Daftar_Akun_Penjual_' . date('Y-m-d_His') . '.pdf';
        
        return response()->streamDownload(function() use ($pdf) {
            echo $pdf->output();
        }, $filename, [
            'Content-Type' => 'application/pdf',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0'
        ]);
    }

    public function exportSellersByLocationPDF(Request $request)
    {
        // Hardcode group by provinsi
        $groupBy = 'provinsi';

        $sellersByLocation = Seller::select($groupBy, DB::raw('count(*) as total'))
            ->where('status', 'approved')
            ->whereNotNull($groupBy)
            ->groupBy($groupBy)
            ->orderBy('total', 'desc')
            ->get();

        $selectedLocation = $request->get('location');
        $sellersDetail = null;
        if ($selectedLocation) {
            $sellersDetail = Seller::where('status', 'approved')
                ->where($groupBy, $selectedLocation)
                ->orderBy('nama_toko')
                ->get();
        }

        $totalSellers = Seller::where('status', 'approved')->count();

        $pdf = Pdf::loadView('pdf.sellers-by-location-professional', [
            'title' => 'LAPORAN DAFTAR PENJUAL (TOKO) UNTUK SETIAP LOKASI PROVINSI',
            'sellersByLocation' => $sellersByLocation,
            'totalSellers' => $totalSellers,
            'groupBy' => $groupBy,
            'sellersDetail' => $sellersDetail,
            'selectedLocation' => $selectedLocation,
            'user' => auth()->user()->name ?? 'Admin',
            'reportType' => 'Daftar Penjual per Lokasi',
            'reportNumber' => 'RPT-LOC-' . date('Ymd-His'),
            'generatedDate' => now(),
        ]);

        return $pdf->download('Laporan_Penjual_Per_Provinsi_' . date('Y-m-d') . '.pdf');
    }

    public function exportProductRankingPDF(Request $request)
    {
        $limit = $request->get('limit', 50);
        $category = $request->get('category', null);
        $search = $request->get('search', null);
        $sort = $request->get('sort', 'rating_desc');

        $query = Product::select(
                'products.id',
                'products.name',
                'products.price',
                'products.stock',
                'products.image_url',
                'products.category_slug',
                'products.seller_id',
                'sellers.nama_toko',
                'sellers.provinsi as seller_province',
                DB::raw('COALESCE(AVG(reviews.rating), 0) as avg_rating'),
                DB::raw('COUNT(reviews.id) as review_count')
            )
            ->join('sellers', 'products.seller_id', '=', 'sellers.id')
            ->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
            ->groupBy('products.id', 'products.name', 'products.price', 'products.stock', 'products.image_url', 'products.category_slug', 'products.seller_id', 'sellers.nama_toko', 'sellers.provinsi');

        // Filter by category
        if ($category) {
            $query->where('products.category_slug', $category);
        }

        // Filter by search
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('products.name', 'like', "%{$search}%")
                  ->orWhere('sellers.nama_toko', 'like', "%{$search}%");
            });
        }

        // Sorting
        switch ($sort) {
            case 'rating_asc':
                $query->orderBy('avg_rating', 'asc')->orderBy('review_count', 'asc');
                break;
            case 'name_asc':
                $query->orderBy('products.name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('products.name', 'desc');
                break;
            case 'price_asc':
                $query->orderBy('products.price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('products.price', 'desc');
                break;
            default: // rating_desc
                $query->orderBy('avg_rating', 'desc')->orderBy('review_count', 'desc');
                break;
        }

        $products = $query->limit($limit)->get();

        $pdf = Pdf::loadView('pdf.product-ranking-professional', [
            'title' => 'LAPORAN DAFTAR PRODUK DAN RATING YANG DIURUTKAN BERDASARKAN RATING SECARA MENURUN',
            'products' => $products,
            'category' => $category,
            'user' => auth()->user()->name ?? 'Admin',
            'reportType' => 'Daftar Produk Berdasarkan Rating',
            'reportNumber' => 'RPT-PROD-' . date('Ymd-His'),
            'generatedDate' => now(),
        ]);

        return $pdf->download('Laporan_Daftar_Produk_Rating_' . date('Y-m-d') . '.pdf');
    }

    public function ratingByProvince(Request $request)
    {
        $province = $request->get('province', null);

        // Query untuk rating berdasarkan provinsi
        $query = Review::select(
                'guest_province',
                DB::raw('COUNT(*) as total_reviews'),
                DB::raw('AVG(rating) as avg_rating'),
                DB::raw('COUNT(DISTINCT COALESCE(user_id, guest_email)) as unique_reviewers'),
                DB::raw('COUNT(CASE WHEN rating >= 4 THEN 1 END) as positive_reviews'),
                DB::raw('COUNT(CASE WHEN rating <= 2 THEN 1 END) as negative_reviews')
            )
            ->whereNotNull('guest_province')
            ->groupBy('guest_province')
            ->orderBy('avg_rating', 'desc')
            ->orderBy('total_reviews', 'desc');

        if ($province) {
            $query->where('guest_province', $province);
        }

        $ratingByProvince = $query->get();

        // Detail review per provinsi jika dipilih
        $provinceDetails = null;
        if ($province) {
            $provinceDetails = Review::where('guest_province', $province)
                ->with(['product', 'product.seller'])
                ->orderBy('created_at', 'desc')
                ->get();
        }

        // Statistik keseluruhan
        $totalReviewsByProvince = Review::whereNotNull('guest_province')->count();
        $avgRatingByProvince = Review::whereNotNull('guest_province')->avg('rating');
        $totalProvinces = Review::whereNotNull('guest_province')->distinct('guest_province')->count('guest_province');

        return view('Admin.reports.rating-by-province', compact(
            'ratingByProvince',
            'province',
            'provinceDetails',
            'totalReviewsByProvince',
            'avgRatingByProvince',
            'totalProvinces'
        ));
    }

    /**
     * Export PDF Rating Berdasarkan Provinsi
     */
    public function exportRatingByProvince(Request $request)
    {
        $province = $request->get('province', null);

        $query = Review::select(
                'guest_province',
                DB::raw('COUNT(*) as total_reviews'),
                DB::raw('AVG(rating) as avg_rating'),
                DB::raw('COUNT(DISTINCT COALESCE(user_id, guest_email)) as unique_reviewers'),
                DB::raw('COUNT(CASE WHEN rating >= 4 THEN 1 END) as positive_reviews'),
                DB::raw('COUNT(CASE WHEN rating <= 2 THEN 1 END) as negative_reviews')
            )
            ->whereNotNull('guest_province')
            ->groupBy('guest_province')
            ->orderBy('avg_rating', 'desc')
            ->orderBy('total_reviews', 'desc');

        if ($province) {
            $query->where('guest_province', $province);
        }

        $ratingByProvince = $query->get();

        $provinceDetails = null;
        if ($province) {
            $provinceDetails = Review::where('guest_province', $province)
                ->with(['product', 'product.seller'])
                ->orderBy('created_at', 'desc')
                ->get();
        }

        $totalReviewsByProvince = Review::whereNotNull('guest_province')->count();
        $avgRatingByProvince = Review::whereNotNull('guest_province')->avg('rating');
        $totalProvinces = Review::whereNotNull('guest_province')->distinct('guest_province')->count('guest_province');

        $pdf = Pdf::loadView('pdf.rating-by-province', [
            'title' => $province ? "Laporan Rating Provinsi: {$province}" : 'Laporan Rating per Provinsi',
            'ratingByProvince' => $ratingByProvince,
            'province' => $province,
            'provinceDetails' => $provinceDetails,
            'totalReviewsByProvince' => $totalReviewsByProvince,
            'avgRatingByProvince' => $avgRatingByProvince,
            'totalProvinces' => $totalProvinces,
        ]);

        $filename = $province ?
            'Laporan_Rating_Provinsi_' . str_replace(' ', '_', $province) . '_' . date('Y-m-d') . '.pdf' :
            'Laporan_Rating_Provinsi_' . date('Y-m-d') . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Export Methods - Excel
     */
    public function exportSellersExcel(Request $request)
    {
        $filename = 'Laporan_Daftar_Akun_Penjual_' . date('Y-m-d_His') . '.xlsx';
        return Excel::download(new SellersExport($request), $filename);
    }

    public function exportSellersByLocationExcel(Request $request)
    {
        $filename = 'Laporan_Penjual_Per_Lokasi_' . date('Y-m-d_His') . '.xlsx';
        return Excel::download(new SellersByLocationExport($request), $filename);
    }

    public function exportProductRankingExcel(Request $request)
    {
        $filename = 'Laporan_Peringkat_Produk_' . date('Y-m-d_His') . '.xlsx';
        return Excel::download(new ProductRankingExport($request), $filename);
    }
}
