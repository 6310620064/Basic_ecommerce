<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Order extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'user_id',
        'total_price',
        'payment_status',
        'delivery_status',
        'shipping_address_id',
    ];

    public function orderitem()
    {
        return $this->hasMany(OrderItem::class,'order_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function shipping_address()
    {
        return $this->belongsTo(Shipping_Address::class,'shipping__address_id','id');
    }

    public function all_shipping_address(){
        return $this->belongsTo(Shipping_Address::class, 'shipping__address_id','id')->withTrashed();
    }

    public function payment_log()
    {
        return $this->hasOne(Payment_log::class,'order_id','id');
    }

}
