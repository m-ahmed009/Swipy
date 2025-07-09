<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MainCategory;

class MainCategoryController extends Controller
{
    public function index()
    {
        $categories = MainCategory::all();

        return view('admin.categories.index', compact('categories'));
    }


    public function create()
    {
        $categories = MainCategory::all();
        return view('admin.categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_active' => 'boolean', // is_active should be either 1 or 0
        ]);

        // Prepare data to be stored
        $data = $request->except('image'); // Excluding image from input data
        $data['slug'] = \Str::slug($request->name);
        $data['type'] = $request->parent_id ? 'child' : 'parent';
        $data['is_active'] = $request->boolean('is_active');

        // Image upload logic
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = \Str::slug($request->name) . '_' . time() . '.' . $image->getClientOriginalExtension();

            // Move image to the 'main-category' folder
            $image->move(public_path('main-category'), $imageName);
            $data['image'] = 'main-category/' . $imageName; // Save image path
        }

        // Create category in the database
        MainCategory::create($data);

        // Redirect to categories list with success message
        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully!');
    }



    public function show($id)
    {
        $category = MainCategory::find($id);

        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        $mainCategories = Category::whereNull('parent_id')
            ->where('id', '!=', $category->id)
            ->get();

        return view('admin.categories.edit', compact('category', 'mainCategories'));
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

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully!');
    }

    public function destroy(MainCategory $category)
    {
        if ($category->image && file_exists(public_path($category->image))) {
            unlink(public_path($category->image));
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category and its image deleted successfully!');
    }

}
