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
        'category_id',
        'size_id',
        'amount',
        'is_highlight',
        'image',
        'start_display',
        'end_display',
        'is_active',
    ];

    public function scopePublished( $query ){
        return $query->where('is_active', 1)
                    ->where('start_display','<=',now())
                    ->where( function( $query ){
                        $query->where('end_display', '>', now())
                            ->orWhere('end_display',null);
                    });
    }

    
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id','id');
    }
    
    
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
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

    public function cart()
    {
        return $this->hasMany(Cart::class, 'product_id', 'id');
    }


    protected static function boot()
{
    parent::boot();

    static::created(function ($product) { //ถูกเรียกเมื่อมีการสร้างProductใหม่
        if ($product->brand_id) { //ตรวจสอบว่าไม่เป็นค่าnull
            $product->brand->increment('amount'); //จะเพิ่มค่าamount ใน brand
        }
        if ($product->category_id) {
            $product->category->increment('amount');
        }
    });

    static::deleted(function ($product) { //ถูกเรียกเมื่อมีการลบProduct
        if ($product->brand_id) { // ตรวจสอบว่าไม่เป็นค่า null
            $product->brand->decrement('amount'); // ลบค่าamount ใน brand
        }
        if ($product->category_id) {
            $product->category->decrement('amount');
        }
    });

    static::updating(function ($product) { // ถูกเรียกเมื่อมีการแก้ไขข้อมูล
        // Check if the brand_id or category_id is changed
        if ($product->isDirty('brand_id') || $product->isDirty('category_id')) { //isDirty ตรวจสอบว่าค่าถูกเปลี่ยนแปลงหรือไม่
            $originalBrandId = $product->getOriginal('brand_id'); //getOriginal รับค่าเดิมก่อนที่จะมีการเปลี่ยนแปลง
            $originalCategoryId = $product->getOriginal('category_id');

            if ($originalBrandId) {
                $originalBrand = Brand::find($originalBrandId);
                if ($originalBrand) {
                    $originalBrand->decrement('amount'); //ลดค่าที่brand_idอันเก่าก่อนที่จะมีการแก้ไข
                }
            }

            if ($originalCategoryId) {
                $originalCategory = Category::find($originalCategoryId);
                if ($originalCategory) {
                    $originalCategory->decrement('amount'); //ลดค่าที่category_idอันเก่าก่อนที่จะมีการแก้ไข
                }
            }

            if ($product->brand_id) {
                $product->brand->increment('amount'); // เพิ่มค่าamount ที่brand_idใหม่หลังแก้ไข
            }

            if ($product->category_id) {
                $product->category->increment('amount');// เพิ่มค่าamount ที่category_idใหม่หลังแก้ไข
            }
        }
    });
}

    
}
