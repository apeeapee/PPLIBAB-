<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GenerateProductImages extends Seeder
{
    public function run(): void
    {
        $productsDir = public_path('images/products');
        
        // Pastikan folder ada
        if (!file_exists($productsDir)) {
            mkdir($productsDir, 0755, true);
        }

        // Daftar gambar yang perlu dibuat
        $images = [
            'pulpen-pilot.jpg' => ['color' => [59, 130, 246], 'text' => 'Pulpen Pilot'],
            'buku-grid.jpg' => ['color' => [249, 115, 22], 'text' => 'Buku Grid'],
            'sticky-notes.jpg' => ['color' => [236, 72, 153], 'text' => 'Sticky Notes'],
            'penghapus.jpg' => ['color' => [34, 197, 94], 'text' => 'Penghapus'],
            'kalkulator-casio.jpg' => ['color' => [168, 85, 247], 'text' => 'Kalkulator Casio'],
            'mouse-logitech.jpg' => ['color' => [14, 165, 233], 'text' => 'Mouse Logitech'],
            'headphone-gaming.jpg' => ['color' => [239, 68, 68], 'text' => 'Headphone Gaming'],
            'flashdisk.jpg' => ['color' => [251, 146, 60], 'text' => 'Flashdisk 32GB'],
            'buku-algoritma.jpg' => ['color' => [99, 102, 241], 'text' => 'Buku Algoritma'],
            'buku-calculus.jpg' => ['color' => [139, 92, 246], 'text' => 'Buku Calculus'],
            'binder.jpg' => ['color' => [6, 182, 212], 'text' => 'Binder A4'],
            'hoodie.jpg' => ['color' => [217, 70, 239], 'text' => 'Hoodie Undip'],
            'jaket-hmif.jpg' => ['color' => [20, 184, 166], 'text' => 'Jaket HMIF'],
            'tas-laptop.jpg' => ['color' => [234, 179, 8], 'text' => 'Tas Laptop'],
            'laptop-asus.jpg' => ['color' => [71, 85, 105], 'text' => 'Laptop Asus'],
            'keyboard.jpg' => ['color' => [100, 116, 139], 'text' => 'Keyboard Mech'],
            'webcam.jpg' => ['color' => [148, 163, 184], 'text' => 'Webcam HD'],
        ];

        echo "\n📸 Generating product placeholder images...\n";

        foreach ($images as $filename => $config) {
            $filepath = $productsDir . '/' . $filename;
            
            // Skip jika file sudah ada
            if (file_exists($filepath)) {
                echo "  ✓ {$filename} already exists\n";
                continue;
            }

            // Cek apakah GD extension tersedia
            if (!extension_loaded('gd')) {
                echo "  ⚠ GD extension not available, creating empty file for {$filename}\n";
                file_put_contents($filepath, '');
                continue;
            }

            // Buat placeholder image 800x800
            $width = 800;
            $height = 800;
            $image = imagecreatetruecolor($width, $height);
            
            // Create gradient background
            $mainColor = $config['color'];
            for ($i = 0; $i < $height; $i++) {
                $ratio = $i / $height;
                // Gradient dari color ke lebih gelap
                $r = (int)($mainColor[0] * (1 - $ratio * 0.4));
                $g = (int)($mainColor[1] * (1 - $ratio * 0.4));
                $b = (int)($mainColor[2] * (1 - $ratio * 0.4));
                $lineColor = imagecolorallocate($image, $r, $g, $b);
                imageline($image, 0, $i, $width, $i, $lineColor);
            }
            
            // Text colors
            $textColor = imagecolorallocate($image, 255, 255, 255);
            $shadowColor = imagecolorallocate($image, 0, 0, 0);
            imagecolortransparent($image, imagecolorallocate($image, 1, 1, 1));
            
            // Add rounded rectangle border
            $borderColor = imagecolorallocate($image, 255, 255, 255);
            $borderThickness = 3;
            for ($i = 0; $i < $borderThickness; $i++) {
                imagerectangle($image, 10 + $i, 10 + $i, $width - 10 - $i, $height - 10 - $i, $borderColor);
            }
            
            // Add product name (larger)
            $fontSize = 5;
            $text = strtoupper($config['text']);
            $textWidth = imagefontwidth($fontSize) * strlen($text);
            $textHeight = imagefontheight($fontSize);
            $x = ($width - $textWidth) / 2;
            $y = ($height / 2) - 40;
            
            // Shadow effect
            imagestring($image, $fontSize, $x + 2, $y + 2, $text, $shadowColor);
            imagestring($image, $fontSize, $x, $y, $text, $textColor);
            
            // Add "kampuStore" branding
            $brand = "kampuStore";
            $brandWidth = imagefontwidth(4) * strlen($brand);
            $brandX = ($width - $brandWidth) / 2;
            $brandY = ($height / 2) + 20;
            imagestring($image, 4, $brandX, $brandY, $brand, $textColor);
            
            // Add decorative circle in center
            $circleColor = imagecolorallocatealpha($image, 255, 255, 255, 100);
            imagefilledellipse($image, $width / 2, $height / 2, 200, 200, $circleColor);
            
            // Save image
            imagejpeg($image, $filepath, 85);
            imagedestroy($image);
            
            echo "  ✓ Generated {$filename}\n";
        }

        echo "\n✅ All product images generated successfully!\n\n";
    }
}
