<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GenerateMultipleProductImages extends Seeder
{
    public function run(): void
    {
        echo "\n🎨 Generating Multiple Product Images (5 variants per product)...\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";

        $imagesPath = public_path('images/products');
        
        // Create directory if not exists
        if (!is_dir($imagesPath)) {
            mkdir($imagesPath, 0755, true);
        }

        // Product images configuration
        $products = [
            ['name' => 'pulpen-pilot', 'text' => 'PULPEN PILOT', 'color' => [30, 58, 138]], // blue
            ['name' => 'buku-grid', 'text' => 'BUKU GRID', 'color' => [124, 58, 237]], // purple
            ['name' => 'sticky-notes', 'text' => 'STICKY NOTES', 'color' => [251, 191, 36]], // yellow
            ['name' => 'penghapus', 'text' => 'PENGHAPUS', 'color' => [239, 68, 68]], // red
            ['name' => 'kalkulator-casio', 'text' => 'KALKULATOR', 'color' => [16, 185, 129]], // green
            ['name' => 'mouse-logitech', 'text' => 'MOUSE', 'color' => [59, 130, 246]], // blue
            ['name' => 'headphone-gaming', 'text' => 'HEADPHONE', 'color' => [139, 92, 246]], // violet
            ['name' => 'flashdisk', 'text' => 'FLASHDISK', 'color' => [236, 72, 153]], // pink
            ['name' => 'buku-algoritma', 'text' => 'ALGORITMA', 'color' => [245, 158, 11]], // amber
            ['name' => 'buku-calculus', 'text' => 'CALCULUS', 'color' => [20, 184, 166]], // teal
            ['name' => 'binder', 'text' => 'BINDER', 'color' => [168, 85, 247]], // purple
            ['name' => 'hoodie', 'text' => 'HOODIE', 'color' => [14, 165, 233]], // sky
            ['name' => 'jaket-hmif', 'text' => 'JAKET HMIF', 'color' => [34, 197, 94]], // green
            ['name' => 'tas-laptop', 'text' => 'TAS LAPTOP', 'color' => [99, 102, 241]], // indigo
            ['name' => 'laptop-asus', 'text' => 'LAPTOP ASUS', 'color' => [37, 99, 235]], // blue
            ['name' => 'keyboard', 'text' => 'KEYBOARD', 'color' => [249, 115, 22]], // orange
            ['name' => 'webcam', 'text' => 'WEBCAM', 'color' => [244, 63, 94]], // rose
        ];

        // Variants for each product (angles/views)
        $variants = [
            ['suffix' => '', 'label' => 'Front View', 'circle_pos' => [600, 200]],
            ['suffix' => '-2', 'label' => 'Side View', 'circle_pos' => [200, 600]],
            ['suffix' => '-3', 'label' => 'Detail', 'circle_pos' => [400, 400]],
            ['suffix' => '-4', 'label' => 'Package', 'circle_pos' => [650, 550]],
        ];

        $generatedCount = 0;

        foreach ($products as $product) {
            echo "\n📦 {$product['text']}:\n";
            
            foreach ($variants as $index => $variant) {
                $filename = $imagesPath . '/' . $product['name'] . $variant['suffix'] . '.jpg';
                
                // Create image 800x800
                $img = imagecreatetruecolor(800, 800);
                
                // Extract RGB values
                [$r, $g, $b] = $product['color'];
                
                // Create gradient background with different intensity per variant
                $gradientIntensity = 0.25 + ($index * 0.12);
                for ($y = 0; $y < 800; $y++) {
                    $ratio = $y / 800;
                    $newR = (int)($r * (1 - $ratio * $gradientIntensity));
                    $newG = (int)($g * (1 - $ratio * $gradientIntensity));
                    $newB = (int)($b * (1 - $ratio * $gradientIntensity));
                    $color = imagecolorallocate($img, $newR, $newG, $newB);
                    imagefilledrectangle($img, 0, $y, 800, $y + 1, $color);
                }
                
                // Add decorative transparent circles at different positions
                $circleColor = imagecolorallocatealpha($img, 255, 255, 255, 110 - ($index * 15));
                [$circleX, $circleY] = $variant['circle_pos'];
                imagefilledellipse($img, $circleX, $circleY, 280 + ($index * 25), 280 + ($index * 25), $circleColor);
                
                // Add additional smaller circle for variation
                if ($index > 0) {
                    $smallCircleColor = imagecolorallocatealpha($img, 255, 255, 255, 120);
                    imagefilledellipse($img, 800 - $circleX, 800 - $circleY, 180 - ($index * 20), 180 - ($index * 20), $smallCircleColor);
                }
                
                // Add white border frame
                $white = imagecolorallocate($img, 255, 255, 255);
                $borderThickness = 3;
                for ($i = 0; $i < $borderThickness; $i++) {
                    imagerectangle($img, 40 + $i, 40 + $i, 760 - $i, 760 - $i, $white);
                }
                
                // Add product name text with shadow
                $fontPath = __DIR__ . '/../../public/fonts/arial.ttf';
                $fontSize = 46 - ($index * 3); // Vary font size slightly
                $textX = 400;
                $textY = 380 + ($index * 15); // Vary Y position
                
                // Try to use TTF font if available, otherwise use default
                if (file_exists($fontPath)) {
                    // Shadow
                    $shadowColor = imagecolorallocate($img, 0, 0, 0);
                    imagettftext($img, $fontSize, 0, $textX + 3, $textY + 3, $shadowColor, $fontPath, $product['text']);
                    // Main text
                    imagettftext($img, $fontSize, 0, $textX, $textY, $white, $fontPath, $product['text']);
                    
                    // Add variant label at top
                    $labelSize = 18;
                    $labelY = 90;
                    $labelColor = imagecolorallocatealpha($img, 255, 255, 255, 50);
                    imagettftext($img, $labelSize, 0, 60, $labelY, $labelColor, $fontPath, $variant['label']);
                } else {
                    // Fallback: use larger built-in font
                    $text = $product['text'];
                    $textWidth = imagefontwidth(5) * strlen($text);
                    $textX = (800 - $textWidth) / 2;
                    $textY = 380;
                    // Shadow
                    $shadowColor = imagecolorallocate($img, 0, 0, 0);
                    imagestring($img, 5, $textX + 2, $textY + 2, $text, $shadowColor);
                    // Main text
                    imagestring($img, 5, $textX, $textY, $text, $white);
                }
                
                // Add kampuStore branding text at bottom
                if (file_exists($fontPath)) {
                    $brandingSize = 22;
                    $brandingY = 730;
                    imagettftext($img, $brandingSize, 0, 320, $brandingY + 1, imagecolorallocate($img, 0, 0, 0), $fontPath, 'kampuStore');
                    imagettftext($img, $brandingSize, 0, 320, $brandingY, $white, $fontPath, 'kampuStore');
                } else {
                    imagestring($img, 4, 350, 730, 'kampuStore', $white);
                }
                
                // Save image
                imagejpeg($img, $filename, 85);
                imagedestroy($img);
                
                $generatedCount++;
                echo "  ✓ {$variant['label']}: {$product['name']}{$variant['suffix']}.jpg\n";
            }
        }

        echo "\n✅ Successfully generated {$generatedCount} product images (17 products × 4 variants each)!\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    }
}
