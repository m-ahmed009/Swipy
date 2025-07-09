<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index');
    }

    public function quickStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
            'is_active' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        $data = $request->except('image');
        $data['slug'] = Str::slug($request->name);
        $data['type'] = 'parent';
        $data['position'] = 0;
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::slug($request->name).'_'.time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/categories'), $imageName);
            $data['image'] = 'uploads/categories/'.$imageName;
        }

        $category = Category::create($data);

        return response()->json([
            'success' => true,
            'category' => $category
        ]);
    }
}
