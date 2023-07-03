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
use Carbon\Carbon;




class HomeController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        $product = Product::orderBy('id', 'desc')->paginate(6);

        $product = Product::where('is_highlight', '1')->where('is_active', '1')->where('start_display', '<=', $now)
        ->where(function ($query) use ($now) {
            $query->where('end_display', '>', $now)
                ->orWhereNull('end_display');
        })->orderBy('id', 'desc')->paginate(6);
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
            return view('admin.home');
        }
        else
        {
            $product = Product::where('is_highlight', '1')->where('is_active', '1')->where('start_display', '<=', $now)
            ->where(function ($query) use ($now) {
                $query->where('end_display', '>', $now)
                    ->orWhereNull('end_display');
            })->paginate(6);
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
        $product = Product::where('brand_id', $id)->where('start_display', '<=', $now)
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
        $product = Product::where('category_id', $id)->where('start_display', '<=', $now)
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
        $product = Product::where('size_id', $id)->where('start_display', '<=', $now)
        ->where(function ($query) use ($now) {
            $query->where('end_display', '>', $now)
                ->orWhereNull('end_display');
        })->paginate(6);

        return view('home.size_product', compact('size', 'product'));
    }

    public function add_cart($id)
    {
        if(Auth::id())
        {
            return redirect()->back();
        }

        else
        {
            return redirect('login');
        }
    }


}
