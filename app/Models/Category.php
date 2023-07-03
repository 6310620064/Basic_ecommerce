<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;


class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name', 
        'amount',
        'image',
        'is_display_homepage',
        'is_active',
    ];

    public function products()
    {
        return $this->hasMany(Product::class , 'category_id', 'id');
    }

    public function isHasProducts(){
        return true;
    }

    public function getTotalProductAttribute(){
        return Product::Published()->where([
            'category_id' => $this->attributes['id']
        ])->count();
    }
}
