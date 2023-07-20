<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shipping_Address;
use App\Models\Payment_log;
use Farzai\PromptPay\Generator;
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
            return redirect('shipping_address');    
        }
        else{     
            $cart = Cart::where('user_id',$userid)->get();
            if($cart->isEmpty()){
                return redirect('/');
            }
            
            $total_price = 0;

            foreach ($cart as $item){
                $total_price += $item->product->price_member * $item->quantity;
            }

            $order = new Order();
            $order->order_no = uniqid();
            $order->user_id = $userid;
            $order->total_price = $total_price;
            $order->payment_status = "Cash On Delivery";
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

                $product = Product::find($item->product_id);
                $product->amount -= $item->quantity;
                $product->save();

                $item->delete();
            }
        }

        return redirect('/');
    }

    public function pay_qrcode(){
        $user=Auth::user();
        
        $userid = $user->id;
        $address = Shipping_Address::where('user_id',$userid)
                                    ->where('is_default',1)
                                    ->first();
        if($address == null){
            return redirect('shipping_address');    
        }
        else{
            
            $cart = Cart::where('user_id',$userid)->get();
            if($cart->isEmpty()){
               return redirect('/');
            }
            else{
                $total_price = 0;
                
                foreach ($cart as $item){
                    $total_price += $item->product->price_member * $item->quantity;
                }
                $generator = new Generator();
                $qrCode = $generator->generate(
                    target: "088-752-2809", 
                    amount: $total_price,
                );

                $qrCodeimg = ('qrcode_' . time() . '.png');
                $qrCode->save($qrCodeimg);

                return view('home.qrcode', compact('user','total_price','qrCodeimg'));
            }
        }
    }

    public function payment_log(Request $request)
    {
        if(Auth::id())
        {
            $user = Auth::user();
            $userid = $user->id;
            $address = Shipping_Address::where('user_id',$userid)
                                    ->where('is_default',1)
                                    ->first();

            $cart = Cart::where('user_id',$userid)->get();
            $total_price = 0;

            foreach ($cart as $item){
                $total_price += $item->product->price_member * $item->quantity;
            }

            $order = new Order();
            $order->order_no = uniqid();
            $order->user_id = $userid;
            $order->total_price = $total_price;
            $order->payment_status = "Pay With Qrcode";
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

                $product = Product::find($item->product_id);
                $product->amount -= $item->quantity;
                $product->save();

                $item->delete();
            }
            $payment = new Payment_log;

            $payment->order_id = $order->id;
            $payment->total_price = $total_price;
            $payment->image = $request->image->store('slip');
            $payment->name = $user->name;
            $payment->phone = $request->phone;
            $payment->save();

            return redirect('/');

            
        }

        else
        {
            return redirect('login');
        }

    }


    public function select_address(){

        $user = Auth::user();
        $userid = $user->id;

        $address = Shipping_Address::where('user_id', $userid)->get();
        $default = Shipping_Address::where('user_id', $userid)->
                                    where('is_default','1')->first();
                         
        return view('home.select_address', compact('user','address','default'));
    }

    public function select_address_confirm(Request $request)
    {
        $user = Auth::user();
        $selectedAddressId = $request->input('address');

        Shipping_Address::where('user_id', $user->id)->update(['is_default' => 0]);

        $address = Shipping_Address::find($selectedAddressId);
        if ($address) {
            $address->is_default = 1;
            $address->save();
        }

        return redirect('show_cart');
    }

    public function all_orders()
    {
        $user = Auth::user();

        if ($user) {
            $orders = Order::with(['shipping_address' => function ($query) {
                $query->withTrashed(); 
            }])
            ->where('user_id', $user->id)
            ->withTrashed()
            ->orderBy('id', 'desc')
            ->paginate(5);
    
            return view('home.all_orders', compact('user','orders'));
        } else {
            return  redirect('login');
        }
    }

    public function order_item($id)
    {
        $user = Auth::user();
        $order = Order::withTrashed()->where('id', $id)->first();

        if ($order && $user->id === $order->user_id) {
            $items = OrderItem::where('order_id', $order->id)
                ->orderBy('id', 'desc')
                ->get();
            return view('home.order_item', compact('user','order', 'items'));
        } else {
            abort(404);
        }
    }

    public function cancel_order($id)
    {
        $user = Auth::user();
        $order = Order::withTrashed()->where('id', $id)->first();

        if ($order && $user->id === $order->user_id) {
            
            $order->delivery_status = "Cancelled";
            $order->save();

            return redirect()->back();
        } else {
            abort(404);
        }
    }

}