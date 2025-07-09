<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\MainCategory;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    public function index()
    {
        $categories = SubCategory::all();

        return view('admin.sub-categories.index', compact('categories'));
    }


    public function create()
    {
        $categories = SubCategory::all();
        $mainCategories = MainCategory::all();
        return view('admin.sub-categories.create', compact('categories','mainCategories'));
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'main_category_id' => 'required|integer|exists:main_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_active' => 'boolean', // is_active should be either 1 or 0
        ]);

        // Prepare data to be stored
        $data = $request->except('image'); // Excluding image from input data
        $data['slug'] = Str::slug($request->name);
        $data['type'] = $request->parent_id ? 'child' : 'parent';
        $data['is_active'] = $request->boolean('is_active');

        // Image upload logic
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::slug($request->name) . '_' . time() . '.' . $image->getClientOriginalExtension();

            // Move image to the 'main-category' folder
            $image->move(public_path('sub-category'), $imageName);
            $data['image'] = 'sub-category/' . $imageName; // Save image path
        }

        // Create category in the database
        SubCategory::create($data);

        // Redirect to categories list with success message
        return redirect()->route('admin.sub-categories.index')
            ->with('success', 'Category created successfully!');
    }



    public function show($id)
    {
        $category = SubCategory::find($id);

        return view('admin.sub-categories.show', compact('category'));
    }

    public function edit(SubCategory $category)
    {
        $mainCategories = Category::whereNull('parent_id')
            ->where('id', '!=', $category->id)
            ->get();

        return view('admin.sub-categories.edit', compact('category', 'mainCategories'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id|not_in:'.$category->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'position' => 'integer'
        ]);

        $data = $request->except('image');
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $imagePath = $request->file('image')->store('categories', 'public');
            $data['image'] = $imagePath;
        }

        $category->update($data);

        return redirect()->route('admin.sub-categories.index')
            ->with('success', 'Category updated successfully!');
    }

    public function getByMainCategory(MainCategory $mainCategory)
    {
        try {
            $subCategories = $mainCategory->subCategories()
                ->select('id', 'name')
                ->get();

            return response()->json($subCategories);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error fetching subcategories',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(SubCategory $subCategory)
    {
        try {
            if ($subCategory->image) {
                $imagePath = public_path($subCategory->image);

                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $subCategory->delete();

            return redirect()->route('admin.sub-categories.index')
                ->with('success', 'Sub category deleted successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error deleting sub category: '.$e->getMessage());
        }
    }
}
