<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::create([
            'name' => 'Apple',
            'slug' => 'apple',
        ]);

        Brand::create([
            'name' => 'Samsung',
            'slug' => 'samsung',
        ]);

        Brand::create([
            'name' => 'Huawei',
            'slug' => 'huawei',
        ]);

        Brand::create([
            'name' => 'Xiaomi',
            'slug' => 'xiaomi',
        ]);

        Brand::create([
            'name' => 'Oppo',
            'slug' => 'oppo',
        ]);

        Brand::create([
            'name' => 'Vivo',
            'slug' => 'vivo',
        ]);

        Brand::create([
            'name' => 'Realme',
            'slug' => 'realme',
        ]);

        Brand::create([
            'name' => 'OnePlus',
            'slug' => 'oneplus',
        ]);

        Brand::create([
            'name' => 'Google',
            'slug' => 'google',
        ]);

        Brand::create([
            'name' => 'Sony',
            'slug' => 'sony',
        ]);
    }
}
