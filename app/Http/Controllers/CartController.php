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
            $cart = $cart->where([
                'product_id' => $product->id,
                'user_id' => $user->id
            ]);

            if($cart->count() > 0){
                $cart = $cart->first();
                $cart->update([
                    'quantity' => $cart->quantity + $request->amount
                ]);
            }else{
                $cart = new Cart;
                $cart->product_id = $product->id;
                $cart->user_id = $user->id;
                $cart->quantity = $request->amount;
                $cart->save();
            }

            
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

    public function update_quantity(Request $request)
    {
        $cartId = $request->input('cart_id');
        $quantity = $request->input('quantity');

        // Update the quantity of the product in the database using $cartId and $quantity

        // Calculate the new subtotal and total price
        $cart = Cart::find($cartId);
        $subtotal = $cart->product->price_member * $quantity;

        $totalPrice = 0;
        $cartItems = Cart::all();
        foreach ($cartItems as $item) {
            $totalPrice += $item->product->price_member * $item->quantity;
        }

        return response()->json([
            'success' => true,
            'subtotal' => number_format($subtotal, 2),
            'total_price' => number_format($totalPrice, 2),
        ]);
    }


    public function delete_cart($id)
    {
        $cart=Cart::find($id);

        $cart->delete();

        return redirect()->back();
    }


}
