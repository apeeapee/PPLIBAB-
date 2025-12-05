<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Seller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Review;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RealDataSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Clear existing data
        Review::truncate();
        ProductImage::truncate();
        Product::truncate();
        Seller::truncate();
        User::where('is_admin', 0)->delete();
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        echo "\n🏪 Creating Real Sellers with Approved Stores...\n";
        
        // Data Seller Real dengan Toko Approved
        $sellers = [
            [
                'user' => [
                    'name' => 'Budi Santoso',
                    'email' => 'budi.santoso@undip.ac.id',
                    'password' => Hash::make('password123'),
                ],
                'seller' => [
                    'nama_toko' => 'Budi Stationery',
                    'deskripsi_singkat' => 'Toko alat tulis dan perlengkapan kuliah',
                    'nama_pic' => 'Budi Santoso',
                    'no_hp_pic' => '081234567890',
                    'no_ktp_pic' => '3374012345678901',
                    'email_pic' => 'budi.santoso@undip.ac.id',
                    'alamat_pic' => 'Jl. Prof. Soedarto No. 12',
                    'kecamatan' => 'Tembalang',
                    'provinsi' => 'Jawa Tengah',
                    'kota' => 'Semarang',
                    'kode_pos' => '50275',
                    'status' => 'approved',
                ],
            ],
            [
                'user' => [
                    'name' => 'Siti Nurhaliza',
                    'email' => 'siti.nurhaliza@undip.ac.id',
                    'password' => Hash::make('password123'),
                ],
                'seller' => [
                    'nama_toko' => 'Siti Electronics',
                    'deskripsi_singkat' => 'Elektronik dan gadget mahasiswa',
                    'nama_pic' => 'Siti Nurhaliza',
                    'no_hp_pic' => '082345678901',
                    'no_ktp_pic' => '3374023456789012',
                    'email_pic' => 'siti.nurhaliza@undip.ac.id',
                    'alamat_pic' => 'Jl. Banjarsari Utara No. 45',
                    'kecamatan' => 'Banyumanik',
                    'provinsi' => 'Jawa Tengah',
                    'kota' => 'Semarang',
                    'kode_pos' => '50269',
                    'status' => 'approved',
                ],
            ],
            [
                'user' => [
                    'name' => 'Andi Wijaya',
                    'email' => 'andi.wijaya@undip.ac.id',
                    'password' => Hash::make('password123'),
                ],
                'seller' => [
                    'nama_toko' => 'Andi Book Store',
                    'deskripsi_singkat' => 'Buku kuliah dan literature',
                    'nama_pic' => 'Andi Wijaya',
                    'no_hp_pic' => '083456789012',
                    'no_ktp_pic' => '3273034567890123',
                    'email_pic' => 'andi.wijaya@undip.ac.id',
                    'alamat_pic' => 'Jl. Dipatiukur No. 89',
                    'kecamatan' => 'Coblong',
                    'provinsi' => 'Jawa Barat',
                    'kota' => 'Bandung',
                    'kode_pos' => '40132',
                    'status' => 'approved',
                ],
            ],
            [
                'user' => [
                    'name' => 'Dewi Lestari',
                    'email' => 'dewi.lestari@undip.ac.id',
                    'password' => Hash::make('password123'),
                ],
                'seller' => [
                    'nama_toko' => 'Dewi Fashion',
                    'deskripsi_singkat' => 'Fashion dan merchandise kampus',
                    'nama_pic' => 'Dewi Lestari',
                    'no_hp_pic' => '084567890123',
                    'no_ktp_pic' => '3404045678901234',
                    'email_pic' => 'dewi.lestari@undip.ac.id',
                    'alamat_pic' => 'Jl. Kaliurang KM 14',
                    'kecamatan' => 'Sleman',
                    'provinsi' => 'DI Yogyakarta',
                    'kota' => 'Yogyakarta',
                    'kode_pos' => '55281',
                    'status' => 'approved',
                ],
            ],
            [
                'user' => [
                    'name' => 'Rudi Hartono',
                    'email' => 'rudi.hartono@undip.ac.id',
                    'password' => Hash::make('password123'),
                ],
                'seller' => [
                    'nama_toko' => 'Rudi Gadget',
                    'deskripsi_singkat' => 'Laptop dan aksesoris gaming',
                    'nama_pic' => 'Rudi Hartono',
                    'no_hp_pic' => '085678901234',
                    'no_ktp_pic' => '3578056789012345',
                    'email_pic' => 'rudi.hartono@undip.ac.id',
                    'alamat_pic' => 'Jl. Raya Gubeng No. 67',
                    'kecamatan' => 'Gubeng',
                    'provinsi' => 'Jawa Timur',
                    'kota' => 'Surabaya',
                    'kode_pos' => '60281',
                    'status' => 'approved',
                ],
            ],
        ];

        $sellerModels = [];
        foreach ($sellers as $sellerData) {
            $user = User::create($sellerData['user']);
            $seller = Seller::create(array_merge($sellerData['seller'], ['user_id' => $user->id]));
            $sellerModels[] = $seller;
            echo "✅ Created seller: {$seller->nama_toko}\n";
        }

        echo "\n📦 Creating Real Products...\n";

        // Data Produk Real
        $products = [
            // Budi Stationery Products
            [
                'seller_id' => $sellerModels[0]->id,
                'name' => 'Pulpen Pilot G2 0.5mm - Pack 12 pcs',
                'category_slug' => 'alat-tulis',
                'condition' => 'baru',
                'price' => 45000,
                'stock' => 50,
                'brand' => 'Pilot',
                'image_url' => '/images/products/pulpen-pilot.jpg',
                'description' => 'Pulpen gel import kualitas premium. Tinta smooth, tidak mudah luntur. Cocok untuk ujian dan tugas kuliah.',
            ],
            [
                'seller_id' => $sellerModels[0]->id,
                'name' => 'Buku Catatan Grid A5 80 Lembar',
                'category_slug' => 'alat-tulis',
                'condition' => 'baru',
                'price' => 15000,
                'stock' => 100,
                'image_url' => '/images/products/buku-grid.jpg',
                'description' => 'Buku catatan grid A5 dengan kertas 80gsm. Sangat cocok untuk catatan kuliah matematika dan engineering.',
            ],
            [
                'seller_id' => $sellerModels[0]->id,
                'name' => 'Sticky Notes Warna-Warni 100 Lembar',
                'category_slug' => 'alat-tulis',
                'condition' => 'baru',
                'price' => 8000,
                'stock' => 150,
                'image_url' => '/images/products/sticky-notes.jpg',
                'description' => 'Sticky notes dengan 5 warna berbeda. Perekat kuat dan mudah dilepas tanpa meninggalkan bekas.',
            ],
            [
                'seller_id' => $sellerModels[0]->id,
                'name' => 'Penghapus Faber Castell',
                'category_slug' => 'alat-tulis',
                'condition' => 'baru',
                'price' => 3000,
                'stock' => 200,
                'brand' => 'Faber Castell',
                'image_url' => '/images/products/penghapus.jpg',
                'description' => 'Penghapus berkualitas yang tidak merusak kertas. Menghapus bersih tanpa noda.',
            ],

            // Siti Electronics Products
            [
                'seller_id' => $sellerModels[1]->id,
                'name' => 'Kalkulator Scientific Casio FX-991ID Plus',
                'category_slug' => 'elektronik',
                'condition' => 'baru',
                'price' => 285000,
                'stock' => 30,
                'brand' => 'Casio',
                'image_url' => '/images/products/kalkulator-casio.jpg',
                'description' => 'Kalkulator scientific original Casio dengan 552 fungsi. Wajib untuk mahasiswa engineering, matematika, dan statistik.',
            ],
            [
                'seller_id' => $sellerModels[1]->id,
                'name' => 'Mouse Wireless Logitech M171',
                'category_slug' => 'elektronik',
                'condition' => 'baru',
                'price' => 75000,
                'stock' => 45,
                'brand' => 'Logitech',
                'image_url' => '/images/products/mouse-logitech.jpg',
                'description' => 'Mouse wireless ergonomis dengan daya tahan baterai hingga 12 bulan. Cocok untuk mahasiswa IT.',
            ],
            [
                'seller_id' => $sellerModels[1]->id,
                'name' => 'Headphone Gaming RGB LED',
                'category_slug' => 'elektronik',
                'condition' => 'baru',
                'price' => 125000,
                'stock' => 25,
                'image_url' => '/images/products/headphone-gaming.jpg',
                'description' => 'Headphone gaming dengan RGB LED, mic noise cancelling, dan bass yang powerful. Nyaman dipakai lama.',
            ],
            [
                'seller_id' => $sellerModels[1]->id,
                'name' => 'Flashdisk SanDisk 32GB USB 3.0',
                'category_slug' => 'elektronik',
                'condition' => 'baru',
                'price' => 65000,
                'stock' => 60,
                'brand' => 'SanDisk',
                'image_url' => '/images/products/flashdisk.jpg',
                'description' => 'Flashdisk original SanDisk dengan transfer speed tinggi. Cocok untuk backup tugas dan project kuliah.',
            ],

            // Andi Book Store Products
            [
                'seller_id' => $sellerModels[2]->id,
                'name' => 'Buku Algoritma dan Struktur Data (2nd Edition)',
                'category_slug' => 'buku',
                'condition' => 'bekas',
                'price' => 80000,
                'stock' => 10,
                'image_url' => '/images/products/buku-algoritma.jpg',
                'description' => 'Buku bekas kondisi 90%. Materi lengkap dan mudah dipahami. Cocok untuk mahasiswa informatika.',
            ],
            [
                'seller_id' => $sellerModels[2]->id,
                'name' => 'Buku Calculus Anton 10th Edition',
                'category_slug' => 'buku',
                'condition' => 'bekas',
                'price' => 120000,
                'stock' => 5,
                'brand' => 'Anton',
                'image_url' => '/images/products/buku-calculus.jpg',
                'description' => 'Buku Calculus klasik kondisi 85%. Sedikit coretan pensil di beberapa halaman. Masih sangat layak pakai.',
            ],
            [
                'seller_id' => $sellerModels[2]->id,
                'name' => 'Binder A4 Tebal 4 cm',
                'category_slug' => 'alat-tulis',
                'condition' => 'baru',
                'price' => 25000,
                'stock' => 40,
                'image_url' => '/images/products/binder.jpg',
                'description' => 'Binder A4 dengan ring kuat dan penutup rapi. Cocok untuk menyimpan catatan kuliah per semester.',
            ],

            // Dewi Fashion Products
            [
                'seller_id' => $sellerModels[3]->id,
                'name' => 'Hoodie Kampus Unisex Premium',
                'category_slug' => 'fashion',
                'condition' => 'baru',
                'size' => 'M/L/XL',
                'price' => 95000,
                'stock' => 35,
                'image_url' => '/images/products/hoodie.jpg',
                'description' => 'Hoodie kampus dengan bahan fleece premium. Hangat, nyaman, dan stylish. Tersedia ukuran M, L, XL.',
            ],
            [
                'seller_id' => $sellerModels[3]->id,
                'name' => 'Jaket Himpunan (HMIF) - Informatika',
                'category_slug' => 'fashion',
                'condition' => 'baru',
                'size' => 'L/XL',
                'price' => 150000,
                'stock' => 20,
                'image_url' => '/images/products/jaket-hmif.jpg',
                'description' => 'Jaket resmi himpunan Informatika. Bahan parasut waterproof dengan bordir logo. Limited edition.',
            ],
            [
                'seller_id' => $sellerModels[3]->id,
                'name' => 'Tas Ransel Laptop 15.6 inch Anti Air',
                'category_slug' => 'fashion',
                'condition' => 'baru',
                'price' => 175000,
                'stock' => 25,
                'image_url' => '/images/products/tas-laptop.jpg',
                'description' => 'Tas ransel dengan kompartemen laptop hingga 15.6 inch. Material anti air dan banyak kantong. Cocok untuk kuliah.',
            ],

            // Rudi Gadget Products
            [
                'seller_id' => $sellerModels[4]->id,
                'name' => 'Laptop Second Asus VivoBook Core i3',
                'category_slug' => 'elektronik',
                'condition' => 'bekas',
                'price' => 3500000,
                'stock' => 3,
                'brand' => 'Asus',
                'image_url' => '/images/products/laptop-asus.jpg',
                'description' => 'Laptop second like new. Core i3 Gen 10, RAM 8GB, SSD 256GB. Cocok untuk kuliah online dan coding.',
            ],
            [
                'seller_id' => $sellerModels[4]->id,
                'name' => 'Keyboard Mechanical RGB Gaming',
                'category_slug' => 'elektronik',
                'condition' => 'baru',
                'price' => 250000,
                'stock' => 15,
                'image_url' => '/images/products/keyboard.jpg',
                'description' => 'Keyboard mechanical dengan switch blue. RGB backlight, anti-ghosting. Nyaman untuk coding dan gaming.',
            ],
            [
                'seller_id' => $sellerModels[4]->id,
                'name' => 'Webcam HD 1080p dengan Microphone',
                'category_slug' => 'elektronik',
                'condition' => 'baru',
                'price' => 185000,
                'stock' => 20,
                'image_url' => '/images/products/webcam.jpg',
                'description' => 'Webcam HD 1080p dengan mic noise cancelling. Perfect untuk kuliah online, zoom meeting, dan presentasi.',
            ],
        ];

        $productModels = [];
        foreach ($products as $productData) {
            $productData['slug'] = Str::slug($productData['name']) . '-' . strtoupper(Str::random(6));
            $product = Product::create($productData);
            $productModels[] = $product;
            echo "✅ Created product: {$product->name}\n";
        }

        echo "\n⭐ Creating Real Reviews...\n";

        // Data Review Real dari berbagai provinsi
        $reviews = [
            // Reviews for Pulpen Pilot
            ['product_id' => $productModels[0]->id, 'rating' => 5, 'body' => 'Pulpennya smooth banget! Enak buat nulis lama-lama', 'guest_name' => 'Ahmad Rizki', 'guest_province' => 'Jawa Tengah'],
            ['product_id' => $productModels[0]->id, 'rating' => 5, 'body' => 'Original dan berkualitas. Packing rapi, pengiriman cepat', 'guest_name' => 'Maya Sari', 'guest_province' => 'Jawa Barat'],
            ['product_id' => $productModels[0]->id, 'rating' => 4, 'body' => 'Bagus sih tapi agak mahal ya. Tapi worth it lah', 'guest_name' => 'Bimo Aditya', 'guest_province' => 'DI Yogyakarta'],

            // Reviews for Buku Grid
            ['product_id' => $productModels[1]->id, 'rating' => 5, 'body' => 'Kertas tebal, gridnya rapi. Cocok buat ngerjain soal matematika', 'guest_name' => 'Sinta Dewi', 'guest_province' => 'Jawa Tengah'],
            ['product_id' => $productModels[1]->id, 'rating' => 5, 'body' => 'Harga murah tapi kualitas oke. Rekomended!', 'guest_name' => 'Farhan Maulana', 'guest_province' => 'Jawa Timur'],

            // Reviews for Kalkulator Casio
            ['product_id' => $productModels[4]->id, 'rating' => 5, 'body' => 'Kalkulator original Casio. Fiturnya lengkap banget, wajib punya mahasiswa teknik!', 'guest_name' => 'Dani Pratama', 'guest_province' => 'Jawa Tengah'],
            ['product_id' => $productModels[4]->id, 'rating' => 5, 'body' => 'Fast respon seller, barang original bergaransi. Mantap!', 'guest_name' => 'Linda Wijaya', 'guest_province' => 'Banten'],
            ['product_id' => $productModels[4]->id, 'rating' => 4, 'body' => 'Bagus dan ori. Cuma harganya agak mahal dikit', 'guest_name' => 'Eko Setiawan', 'guest_province' => 'Jawa Barat'],
            ['product_id' => $productModels[4]->id, 'rating' => 5, 'body' => 'Puas banget! Buat ujian calculus jadi lebih mudah', 'guest_name' => 'Rani Safitri', 'guest_province' => 'DI Yogyakarta'],

            // Reviews for Mouse Logitech
            ['product_id' => $productModels[5]->id, 'rating' => 5, 'body' => 'Mouse enak dipake, responsenya bagus. Batre awet banget', 'guest_name' => 'Yoga Pratama', 'guest_province' => 'Jawa Timur'],
            ['product_id' => $productModels[5]->id, 'rating' => 4, 'body' => 'Bagus tapi kadang delay dikit. Overall oke sih', 'guest_name' => 'Dinda Ayu', 'guest_province' => 'Jawa Tengah'],

            // Reviews for Headphone Gaming
            ['product_id' => $productModels[6]->id, 'rating' => 5, 'body' => 'Suara jernih, bass mantap! RGB nya keren bgt', 'guest_name' => 'Rizal Gaming', 'guest_province' => 'Jawa Timur'],
            ['product_id' => $productModels[6]->id, 'rating' => 5, 'body' => 'Worth it banget buat harga segini. Mic nya juga clear', 'guest_name' => 'Putri Nabila', 'guest_province' => 'Banten'],
            ['product_id' => $productModels[6]->id, 'rating' => 4, 'body' => 'Bagus cuma agak berat kalo dipake lama. But still good', 'guest_name' => 'Arif Budiman', 'guest_province' => 'Jawa Barat'],

            // Reviews for Buku Algoritma
            ['product_id' => $productModels[8]->id, 'rating' => 5, 'body' => 'Buku kondisi masih bagus banget! Materinya lengkap, cocok buat belajar', 'guest_name' => 'Fauzan Malik', 'guest_province' => 'Jawa Barat'],
            ['product_id' => $productModels[8]->id, 'rating' => 4, 'body' => 'Oke lah buat buku bekas. Ada coretan dikit tapi masih bisa dibaca', 'guest_name' => 'Nisa Amalia', 'guest_province' => 'DI Yogyakarta'],

            // Reviews for Hoodie
            ['product_id' => $productModels[11]->id, 'rating' => 5, 'body' => 'Bahannya premium banget! Adem dan nyaman dipake', 'guest_name' => 'Galih Pratama', 'guest_province' => 'DI Yogyakarta'],
            ['product_id' => $productModels[11]->id, 'rating' => 5, 'body' => 'Size pas, model keren. Recomended seller!', 'guest_name' => 'Intan Permata', 'guest_province' => 'Jawa Tengah'],
            ['product_id' => $productModels[11]->id, 'rating' => 5, 'body' => 'Hoodie favorite! Cocok buat kuliah atau jalan-jalan', 'guest_name' => 'Bayu Saputra', 'guest_province' => 'Jawa Timur'],

            // Reviews for Jaket HMIF
            ['product_id' => $productModels[12]->id, 'rating' => 5, 'body' => 'Jaket himpunan keren! Bordir rapih, bahan waterproof beneran', 'guest_name' => 'Rizky IF', 'guest_province' => 'Jawa Tengah'],
            ['product_id' => $productModels[12]->id, 'rating' => 5, 'body' => 'Limited edition mantap! Bangga pake jaket ini', 'guest_name' => 'Sarah Informatika', 'guest_province' => 'Jawa Barat'],

            // Reviews for Laptop
            ['product_id' => $productModels[14]->id, 'rating' => 5, 'body' => 'Laptop second tapi kondisi like new! Performa oke buat coding', 'guest_name' => 'Fikri Programmer', 'guest_province' => 'Jawa Timur'],
            ['product_id' => $productModels[14]->id, 'rating' => 4, 'body' => 'Bagus tapi ada sedikit goresan di body. Tapi performa mantap!', 'guest_name' => 'Lia Kusuma', 'guest_province' => 'Banten'],

            // Reviews for Keyboard
            ['product_id' => $productModels[15]->id, 'rating' => 5, 'body' => 'Mechanical keyboard terbaik! Typing jadi lebih enak', 'guest_name' => 'Hendra Coder', 'guest_province' => 'Jawa Timur'],
            ['product_id' => $productModels[15]->id, 'rating' => 5, 'body' => 'RGB nya keren, suara klik klik nya memuaskan haha', 'guest_name' => 'Dea Anastasia', 'guest_province' => 'DI Yogyakarta'],

            // Reviews for Webcam
            ['product_id' => $productModels[16]->id, 'rating' => 5, 'body' => 'Webcam HD jernih banget! Cocok buat zoom kuliah', 'guest_name' => 'Toni Hermawan', 'guest_province' => 'Jawa Barat'],
            ['product_id' => $productModels[16]->id, 'rating' => 4, 'body' => 'Bagus tapi mic nya kurang loud. Gambarnya clear kok', 'guest_name' => 'Vina Maulida', 'guest_province' => 'Jawa Tengah'],
        ];

        foreach ($reviews as $reviewData) {
            Review::create($reviewData);
        }

        echo "✅ Created " . count($reviews) . " reviews\n";

        echo "\n✨ Real data seeding completed!\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        echo "📊 Summary:\n";
        echo "   • Sellers: " . count($sellerModels) . " approved stores\n";
        echo "   • Products: " . count($productModels) . " real products\n";
        echo "   • Reviews: " . count($reviews) . " customer reviews\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    }
}
