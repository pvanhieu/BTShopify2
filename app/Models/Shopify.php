<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeles;

class Shopify extends Model
{
    use HasFactory;

    /**
     * 
     */
    protected $table = 'shopify';
    protected $fillable = [
        'name',
        'domain',
        'email',
        'shopify_domain',
        'plan_name',
        'access_token',
    ];
    /**
     * 
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
