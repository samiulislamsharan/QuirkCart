<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'title' => 'iPhone 13 Pro Max',
            'quantity' => 10,
            'brand_id' => 1,
            'category_id' => 1,
            'price' => 1099.99,
            'description' => 'The iPhone 13 Pro Max is the best smartphone you can buy right now. It has a stunning 6.7-inch Super Retina XDR display, a powerful A15 Bionic chip, and a fantastic camera system with improved low-light performance.',
        ]);

        Product::create([
            'title' => 'Galaxy Z Fold 3',
            'quantity' => 5,
            'brand_id' => 2,
            'category_id' => 1,
            'price' => 1799.99,
            'description' => 'The Galaxy Z Fold 3 is a foldable smartphone with a 7.6-inch Dynamic AMOLED 2X display, a Snapdragon 888 processor, and a versatile camera system. It also supports the S Pen for enhanced productivity.',
        ]);

        Product::create([
            'title' => 'MateBook X Pro',
            'quantity' => 3,
            'brand_id' => 3,
            'category_id' => 2,
            'price' => 1499.99,
            'description' => 'The MateBook X Pro is a premium laptop with a 13.9-inch 3K touchscreen display, an Intel Core i7 processor, and a NVIDIA GeForce MX250 GPU. It also has a sleek design and excellent build quality.',
        ]);

        Product::create([
            'title' => 'iPad Pro 12.9',
            'quantity' => 8,
            'brand_id' => 1,
            'category_id' => 3,
            'price' => 1099.99,
            'description' => 'The iPad Pro 12.9 is a powerful tablet with a 12.9-inch Liquid Retina XDR display, an M1 chip, and a dual-camera system with LiDAR. It also supports the Apple Pencil and Magic Keyboard for enhanced productivity.',
        ]);

        Product::create([
            'title' => 'Galaxy Tab S7+',
            'quantity' => 6,
            'brand_id' => 2,
            'category_id' => 3,
            'price' => 849.99,
            'description' => 'The Galaxy Tab S7+ is a premium Android tablet with a 12.4-inch Super AMOLED display, a Snapdragon 865+ processor, and a versatile S Pen stylus. It also has a long-lasting battery and supports DeX mode for enhanced productivity.',
        ]);

        Product::create([
            'title' => 'Galaxy Watch 4',
            'quantity' => 4,
            'brand_id' => 2,
            'category_id' => 4,
            'price' => 249.99,
            'description' => 'The Galaxy Watch 4 is a stylish smartwatch with a circular Super AMOLED display, a variety of health and fitness tracking features, and long battery life. It also runs Wear OS with Samsung\'s One UI Watch skin for a smooth user experience.',
        ]);

        Product::create([
            'title' => 'AirPods Pro',
            'quantity' => 7,
            'brand_id' => 1,
            'category_id' => 5,
            'price' => 249.99,
            'description' => 'The AirPods Pro are premium wireless earbuds with active noise cancellation, a customizable fit, and immersive sound quality. They also have a transparency mode for hearing the world around you and are sweat and water-resistant.',
        ]);

        Product::create([
            'title' => 'Galaxy Buds Pro',
            'quantity' => 9,
            'brand_id' => 2,
            'category_id' => 5,
            'price' => 199.99,
            'description' => 'The Galaxy Buds Pro are premium wireless earbuds with active noise cancellation, a comfortable fit, and excellent sound quality. They also have a long battery life and support wireless charging.',
        ]);

        Product::create([
            'title' => 'Watch GT 3',
            'quantity' => 2,
            'brand_id' => 3,
            'category_id' => 4,
            'price' => 199.99,
            'description' => 'The Watch GT 3 is a stylish smartwatch with a circular AMOLED display, a variety of health and fitness tracking features, and long battery life. It also has a premium design and supports wireless charging.',
        ]);
    }
}