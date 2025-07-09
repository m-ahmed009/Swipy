<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MainCategory;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {

        // Get 8 random featured products with their categories loaded
        $featuredProducts = Product::with(['mainCategory', 'subCategory'])
            ->where('is_featured', true)
            ->where('is_active', true)
            ->inRandomOrder() // Random order each time
            ->take(8)
            ->get()
            ->map(function ($product) {
                // Add some random elements to make it dynamic
                $product->is_new = rand(0, 1); // 50% chance of being "new"
                $product->average_rating = $this->generateRandomRating();
                $product->reviews_count = rand(5, 200);

                // Calculate current price with random discount (for some products)
                if (rand(0, 1)) { // 50% chance of having a discount
                    $product->discount = rand(5, 30); // Random discount between 5-30%
                    $product->original_price = $product->price;
                    $product->current_price = $product->price * (1 - ($product->discount / 100));
                } else {
                    $product->discount = 0;
                    $product->original_price = $product->price;
                    $product->current_price = $product->price;
                }

                return $product;
            });

        $mainCategories = MainCategory::all();


        return view('front.home.index', compact('mainCategories', 'featuredProducts'));
    }
    private function generateRandomRating()
    {
        // Generate a random rating between 3.0 and 5.0 with 0.5 increments
        $base = rand(3, 4);
        $decimal = rand(0, 1) ? 0.5 : 0.0;
        return min($base + $decimal, 5.0);
    }

    public function featuredProducts()
    {
        // Get 8 random featured products with their categories loaded
        $featuredProducts = Product::with(['mainCategory', 'subCategory'])
            ->where('is_featured', true)
            ->where('is_active', true)
            ->inRandomOrder() // Random order each time
            ->take(8)
            ->get()
            ->map(function ($product) {
                // Add some random elements to make it dynamic
                $product->is_new = rand(0, 1); // 50% chance of being "new"
                $product->average_rating = $this->generateRandomRating();
                $product->reviews_count = rand(5, 200);

                // Calculate current price with random discount (for some products)
                if (rand(0, 1)) { // 50% chance of having a discount
                    $product->discount = rand(5, 30); // Random discount between 5-30%
                    $product->original_price = $product->price;
                    $product->current_price = $product->price * (1 - ($product->discount / 100));
                } else {
                    $product->discount = 0;
                    $product->original_price = $product->price;
                    $product->current_price = $product->price;
                }

                return $product;
            });

        return view('front.home.index', compact('featuredProducts'));
    }
}
