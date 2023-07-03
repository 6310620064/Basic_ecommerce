<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;


class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'amount',
        'image',
        'order',
        'is_active',
    ];

    public function products()
    {
        return $this->hasMany(Product::class , 'brand_id', 'id');
    }

    public function isHasProducts(){
        return true;
    }

    public function getTotalProductAttribute(){
        return Product::Published()->where([
            'brand_id' => $this->attributes['id']
        ])->count();
    }
}
