<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductShopify extends Model
{
    use HasFactory;

     protected $table = 'products_shopify';
     protected $fillable = [
        'id',
        'title',
        'body_html',
        'status',
        'image',
        'vendor',
        'product_type',
        
    ];
}
