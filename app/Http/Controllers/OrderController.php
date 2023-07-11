<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;

use App\Models\Shipping_Address;


class OrderController extends Controller
{

    public function cash_order()
    {
        $user=Auth::user();

        $userid = $user->id;
        $address = Shipping_Address::where('user_id',$userid)
                                    ->where('is_default',1)
                                    ->first();
        if($address == null){
            return view('home.shipping_address');
        }
        
        $cart = Cart::where('user_id',$userid)->get();
        $total_price = 0;
        $orderItem = new OrderItem();

        foreach ($cart as $item){
            $total_price += $item->product->price_member * $item->quantity;
        }

        $order = new Order();
        $order->order_no = uniqid();
        $order->user_id = $userid;
        $order->total_price = $total_price;
        $order->payment_status = "Cash on Delivery";
        $order->delivery_status = "Processing";
        $order->shipping__address_id = $address->id;
        $order->save();

        foreach ($cart as $item){
            $orderItem = new OrderItem();
            $orderItem->product_id = $item->product_id;
            $orderItem->order_id = $order->id;
            $orderItem->price =  $item->product->price_member;
            $orderItem->quantity = $item->quantity;
            $orderItem->sub_total = $item->product->price_member * $item->quantity;
            $orderItem->save();

            $item->delete();
        }

        
        return redirect()->back()->with('message','We have received your order.');




    }
}
