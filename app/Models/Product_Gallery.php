<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product_Gallery extends Model
{
    use HasFactory;


    protected $fillable = [
        'product_id',
        'image',
        'order',
        'is_active',
    ];
    
    protected $dates = [
        'deleted_at'
    ];


    public function products()
    {
        return $this->belongsTo(Product::class , 'product_id', 'id');
    }
}
