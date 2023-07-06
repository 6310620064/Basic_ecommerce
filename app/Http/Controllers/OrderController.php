<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;

class OrderController extends Controller
{

    public function cash_order()
    {
        $user=Auth::user();

        $userid = $user->id;

        $data = Cart::where('user_id',$userid)->get();
        $order = Order::create([
            'order_no' => '....',
            'total'
            'payment_status' => "Cash on Delivery",
            'delivery_status' => "Processing"
        ]);

        foreach($data as $data)
        {
            $order = new Order;

            $order->user_id = $data->user_id;
            $order->payment_status = "Cash on Delivery";
            $order->delivery_status = "Processing";

            $order->save();
            $CartId = $data->id;
            $cart = Cart::find($CartId);
            $cart->delete();
        }
        

        return redirect()->back()->with('message','We have received your order.');




    }
}
