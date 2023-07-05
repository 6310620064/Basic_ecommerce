<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;

class OrderController extends Controller
{

    public function add_cart(Request $request ,$id)
    {
        if(Auth::id())
        {
            $user = Auth::user();
            $product = Product::find($id);
            
            $cart = new Cart;
            $cart->product_id = $product->id;
            $cart->user_id = $user->id;
            $cart->quantity = $request->amount;
            $cart->save();
            
            return redirect()->back();
        }

        else
        {
            return redirect('login');
        }
    }

    public function add_order(Request $request , $id)
    {
            $user = Auth::user();

            $userid = $user->id;
            $cart = Cart::find($id);

            
            $order = new Order;
            $order->user_id = $userid;
            $order->cart_id = $cart->id;
            $order->payment_status = 'Pending';
            $order->delivery_status = 'Processing';
            dd($order);
            $order->save();
            
            return redirect()->back();


    }
}
