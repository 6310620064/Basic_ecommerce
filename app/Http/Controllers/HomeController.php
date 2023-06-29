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
        $product = Product::where('is_highlight', '1')->where('is_active', '1')->paginate(6);
        $category = Category::all();
        $category->load('products');


        return view('home.userpage',compact('product','category'));
    }
    
    public function redirect()
    {
        $usertype=Auth::user()->usertype;

        if($usertype=='1')
        {
            return view('admin.home');
        }
        else
        {
            $product = Product::where('is_highlight', '1')->where('is_active', '1')->paginate(6);
            $category = Category::all();
            $category->load('products');

            return view('home.userpage',compact('product','category'));
        }
    }

    public function all_products()
    {
        $now = Carbon::now();
        $product = Product::where('is_active', '1')
        ->where('start_display', '<=', $now)
        ->where(function ($query) use ($now) {
            $query->where('end_display', '>', $now)
                ->orWhereNull('end_display');
        })
        ->paginate(6);

        return view('home.all_products',compact('product'));
    }

    public function product_detail($id)
    {
        $product = Product::find($id);
        $detail = Product_detail::where('product_id', $id)->get();
        $gallery = Product_Gallery::where('product_id', $id)->get();

        return view('home.product_detail',compact('product','detail','gallery'));
    }

    public function all_brands()
    {
        $brand = Brand::where('is_active', '1')->orderBy('order')->paginate(6);
        $brand->load('products');

        return view('home.all_brands',compact('brand'));
    }

    public function brand_product($id)
    {
        $brand = Brand::find($id);
        $product = Product::where('brand_id', $id)->paginate(6);

        return view('home.brand_product', compact('brand', 'product'));
    }

    public function all_categories()
    {
        $category = Category::where('is_active', '1')->paginate(6);
        $category->load('products');


        return view('home.all_categories',compact('category'));
    }
    
    public function category_product($id)
    {
        $category = Category::find($id);
        $product = Product::where('category_id', $id)->paginate(6);

        return view('home.category_product', compact('category', 'product'));
    }

    public function all_sizes()
    {
        $size = Size::where('is_active', '1')->paginate(6);
        $size->load('products');


        return view('home.all_sizes',compact('size'));
    }

    public function size_product($id)
    {
        $size = Size::find($id);
        $product = Product::where('size_id', $id)->paginate(6);

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
