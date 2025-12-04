<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductManagementController extends Controller
{
    public function index()
    {
        $seller = Auth::user()->seller;
        
        if (!$seller) {
            return redirect()->route('seller.register')
                ->with('error', 'Anda belum mendaftar sebagai seller. Silakan daftar terlebih dahulu.');
        }
        
        if ($seller->status === 'pending') {
            return redirect()->route('seller.dashboard')
                ->with('info', 'Toko Anda masih menunggu verifikasi dari admin. Anda belum bisa mengelola produk.');
        }
        
        if ($seller->status === 'rejected') {
            return redirect()->route('seller.dashboard')
                ->with('error', 'Pendaftaran toko Anda ditolak. Silakan hubungi admin untuk informasi lebih lanjut.');
        }

        $products = $seller->products()->with('images')->latest()->paginate(10);

        return view('seller.products.index', compact('products', 'seller'));
    }

    public function create()
    {
        $seller = Auth::user()->seller;
        
        if (!$seller) {
            return redirect()->route('seller.register')
                ->with('error', 'Anda belum mendaftar sebagai seller. Silakan daftar terlebih dahulu.');
        }
        
        if ($seller->status !== 'approved') {
            return redirect()->route('seller.dashboard')
                ->with('error', 'Toko Anda harus diverifikasi terlebih dahulu sebelum bisa menambah produk.');
        }

        $categories = [
            ['name' => 'Fashion', 'slug' => 'fashion'],
            ['name' => 'Alat Kuliah', 'slug' => 'alat-kuliah'],
            ['name' => 'Buku & Alat Tulis', 'slug' => 'buku-alat-tulis'],
            ['name' => 'Elektronik', 'slug' => 'elektronik'],
        ];

        return view('seller.products.create', compact('categories', 'seller'));
    }

    public function store(Request $request)
    {
        $seller = Auth::user()->seller;
        
        if (!$seller || $seller->status !== 'approved') {
            return redirect()->route('products.index')
                ->with('error', 'Anda harus memiliki toko yang sudah diverifikasi.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_slug' => 'required|string',
            'condition' => 'required|in:baru,bekas',
            'size' => 'nullable|string|max:50',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'images' => 'required|array|min:1|max:5',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
            'primary_image' => 'nullable|integer|min:0',
        ]);

        $slug = Str::slug($validated['name']) . '-' . Str::random(6);
        
        $primaryImagePath = null;
        if ($request->hasFile('images') && count($request->file('images')) > 0) {
            $primaryIndex = $request->input('primary_image', 0);
            $files = $request->file('images');
            if (isset($files[$primaryIndex])) {
                $primaryImagePath = $files[$primaryIndex]->store('products', 'public');
            } else {
                $primaryImagePath = $files[0]->store('products', 'public');
            }
        }

        $product = Product::create([
            'seller_id' => $seller->id,
            'name' => $validated['name'],
            'slug' => $slug,
            'category_slug' => $validated['category_slug'],
            'condition' => $validated['condition'],
            'size' => $validated['size'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'description' => $validated['description'],
            'image_url' => $primaryImagePath,
            'seller_name' => $seller->nama_toko,
            'seller_province' => 'Jawa Tengah',
            'seller_city' => $seller->kota,
        ]);

        if ($request->hasFile('images')) {
            $primaryIndex = (int) $request->input('primary_image', 0);
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'is_primary' => $index === $primaryIndex,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('seller.products.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        $seller = Auth::user()->seller;
        
        if (!$seller || $product->seller_id !== $seller->id) {
            return redirect()->route('seller.products.index')
                ->with('error', 'Anda tidak memiliki akses untuk mengedit produk ini.');
        }

        $categories = [
            ['name' => 'Fashion', 'slug' => 'fashion'],
            ['name' => 'Alat Kuliah', 'slug' => 'alat-kuliah'],
            ['name' => 'Buku & Alat Tulis', 'slug' => 'buku-alat-tulis'],
            ['name' => 'Elektronik', 'slug' => 'elektronik'],
        ];

        $product->load('images');

        return view('seller.products.edit', compact('product', 'categories', 'seller'));
    }

    public function update(Request $request, Product $product)
    {
        $seller = Auth::user()->seller;
        
        if (!$seller || $product->seller_id !== $seller->id) {
            return redirect()->route('seller.products.index')
                ->with('error', 'Anda tidak memiliki akses untuk mengupdate produk ini.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_slug' => 'required|string',
            'condition' => 'required|in:baru,bekas',
            'size' => 'nullable|string|max:50',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'images' => 'nullable|array|max:5',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'integer|exists:product_images,id',
            'primary_image' => 'nullable|integer',
        ]);

        $product->update([
            'name' => $validated['name'],
            'category_slug' => $validated['category_slug'],
            'condition' => $validated['condition'],
            'size' => $validated['size'] ?? null,
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'description' => $validated['description'],
        ]);

        if ($request->has('delete_images')) {
            foreach ($request->input('delete_images') as $imageId) {
                $image = ProductImage::where('id', $imageId)->where('product_id', $product->id)->first();
                if ($image) {
                    Storage::disk('public')->delete($image->image_path);
                    $image->delete();
                }
            }
        }

        if ($request->hasFile('images')) {
            $existingCount = $product->images()->count();
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'is_primary' => false,
                    'sort_order' => $existingCount + $index,
                ]);
            }
        }

        if ($request->has('primary_image')) {
            $primaryId = (int) $request->input('primary_image');
            $product->images()->update(['is_primary' => false]);
            $primaryImage = $product->images()->where('id', $primaryId)->first();
            if ($primaryImage) {
                $primaryImage->update(['is_primary' => true]);
                $product->update(['image_url' => $primaryImage->image_path]);
            }
        } else {
            $firstImage = $product->images()->orderBy('sort_order')->first();
            if ($firstImage && !$product->images()->where('is_primary', true)->exists()) {
                $firstImage->update(['is_primary' => true]);
                $product->update(['image_url' => $firstImage->image_path]);
            }
        }

        return redirect()->route('seller.products.index')
            ->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy(Product $product)
    {
        $seller = Auth::user()->seller;
        
        if (!$seller || $product->seller_id !== $seller->id) {
            return redirect()->route('seller.products.index')
                ->with('error', 'Anda tidak memiliki akses untuk menghapus produk ini.');
        }

        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        if ($product->image_url) {
            Storage::disk('public')->delete($product->image_url);
        }

        $product->delete();

        return redirect()->route('seller.products.index')
            ->with('success', 'Produk berhasil dihapus!');
    }
}
