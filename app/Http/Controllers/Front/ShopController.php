<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    // public function shop()
    // {
    //     return view('front.shop.index');
    // }

    // public function shopDetails($id)
    // {
    //     return view('front.shop.details', compact('id'));
    // }

    public function shop(Request $request)
    {
        // Get all products with pagination
        $products = Product::query();

        // Apply filters if any
        if ($request->has('category')) {
            $products->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->has('min_price') && $request->has('max_price')) {
            $products->whereBetween('price', [$request->min_price, $request->max_price]);
        }

        if ($request->has('brand')) {
            $products->whereIn('brand_id', $request->brand);
        }

        if ($request->has('rating')) {
            $products->where('rating', '>=', $request->rating);
        }

        // Sorting
        $sortOptions = [
            'price_asc' => ['price', 'asc'],
            'price_desc' => ['price', 'desc'],
            'newest' => ['created_at', 'desc'],
            'rating' => ['rating', 'desc']
        ];

        $sort = $request->get('sort', 'newest');
        $sortValue = $sortOptions[$sort] ?? $sortOptions['newest'];
        $products->orderBy($sortValue[0], $sortValue[1]);

        $products = $products->paginate(12);

        // Get all categories and brands for filters
        $categories = MainCategory::withCount('products')->get();
        // $brands = Brand::withCount('products')->get();

        return view('front.shop.index', compact('products', 'categories'));
    }

    // public function product($slug)
    // {
    //     $product = Product::with('subCategory', 'brand', 'reviews.user')
    //         ->where('slug', $slug)
    //         ->firstOrFail();

    //     // Get related products
    //     $relatedProducts = Product::where('category_id', $product->category_id)
    //         ->where('id', '!=', $product->id)
    //         ->inRandomOrder()
    //         ->limit(4)
    //         ->get();

    //     return view('front.shop.details', compact('product', 'relatedProducts'));
    // }

    public function product($slug)
    {
        $product = Product::with('subCategory')
            ->where('slug', $slug)
            ->firstOrFail();

        // Get related products based on sub category
        $relatedProducts = Product::where('sub_category_id', $product->sub_category_id)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('front.shop.details', compact('product', 'relatedProducts'));
    }


    public function category($slug)
    {
        $category = MainCategory::where('slug', $slug)->firstOrFail();
        $products = $category->products()->paginate(12);

        return view('front.shop.index', [
            'products' => $products,
            'categories' => MainCategory::withCount('products')->get(),
            // 'brands' => Brand::withCount('products')->get(),
            'currentCategory' => $category,
            'currentSubcategory' => $subcategory,
        ]);
    }

    public function subcategory($categorySlug, $subcategorySlug)
    {
        $category = SubCategory::where('slug', $categorySlug)->firstOrFail();
        $subcategory = $category->children()->where('slug', $subcategorySlug)->firstOrFail();

        $products = $subcategory->products()->paginate(12);

        return view('front.shop.index', [
            'products' => $products,
            'categories' => SubCategory::withCount('products')->get(),
            // 'brands' => Brand::withCount('products')->get(),
            'currentCategory' => $category,
            'currentSubcategory' => $subcategory
        ]);
    }
}
