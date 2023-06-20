<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Brand extends Model
{
    use HasFactory;
    use SoftDeletes;

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
}
