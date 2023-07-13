<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Shipping_Address;



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
            $user = Auth::user();
            $userid = $user->id;
            $address = Shipping_Address::where('user_id', $userid)->get();
            $default_address = Shipping_Address::where('user_id', $userid)
                                        ->where('is_default', 1)
                                        ->first();
            $cart = Cart::where('user_id', $userid)->get();
            
            if($cart->isEmpty()) {
                return view('home.show_cart_empty');
            }

            return view('home.show_cart',compact('cart','address','default_address'));  
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

        // Retrieve the cart item from the database
        $cart = Cart::find($cartId);

        if ($cart) {
            // Update the quantity
            $cart->quantity = $quantity;
            $cart->save();

            // Return success response
            return response()->json(['success' => true]);
        } else {
            // Return error response if cart item is not found
            return response()->json(['success' => false, 'message' => 'Cart item not found']);
        }
    }

    public function delete_cart($id)
    {
        $cart=Cart::find($id);

        $cart->delete();

        return redirect()->back();
    }



}
