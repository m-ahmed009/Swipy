<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'is_active'];

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, SubCategory::class);
    }


    // Jab update hoga is_active ya delete, sub categories bhi update hongi
    protected static function booted()
    {
        static::updating(function ($category) {
            if ($category->isDirty('is_active')) {
                $category->subCategories()->update(['is_active' => $category->is_active]);
            }
        });

        static::deleting(function ($category) {
            $category->subCategories()->delete();
        });
    }
}
