<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'price'];
    protected $hidden = ['pivot'];
    public $timestamps = false;

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_product');
    }
}
