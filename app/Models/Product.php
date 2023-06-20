<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name', 
        'price_normal',
        'price_member',
        'brand_id',
        'type_id',
        'size_id',
        'amount',
        'is_highlight',
        'image',
        'start_display',
        'end_display',
        'is_active',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id','id');
    }

    
    public function type()
    {
        return $this->belongsTo(Type::class,'type_id','id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id' ,'id');
    }

    public function product_galleries()
    {
        return $this->hasMany(Product_Gallery::class, 'product_id', 'id');
    }

    public function product_details()
    {
        return $this->hasMany(Product_Detail::class, 'product_id' , 'id');
    }

}
