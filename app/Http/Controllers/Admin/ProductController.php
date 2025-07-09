<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\MainCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::with('mainCategory', 'subCategory')->latest()->get();
        return view('admin.products.index', compact('products'));

    }

    public function create()
    {
        $mainCategories = MainCategory::all();
        return view('admin.products.create', compact('mainCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'main_category_id' => 'required|exists:main_categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'tax' => 'nullable|numeric|min:0',
            'quantity' => 'nullable|integer|min:0',
            'sku' => 'required|unique:products,sku',
            'thumbnail' => 'required|image|max:2048', // 2MB max
            'images.*' => 'nullable|image|max:2048',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
        ]);

        // Generate unique slug
        $slug = $request->slug ?: Str::slug($request->name);
        $count = Product::where('slug', 'like', $slug.'%')->count();
        $slug = $count ? $slug.'-'.($count + 1) : $slug;

        // Handle thumbnail upload - using your preferred method
        $thumbnailName = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = Str::slug($request->name) . '_thumbnail_' . time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('products/thumbnails'), $thumbnailName);
            $thumbnailPath = 'products/thumbnails/' . $thumbnailName;
        }

        // Handle gallery images - using your preferred method
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = Str::slug($request->name) . '_gallery_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('products/gallery'), $imageName);
                $imagePaths[] = 'products/gallery/' . $imageName;
            }
        }

        // Create product
        Product::create([
            'main_category_id' => $request->main_category_id,
            'sub_category_id' => $request->sub_category_id,
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'price' => $request->price,
            'discount' => $request->discount ?? 0,
            'tax' => $request->tax ?? 0,
            'quantity' => $request->quantity ?? 0,
            'sku' => $request->sku,
            'thumbnail' => $thumbnailPath,
            'images' => $imagePaths,
            'is_active' => $request->input('is_active', 0),
            'is_featured' => $request->input('is_featured', 0),
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function generateSlug(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $slug = Str::slug($validated['name']);
        $count = Product::where('slug', 'like', $slug.'%')->count();

        return response()->json([
            'slug' => $count ? $slug.'-'.($count + 1) : $slug
        ]);
    }

    public function toggleStatus(Product $product)
    {
        $product->update(['is_active' => !$product->is_active]);

        return response()->json([
            'message' => 'Status updated successfully',
            'is_active' => $product->is_active
        ]);
    }

    public function toggleFeatured(Product $product)
    {
        $product->update(['is_featured' => !$product->is_featured]);

        return response()->json([
            'message' => 'Featured status updated successfully',
            'is_featured' => $product->is_featured
        ]);
    }

    public function destroy($id)
    {
        //
    }
}
