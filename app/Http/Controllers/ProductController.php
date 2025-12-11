<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        // Get filter parameters from request
        $cats = (array) $request->input('cat', []);
        $cond = $request->input('cond', []);
        $sizes = $request->input('sizes', []);
        $priceMin = (float) $request->input('pmin', 0);
        $priceMax = (float) $request->input('pmax', 0);
        $ratingMin = (float) $request->input('rating_min', 0);
        $inStock = (bool) $request->input('in_stock', false);
        $selProvinsi = $request->input('provinsi', '');
        $selKota = $request->input('kota', '');
        $selKecamatan = $request->input('kecamatan', '');
        $selKelurahan = $request->input('kelurahan', '');
        $sellerLocation = $request->input('seller_location', '');
        $allCats = [
            ['name' => 'Fashion', 'slug' => 'fashion'],
            ['name' => 'Elektronik', 'slug' => 'elektronik'],
            ['name' => 'Buku', 'slug' => 'buku'],
            ['name' => 'Alat Tulis', 'slug' => 'alat-tulis'],
            ['name' => 'Alat Kuliah', 'slug' => 'alat-kuliah'],
        ];

        // Initial Query
        $query = Product::with(['seller.user'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews');

        // Search Scope (Name, Store Name, Category, Location) - case insensitive
        if ($q) {
            $searchTerm = '%' . strtolower($q) . '%';
            // Normalize for category slug (spaces to dashes)
            $searchTermSlug = '%' . strtolower(str_replace(' ', '-', $q)) . '%';

            $query->where(function ($sub) use ($searchTerm, $searchTermSlug) {
                $sub->whereRaw('LOWER(name) LIKE ?', [$searchTerm])
                    ->orWhereRaw('LOWER(description) LIKE ?', [$searchTerm])
                    ->orWhereRaw('LOWER(category_slug) LIKE ?', [$searchTerm])
                    ->orWhereRaw('LOWER(category_slug) LIKE ?', [$searchTermSlug])
                    ->orWhereHas('seller', function ($s) use ($searchTerm) {
                        $s->whereRaw('LOWER(nama_toko) LIKE ?', [$searchTerm])
                            ->orWhereRaw('LOWER(provinsi) LIKE ?', [$searchTerm])
                            ->orWhereRaw('LOWER(kota) LIKE ?', [$searchTerm]);
                    });
            });
        }

        // Category Scope
        if (!empty($cats)) {
            $query->whereIn('category_slug', $cats);
        }

        // Condition Scope
        if (!empty($cond)) {
            $query->whereIn('condition', $cond);
        }

        // Size Scope
        if (!empty($sizes)) {
            $query->whereIn('size', $sizes);
        }

        // Price Scope
        if ($priceMin > 0) {
            $query->where('price', '>=', $priceMin);
        }
        if ($priceMax > 0) {
            $query->where('price', '<=', $priceMax);
        }

        // Rating Scope
        if ($ratingMin > 0) {
            $query->having('reviews_avg_rating', '>=', $ratingMin);
        }

        // Stock Scope
        if ($inStock) {
            $query->where('stock', '>', 0);
        }

        // Location Scope (case-insensitive matching)
        if ($selProvinsi) {
            $query->whereHas('seller', function ($q) use ($selProvinsi) {
                $q->whereRaw('LOWER(provinsi) LIKE ?', ['%' . strtolower($selProvinsi) . '%']);
            });
        }
        if ($selKota) {
            $query->whereHas('seller', function ($q) use ($selKota) {
                $q->whereRaw('LOWER(kota) LIKE ?', ['%' . strtolower($selKota) . '%']);
            });
        }
        if ($selKecamatan) {
            $query->whereHas('seller', function ($q) use ($selKecamatan) {
                $q->whereRaw('LOWER(kecamatan) LIKE ?', ['%' . strtolower($selKecamatan) . '%']);
            });
        }
        if ($selKelurahan) {
            $query->whereHas('seller', function ($q) use ($selKelurahan) {
                $q->whereRaw('LOWER(kelurahan) LIKE ?', ['%' . strtolower($selKelurahan) . '%']);
            });
        }

        $products = $query->latest()->paginate(12);

        return view('products.index', [
            'products' => $products,
            'q' => $q,
            'allCats' => $allCats,
            'cats' => $cats,
            'cond' => $cond,
            'sizes' => $sizes,
            'priceMin' => $priceMin,
            'priceMax' => $priceMax,
            'ratingMin' => $ratingMin,
            'inStock' => $inStock,
            'selProvinsi' => $selProvinsi,
            'selKota' => $selKota,
            'selKecamatan' => $selKecamatan,
            'selKelurahan' => $selKelurahan,
            'sellerLocation' => $sellerLocation,
        ]);
    }

    public function show(Product $product)
    {
        $product->load(['reviews.user']);

        $avg = round($product->reviews()->avg('rating') ?? 0, 1);
        $count = $product->reviews()->count();

        // Get product images
        $images = $product->images()->orderBy('sort_order')->get();

        // Pre-calculate image display variables
        $showImages = $images->count() > 0;
        $hasMultipleImages = $images->count() > 1;
        $showFallback = !$showImages && $product->image_url;
        $showPlaceholder = !$showImages && !$product->image_url;

        // Check if current user is the seller of this product
        $isSeller = Auth::check()
            && Auth::user()->seller
            && $product->seller_id === Auth::user()->seller->id;

        return view('products.show', compact('product', 'avg', 'count', 'isSeller', 'images', 'showImages', 'hasMultipleImages', 'showFallback', 'showPlaceholder'));
    }
}
