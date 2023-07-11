<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment_log extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'total_price',
        'image',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id','id');
    }
}
