<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductImagesSeeder extends Seeder
{
    public function run(): void
    {
        echo "\n🖼️  Populating Product Images Table...\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";

        // Clear existing product images
        ProductImage::truncate();

        // Mapping produk ke gambar-gambarnya (by product ID)
        $productImages = [
            1 => [ // Pulpen Pilot
                '/images/products/pulpen-pilot.jpg',
                '/images/products/pulpen-pilot-2.jpg',
                '/images/products/pulpen-pilot-3.jpg',
                '/images/products/pulpen-pilot-4.jpg',
            ],
            2 => [ // Buku Grid
                '/images/products/buku-grid.jpg',
                '/images/products/buku-grid-2.jpg',
                '/images/products/buku-grid-3.jpg',
                '/images/products/buku-grid-4.jpg',
            ],
            3 => [ // Sticky Notes
                '/images/products/sticky-notes.jpg',
                '/images/products/sticky-notes-2.jpg',
                '/images/products/sticky-notes-3.jpg',
                '/images/products/sticky-notes-4.jpg',
            ],
            4 => [ // Penghapus
                '/images/products/penghapus.jpg',
                '/images/products/penghapus-2.jpg',
                '/images/products/penghapus-3.jpg',
                '/images/products/penghapus-4.jpg',
            ],
            5 => [ // Kalkulator
                '/images/products/kalkulator-casio.jpg',
                '/images/products/kalkulator-casio-2.jpg',
                '/images/products/kalkulator-casio-3.jpg',
                '/images/products/kalkulator-casio-4.jpg',
            ],
            6 => [ // Mouse
                '/images/products/mouse-logitech.jpg',
                '/images/products/mouse-logitech-2.jpg',
                '/images/products/mouse-logitech-3.jpg',
                '/images/products/mouse-logitech-4.jpg',
            ],
            7 => [ // Headphone
                '/images/products/headphone-gaming.jpg',
                '/images/products/headphone-gaming-2.jpg',
                '/images/products/headphone-gaming-3.jpg',
                '/images/products/headphone-gaming-4.jpg',
            ],
            8 => [ // Flashdisk
                '/images/products/flashdisk.jpg',
                '/images/products/flashdisk-2.jpg',
                '/images/products/flashdisk-3.jpg',
                '/images/products/flashdisk-4.jpg',
            ],
            9 => [ // Buku Algoritma
                '/images/products/buku-algoritma.jpg',
                '/images/products/buku-algoritma-2.jpg',
                '/images/products/buku-algoritma-3.jpg',
                '/images/products/buku-algoritma-4.jpg',
            ],
            10 => [ // Buku Calculus
                '/images/products/buku-calculus.jpg',
                '/images/products/buku-calculus-2.jpg',
                '/images/products/buku-calculus-3.jpg',
                '/images/products/buku-calculus-4.jpg',
            ],
            11 => [ // Binder
                '/images/products/binder.jpg',
                '/images/products/binder-2.jpg',
                '/images/products/binder-3.jpg',
                '/images/products/binder-4.jpg',
            ],
            12 => [ // Hoodie
                '/images/products/hoodie.jpg',
                '/images/products/hoodie-2.jpg',
                '/images/products/hoodie-3.jpg',
                '/images/products/hoodie-4.jpg',
            ],
            13 => [ // Jaket HMIF
                '/images/products/jaket-hmif.jpg',
                '/images/products/jaket-hmif-2.jpg',
                '/images/products/jaket-hmif-3.jpg',
                '/images/products/jaket-hmif-4.jpg',
            ],
            14 => [ // Tas Laptop
                '/images/products/tas-laptop.jpg',
                '/images/products/tas-laptop-2.jpg',
                '/images/products/tas-laptop-3.jpg',
                '/images/products/tas-laptop-4.jpg',
            ],
            15 => [ // Laptop
                '/images/products/laptop-asus.jpg',
                '/images/products/laptop-asus-2.jpg',
                '/images/products/laptop-asus-3.jpg',
                '/images/products/laptop-asus-4.jpg',
            ],
            16 => [ // Keyboard
                '/images/products/keyboard.jpg',
                '/images/products/keyboard-2.jpg',
                '/images/products/keyboard-3.jpg',
                '/images/products/keyboard-4.jpg',
            ],
            17 => [ // Webcam
                '/images/products/webcam.jpg',
                '/images/products/webcam-2.jpg',
                '/images/products/webcam-3.jpg',
                '/images/products/webcam-4.jpg',
            ],
        ];

        $totalImages = 0;
        $productsFound = 0;

        foreach ($productImages as $productId => $images) {
            $product = Product::find($productId);
            
            if (!$product) {
                echo "  ⚠️  Product not found with ID: {$productId}\n";
                continue;
            }

            $productsFound++;
            echo "\n📦 {$product->name}:\n";

            foreach ($images as $index => $imagePath) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $imagePath,
                    'is_primary' => $index === 0, // First image is primary
                    'sort_order' => $index,
                ]);
                
                $totalImages++;
                $label = $index === 0 ? '(Primary)' : '';
                echo "  ✓ Image " . ($index + 1) . " {$label}: {$imagePath}\n";
            }
        }

        echo "\n✅ Successfully populated {$totalImages} images for {$productsFound} products!\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    }
}
