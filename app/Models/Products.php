<?php

namespace App\Models;

use App\Models\ProductCategories;
use Database\Factories\ProductsFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Products extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function details()
    {
        return $this->hasMany(ProductCategoriesDetails::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImages::class, 'product_id');
    }

    public function categories()
    {
        return $this->belongsToMany(ProductCategories::class, 'product_categories_details', 'product_id', 'category_id');
    }
}
