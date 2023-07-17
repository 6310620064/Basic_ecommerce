<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipping_Address extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'address', 
        'phone',
        'user_id',
        'is_default',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function order()
    {
        return $this->hasOne(Order::class, 'shipping__address_id','id');
    }

}
