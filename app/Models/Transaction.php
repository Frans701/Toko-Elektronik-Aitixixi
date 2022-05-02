<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Courier;
use App\Models\TransactionDetail;
use App\Models\Products;
use App\Models\User;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function courier(){
        return $this->belongsTo(Courier::class,'courier_id','id');
    }

    public function transaction_detail(){
        return $this->hasMany(TransactionDetail::class, 'transaction_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function product(){
        return $this->belongsToMany(Products::class, 'transaction_details', 'transaction_id', 'product_id')->withPivot('id');
    }
    public function products()
    {
        return $this->belongsToMany(Products::class, 'transaction_details', 'transaction_id', 'product_id');
    }
}
