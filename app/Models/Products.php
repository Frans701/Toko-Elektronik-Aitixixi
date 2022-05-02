<?php

namespace App\Models;

use App\Models\ProductCategories;
use App\Models\ProductReview;
use App\Models\TransactionDetail;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Database\Factories\ProductsFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Products extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function details()
    {
        return $this->hasMany(ProductCategoriesDetails::class, 'product_id', 'category_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImages::class, 'product_id');
    }

    public function categories()
    {
        return $this->belongsToMany(ProductCategories::class, 'product_categories_details', 'product_id', 'category_id');
    }

    public function product_review(){
        return $this->hasMany(ProductReview::class, 'product_id', 'id');
    }

    public function transaction_details()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function transactions()
    {
        return $this->belongsToMany(Transaction::class, 'transaction_details', 'product_id', 'transaction_id');
    }

    public function discount(){
        return $this->hasMany(Discount::class, 'product_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function getActiveDiscount()
    {
        if ($this->discount()) {
            $activeDiscount = $this->discount()->where('start', '<=', date('Y-m-d H:i:s'))->where('end', '>=', date('Y-m-d H:i:s'))->orderBy('start', 'ASC')->first();
        } else {
            $activeDiscount = NULL;
        }
        return $activeDiscount;
    }
    public function getPriceOrDiscountedPrice()
    {
        $discount = $this->getActiveDiscount();
        if ($discount != NULL) {
            $price = $this->price * (100 - $discount->percentage) / 100;
        } else {
            $price = $this->price;
        }
        return $price;
    }
}
