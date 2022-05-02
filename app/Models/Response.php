<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;

class Response extends Model
{
    use HasFactory;
    protected $fillable = [
        'review_id', 'admin_id', 'content'
    ];

    public function admin(){
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }
}
