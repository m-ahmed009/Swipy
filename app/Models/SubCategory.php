<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = ['main_category_id', 'name', 'image', 'is_active'];

    public function mainCategory()
    {
        return $this->belongsTo(MainCategory::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
