<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;


class Size extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'size',
        'is_active',
    ];

    public function products()
    {
        return $this->hasMany(Product::class , 'size_id', 'id');
    }

    public function isHasProducts(){
        return true;
    }

    public function getTotalProductAttribute(){
        return Product::Published()->where([
            'size_id' => $this->attributes['id']
        ])->count();
    }
}
