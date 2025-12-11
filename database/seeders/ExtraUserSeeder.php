<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Seller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ExtraUserSeeder extends Seeder
{
    public function run(): void
    {
        $this->createReviewers(); // Create some random users to be reviewers
        $this->createLowProductUser();
        $this->createHighProductUser();
    }

    private $reviewers = [];

    private function createReviewers()
    {
        for ($i = 1; $i <= 5; $i++) {
            $email = "reviewer{$i}@kampustore.com";
            $user = User::where('email', $email)->first();
            if (!$user) {
                $user = User::create([
                    'name' => "Reviewer {$i}",
                    'email' => $email,
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ]);
            }
            $this->reviewers[] = $user;
        }
    }

    private function createLowProductUser()
    {
        $email = 'low@kampustore.com';

        // Cleanup if exists
        $existing = User::where('email', $email)->first();
        if ($existing) {
            $existing->delete(); // Cascades should handle seller/products, but we re-create
        }

        $user = User::create([
            'name' => 'Low Product User',
            'email' => $email,
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        $seller = Seller::create([
            'user_id' => $user->id,
            'nama_toko' => 'Low Stock Shop',
            'deskripsi_singkat' => 'Toko dengan sedikit produk',
            'nama_pic' => 'Low User',
            'no_hp_pic' => '081234567890',
            'email_pic' => $email,
            'alamat_pic' => 'Jl. Low Product No. 1',
            'kota' => 'Kota Semarang',
            'kode_pos' => '50275',
            'status' => 'approved',
        ]);

        $this->createProduct($seller, 1, true); // Force review for low user
        $this->command->info("Created user {$email} with 1 product and reviews.");
    }

    private function createHighProductUser()
    {
        $email = 'high@kampustore.com';

        // Cleanup if exists
        $existing = User::where('email', $email)->first();
        if ($existing) {
            $existing->delete();
        }

        $user = User::create([
            'name' => 'High Product User',
            'email' => $email,
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        $seller = Seller::create([
            'user_id' => $user->id,
            'nama_toko' => 'Mega Store',
            'deskripsi_singkat' => 'Toko dengan BANYAK produk',
            'nama_pic' => 'High User',
            'no_hp_pic' => '081234567899',
            'email_pic' => $email,
            'alamat_pic' => 'Jl. High Product No. 99',
            'kota' => 'Kota Semarang',
            'kode_pos' => '50275',
            'status' => 'approved',
        ]);

        // Create 12 products
        for ($i = 1; $i <= 12; $i++) {
            $this->createProduct($seller, $i, rand(0, 1)); // Randomly add reviews
        }
        $this->command->info("Created user {$email} with 12 products and random reviews.");
    }

    private function createProduct($seller, $index, $addReviews = false)
    {
        $name = "Produk {$seller->nama_toko} #{$index}";
        $slug = Str::slug($name) . '-' . uniqid();

        $product = Product::create([
            'seller_id' => $seller->id,
            'name' => $name,
            'slug' => $slug,
            'category_slug' => 'alat-kuliah', // Default category
            'condition' => 'baru',
            'price' => rand(10000, 500000),
            'stock' => rand(5, 50),
            'seller_name' => $seller->nama_toko,
            'seller_province' => 'Jawa Tengah',
            'seller_city' => $seller->kota,
            'image_url' => 'https://via.placeholder.com/600x400?text=' . urlencode($name),
            'description' => "Deskripsi untuk {$name}. Produk berkualitas dari {$seller->nama_toko}.",
        ]);

        ProductImage::create([
            'product_id' => $product->id,
            'image_path' => $product->image_url,
            'is_primary' => true,
            'sort_order' => 0,
        ]);

        if ($addReviews && !empty($this->reviewers)) {
            $count = rand(1, 3);
            for ($k = 0; $k < $count; $k++) {
                $reviewer = $this->reviewers[array_rand($this->reviewers)];

                // Check if already reviewed
                $exists = DB::table('reviews')
                    ->where('user_id', $reviewer->id)
                    ->where('product_id', $product->id)
                    ->exists();

                if (!$exists) {
                    DB::table('reviews')->insert([
                        'user_id' => $reviewer->id,
                        'product_id' => $product->id,
                        'rating' => rand(4, 5), // Mostly good ratings
                        'body' => 'Produk sangat bagus, sesuai deskripsi!',
                        'guest_province' => 'Jawa Tengah',
                        'guest_city' => 'Kota Semarang',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
