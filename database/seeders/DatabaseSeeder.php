<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Generate product images first
        $this->call([
            GenerateProductImages::class,
        ]);
        
        // Seed Admin terlebih dahulu
        $this->call([
            AdminSeeder::class,
            ProductSeeder::class,
        ]);
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Sample products
        if (Product::query()->count() === 0) {
            $samples = [
                [
                    'name' => 'Kemeja Oxford Pria',
                    'slug' => 'kemeja-oxford-pria',
                    'price' => 149000,
                    'stock' => 23,
                    'image_url' => 'https://via.placeholder.com/600x400?text=Kemeja+Oxford',
                    'description' => 'Kemeja bahan oxford halus, nyaman dipakai sehari-hari.',
                ],
                [
                    'name' => 'Sepatu Sneakers Putih',
                    'slug' => 'sepatu-sneakers-putih',
                    'price' => 299000,
                    'stock' => 12,
                    'image_url' => 'https://via.placeholder.com/600x400?text=Sneakers+Putih',
                    'description' => 'Sneakers putih minimalis, cocok untuk santai ataupun semi-formal.',
                ],
                [
                    'name' => 'Tas Ransel Canvas',
                    'slug' => 'tas-ransel-canvas',
                    'price' => 199000,
                    'stock' => 8,
                    'image_url' => 'https://via.placeholder.com/600x400?text=Tas+Canvas',
                    'description' => 'Ransel bahan canvas tahan lama, banyak kompartemen.',
                ],
            ];

            foreach ($samples as $s) {
                Product::create($s);
            }
        }
    }
}
