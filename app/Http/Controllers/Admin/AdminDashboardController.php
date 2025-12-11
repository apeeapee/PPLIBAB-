<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Data seller status untuk SRS-MartPlace-07: jumlah pengguna penjual aktif dan tidak aktif
        $pending = Seller::where('status', 'pending')->count();
        $approved = Seller::where('status', 'approved')->count(); // Aktif
        $rejected = Seller::where('status', 'rejected')->count(); // Tidak aktif

        $total = $pending + $approved + $rejected;

        if ($total > 0) {
            $pPct = round(($pending / $total) * 100);
            $aPct = round(($approved / $total) * 100);
            $rPct = round(($rejected / $total) * 100);
        } else {
            $pPct = $aPct = $rPct = 0;
        }

        // SRS-MartPlace-07: Sebaran jumlah produk per kategori
        $productsByCategory = Product::select('category_slug', DB::raw('count(*) as total'))
            ->groupBy('category_slug')
            ->orderBy('total', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'category' => ucfirst(str_replace('-', ' ', $item->category_slug)),
                    'slug' => $item->category_slug,
                    'total' => $item->total,
                ];
            });

        // SRS-MartPlace-07: Sebaran jumlah toko per lokasi provinsi
        $sellersByProvince = Seller::select('provinsi', DB::raw('count(*) as total'))
            ->where('status', 'approved')
            ->whereNotNull('provinsi')
            ->groupBy('provinsi')
            ->orderBy('total', 'desc')
            ->get();

        // SRS-MartPlace-07: Jumlah pengunjung yang memberikan komentar dan rating
        $totalReviews = Review::count();

        // Menghitung unique reviewer dengan lebih baik
        $guestReviewers = Review::whereNull('user_id')
            ->whereNotNull('guest_email')
            ->distinct('guest_email')
            ->count('guest_email');

        $userReviewers = Review::whereNotNull('user_id')
            ->whereHas('user') // Fix Ghost Users (SRS 7)
            ->distinct('user_id')
            ->count('user_id');

        $uniqueReviewers = $guestReviewers + $userReviewers;

        // Total produk
        $totalProducts = Product::count();

        // SRS-MartPlace-08: Stock Distribution (In Stock vs Out of Stock)
        $stockDistribution = [
            'in_stock' => Product::where('stock', '>', 0)->count(),
            'out_of_stock' => Product::where('stock', '<=', 0)->count(),
        ];

        // SRS-MartPlace-08: Sebaran pemberi rating berdasarkan lokasi provinsi
        // Gabungkan guest_province dengan lokasi user (seller)
        $guestRatings = Review::select('guest_province as province', DB::raw('count(*) as total'), DB::raw('avg(rating) as avg_rating'))
            ->whereNotNull('guest_province')
            ->groupBy('guest_province');

        $userRatings = Review::select('sellers.provinsi as province', DB::raw('count(reviews.id) as total'), DB::raw('avg(reviews.rating) as avg_rating'))
            ->join('users', 'reviews.user_id', '=', 'users.id')
            ->join('sellers', 'users.id', '=', 'sellers.user_id') // Asumsi user adalah seller untuk mendapat lokasi
            ->whereNotNull('sellers.provinsi')
            ->groupBy('sellers.provinsi');

        // Union dan simplifikasi (karena Laravel union builder agak terbatas untuk grouping ulang hasil union, kita ambil collection)
        // Pendekatan: Ambil raw data lalu map di PHP untuk simplifikasi

        // Alternative: Separate collections and merge
        $gRes = $guestRatings->get();
        $uRes = $userRatings->get();

        $mergedRatings = $gRes->concat($uRes)->groupBy('province')->map(function ($group) {
            $total = $group->sum('total');
            $avg = $group->sum(function ($item) {
                return $item->avg_rating * $item->total;
            }) / ($total ?: 1);
            return [
                'province' => $group[0]['province'], // $group->first()['province']
                'total' => $total,
                'avg_rating' => round($avg, 1),
            ];
        })->sortByDesc('total'); // Sort by total

        $ratingsByProvince = $mergedRatings;

        // SRS-MartPlace-08: Sebaran nilai rating (1-5 bintang)
        $ratingDistribution = Review::select('rating', DB::raw('count(*) as total'))
            ->groupBy('rating')
            ->orderBy('rating', 'asc')
            ->get()
            ->map(function ($item) {
                return [
                    'rating' => $item->rating,
                    'total' => $item->total,
                ];
            });

        // Top rated products
        $topRatedProducts = Product::select(
            'products.id',
            'products.name',
            'products.seller_name',
            'products.price',
            'products.image_url',
            DB::raw('AVG(reviews.rating) as avg_rating'),
            DB::raw('COUNT(reviews.id) as review_count')
        )
            ->leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
            ->groupBy('products.id', 'products.name', 'products.seller_name', 'products.price', 'products.image_url')
            ->having('review_count', '>', 0)
            ->orderBy('avg_rating', 'desc')
            ->orderBy('review_count', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'pending',
            'approved',
            'rejected',
            'total',
            'pPct',
            'aPct',
            'rPct',
            'productsByCategory',
            'sellersByProvince',
            'totalReviews',
            'uniqueReviewers',
            'guestReviewers',
            'userReviewers',
            'totalProducts',
            'ratingsByProvince',
            'ratingDistribution',
            'topRatedProducts',
            'stockDistribution'
        ));
    }
}
