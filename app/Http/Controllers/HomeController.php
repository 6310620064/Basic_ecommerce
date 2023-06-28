<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Product_Detail;
use App\Models\Product_Gallery;



class HomeController extends Controller
{
    public function index()
    {
        $product = Product::where('is_active', '1')->paginate(6);

        return view('home.userpage',compact('product'));
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
            $product = Product::where('is_active', '1')->paginate(6);

            return view('home.userpage',compact('product'));
        }
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
        $brand = Brand::orderBy('order')->paginate(6);

        return view('home.all_brands',compact('brand'));
    }

    public function brand_product($id)
    {
        $brand = Brand::find($id);
        $product = Product::where('brand_id', $id)->paginate(6);

        return view('home.brand_product', compact('brand', 'product'));
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
