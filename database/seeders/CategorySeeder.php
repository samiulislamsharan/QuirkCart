<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Smartphones',
            'slug' => 'smartphones',
        ]);

        Category::create([
            'name' => 'Laptops',
            'slug' => 'laptops',
        ]);

        Category::create([
            'name' => 'Tablets',
            'slug' => 'tablets',
        ]);

        Category::create([
            'name' => 'Accessories',
            'slug' => 'accessories',
        ]);

        Category::create([
            'name' => 'Smartwatches',
            'slug' => 'smartwatches',
        ]);
    }
}