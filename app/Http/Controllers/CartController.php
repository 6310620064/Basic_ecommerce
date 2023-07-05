<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;


class CartController extends Controller
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

    public function show_cart()
    {

        if(Auth::id())
        {
            $id = Auth::user()->id;
            $cart = Cart::where('user_id', $id)->get();
    
            return view('home.show_cart',compact('cart'));  
        }
        
        else
        {
            return redirect('login');
        }

    }

    public function delete_cart($id)
    {
        $cart=Cart::find($id);

        $cart->delete();

        return redirect()->back();
    }


}
