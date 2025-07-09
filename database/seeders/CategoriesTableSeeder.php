<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MainCategory;
use App\Models\SubCategory;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        // Main Categories
        $electronics = MainCategory::create([
            'name'      => 'Electronics',
            'image'     => 'test.jpg',
            'is_active' => 1,
        ]);

        $fashion = MainCategory::create([
            'name'      => 'Fashion',
            'image'     => 'test.jpg',
            'is_active' => 1,
        ]);

        $home = MainCategory::create([
            'name'      => 'Home & Kitchen',
            'image'     => 'test.jpg',
            'is_active' => 1,
        ]);

        $beauty = MainCategory::create([
            'name'      => 'Beauty',
            'image'     => 'test.jpg',
            'is_active' => 1,
        ]);

        $sports = MainCategory::create([
            'name'      => 'Sports & Fitness',
            'image'     => 'test.jpg',
            'is_active' => 1,
        ]);

        // Sub-categories for Electronics
        SubCategory::create([
            'main_category_id' => $electronics->id,
            'name'             => 'Smartphones',
            'image'            => 'test.png',
            'is_active'        => 1
        ]);

        SubCategory::create([
            'main_category_id' => $electronics->id,
            'name'             => 'Laptops',
            'image'            => 'test.png',
            'is_active'        => 1
        ]);

        // Sub-categories for Fashion
        SubCategory::create([
            'main_category_id' => $electronics->id,
            'name'             => 'Men\'s Clothing',
            'image'            => 'test.png',
            'is_active'        => 1
        ]);

        SubCategory::create([
            'main_category_id' => $electronics->id,
            'name'             => 'Women\'s Clothing',
            'image'            => 'test.png',
            'is_active'        => 1
        ]);
    }
}
