<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Type extends Model
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
        return $this->hasMany(Product::class , 'type_id', 'id');
    }
}
