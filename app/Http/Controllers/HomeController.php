<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Size;
use App\Models\Product_Detail;
use App\Models\Product_Gallery;
use App\Models\Shipping_address;
use App\Models\Order;

use Carbon\Carbon;




class HomeController extends Controller
{
    public function index()
    {
        $product = Product::where('is_highlight', '1')->where(function($productQuery){
            $productQuery->Published();
        })->orderBy('id','desc')->paginate(6);
        $category = Category::all();
        $category->load('products');


        return view('home.userpage',compact('product','category'));
    }
    
    public function redirect()
    {
        $now = Carbon::now();

        $usertype=Auth::user()->usertype;

        if($usertype=='1')
        {
            $total_product = Product::All()->count();
            $total_order = Order::withTrashed()->count();
            $total_user = User::All()->count();
            $order = Order::withTrashed()->get();
            $total_revenue = 0;
            foreach($order as $order)
            {
                $total_revenue = $total_revenue + $order->total_price;
            }
            $total_delivered = Order::withTrashed()->where('delivery_status','=','Delivered')->get()->count();
            $total_outofdelivery = Order::withTrashed()->where('delivery_status','=','Out of delivery')->get()->count();
            $total_processing = Order::withTrashed()->where('delivery_status','=','Processing')->get()->count();
            $total_returned = Order::withTrashed()->where('delivery_status','=','Returned')->get()->count();
            $total_cancelled = Order::withTrashed()->where('delivery_status','=','Cancelled')->get()->count();



            return view('admin.home' , compact('total_product','total_order','total_user','total_revenue'
            ,'total_delivered','total_outofdelivery','total_processing','total_returned','total_cancelled'));
        }

        else
        {
            $product = Product::where('is_highlight', '1')->where(function($productQuery){
                $productQuery->Published();
            })->orderBy('id','desc')->paginate(6);
            $category = Category::all();
            $category->load('products');
    

            return view('home.userpage',compact('product','category'));
        }
    }

    public function all_products()
    {
        $product = Product::where(function($productQuery){
            $productQuery->Published();
        })
        ->orderBy('id','desc')->paginate(6);

        return view('home.all_products',compact('product'));
    }

    public function product_detail($id)
    {
        $product = Product::find($id);
        $details = Product_detail::where('product_id', $id)->get();
        $gallery = Product_Gallery::where('product_id', $id)->get();
        
        return view('home.product_detail',compact('product','details','gallery'));
    }

    public function all_brands()
    {
        $brand = Brand::where('is_active', '1')
        ->whereHas('products', function( $productQuery ){
            $productQuery->Published();
        })
        ->orderBy('order','asc')
        ->paginate(6);
      
        return view('home.all_brands',compact('brand'));
    }

    public function brand_product($id)
    {
        $now = Carbon::now();

        $brand = Brand::find($id);
        
        $product = Product::where('brand_id', $id)
                            ->where('amount', '!=', 0)
                            ->where('start_display', '<=', $now)
                            ->where(function ($query) use ($now) {
                                $query->where('end_display', '>', $now)
                                    ->orWhereNull('end_display');
                            })->paginate(6);

        return view('home.brand_product', compact('brand', 'product'));
    }

    public function all_categories()
    {
        $category = Category::where('is_active', '1')
        ->whereHas('products', function( $productQuery){
            $productQuery->published();
        })
        ->paginate(6);


        return view('home.all_categories',compact('category'));
    }
    
    public function category_product($id)
    {
        $now = Carbon::now();
        $category = Category::find($id);
        $product = Product::where('category_id', $id)
                            ->where('amount', '!=', 0)
                            ->where('start_display', '<=', $now)
                            ->where(function ($query) use ($now) {
                                $query->where('end_display', '>', $now)
                                    ->orWhereNull('end_display');
                            })->paginate(6);

        return view('home.category_product', compact('category', 'product'));
    }

    public function all_sizes()
    {
        $size = Size::where('is_active', '1')
        ->whereHas('products', function ($productQuery) {
            $productQuery->Published();
        })
        ->paginate(6);

        return view('home.all_sizes',compact('size'));
    }

    public function size_product($id)
    {
        $now = Carbon::now();

        $size = Size::find($id);
        $product = Product::where('size_id', $id)
                            ->where('amount', '!=', 0)
                            ->where('start_display', '<=', $now)
                            ->where(function ($query) use ($now) {
                                $query->where('end_display', '>', $now)
                                    ->orWhereNull('end_display');
                            })->paginate(6);

        return view('home.size_product', compact('size', 'product'));
    }



    public function all_addresses()
    {
        if(Auth::id())
        {
            $user = auth()->user();
            $address = Shipping_address::where('user_id' , $user->id)->orderBy('id','desc')->paginate(5);

            if ($address->isEmpty()) {
                return view('home.all_address_empty');
            }

            return view('home.all_address', compact('address'));
        }
        else{

            return redirect('login');
        }
    }

    public function shipping_address(Request $request, $cart = null){
        if(Auth::id())
        {
            return view('home.shipping_address')->with(['cart' => $cart]);
        }

        else
        {
            return redirect('login');
        }
    }

    

    public function add_shipping(Request $request)
    {
        if(Auth::check()) {
            $user = Auth::user();
            $address = new Shipping_address;

            // Check if the address already exists
            $existingAddress = Shipping_address::where('user_id', $user->id)
            ->where('address', $request->address)
            ->where('phone', $request->phone)
            ->first();

            if ($existingAddress) {
                return response()->json([
                    'success' => false,
                    'message' => 'You already have this address.'
                ]);
            }

            $address->user_id = $user->id;
            $address->address = $request->address;
            $address->Phone = $request->phone;
            if ($request->is_default == 1) {
                Shipping_address::where('user_id', $user->id)->update(['is_default' => 0]);
                $address->is_default = 1;
            } else {
                $address->is_default = 0;
            }            
            $address->save();
            
            return response()->json([
                'success' => true,
                'cart' => $request->cart
            ]);
        }
        else {
            return redirect('login');
        }
    }


    public function update_address($id)
    {
        $address= Shipping_address::find($id);
      
        return view('home.update_address', compact('address'));
    }

    
    public function update_address_confirm(Request $request,$id)
    {
        
        $user = Auth::user();
        $address = Shipping_Address::find($id);

        $address->address = $request->address;
        $address->Phone = $request->phone;
        if ($request->is_default == 1) {
            Shipping_address::where('user_id', $user->id)->update(['is_default' => 0]);
            $address->is_default = 1;
        } else {
            $address->is_default = 0;
        }       
        $address->save();
        
        return redirect()->back();
    }

    public function delete_address($id)
    {
        $address = Shipping_address::find($id);
        $address->delete();

        return redirect()->back()->with('message','Size Deleted Successfully');
    }

}
