<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Size;
use App\Models\Brand;
use App\Models\Product;


class AdminController extends Controller
{
    public function view_category()
    {
        $data = Category::all();

        return view('admin.category',compact('data'));
    }

    public function add_category(Request $request)
    {
        $data = new Category;

        $data->name = $request->name;
        $data->image = $request->image->store('category');
        $data->amount = $request->amount;
        $data->is_display_homepage = $request->is_display_homepage;
        $data->is_active = $request->is_active;
        $data->save();

        return redirect()->back()->with('message', 'Category Added Successfully');

    }

    public function delete_category($id)
    {
        $data = Category::find($id);
        $data->delete();
        return redirect()->back()->with('message','Category Deleted Successfully');
    }

    public function view_size()
    {
        $size = Size::all();

        return view('admin.size',compact('size'));
    }

    public function add_size(Request $request)
    {
        $size = new Size;

        $size->size = $request->size;
        $size->is_active = $request->is_active;
        $size->save();
        return redirect()->back()->with('message', 'Size Added Successfully');

    }

    public function delete_size($id)
    {
        $size = Size::find($id);
        $size->delete();
        return redirect()->back()->with('message','Size Deleted Successfully');
    }

    public function view_brand()
    {
        $brand = Brand::all();

        return view('admin.brand',compact('brand'));
    }

    public function add_brand(Request $request)
    {
        $brand = new Brand;

        $brand->name = $request->name;
        $brand->amount = $request->amount;
        $brand->image = $request->image->store('image');
        $brand->order = $request->order;
        $brand->is_active = $request->is_active;
        $brand->save();
        return redirect()->back()->with('message', 'Brand Added Successfully');

    }

    public function delete_brand($id)
    {
        $brand = Brand::find($id);
        $brand->delete();
        return redirect()->back()->with('message','Brand Deleted Successfully');
    }

    public function view_product()
    {
        $category = Category::all();
        $brand = Brand::all();
        $size = Size::all();


        return view('admin.product', compact('category','brand','size'));
    }

    public function add_product(Request $request)
    {
        $product = new Product;

        $product->name = $request->name;
        $product->price_normal = $request->price_normal;
        $product->price_member = $request->price_member;
        $product->brand_id = $request->brand;
        $product->category_id = $request->category;
        $product->size_id = $request->size;
        $product->amount = $request->amount;
        $product->image = $request->image->store('product');
        $product->start_display = $request->start_display;
        $product->end_display = $request->end_display;
        $product->is_highlight = $request->is_highlight;
        $product->is_active = $request->is_active;
        $product->save();

        return redirect()->back()->with('message', 'Category Added Successfully') ;
    }

    public function show_product()
    {
        $product = Product::all();

        return view('admin.show_product', compact('product'));
    }

    public function update_product($id)
    {
        $product = Product::find($id);
        $category = Category::all();
        $brand = Brand::all();
        $size = Size::all();

        return view('admin.update_product', compact('product','category','brand','size'));
    }

    public function delete_product($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->back()->with('message','Product Deleted Successfully');
    }

    public function update_product_confirm(Request $request,$id)
    {
        $product = Product::find($id);
        
        $product->name = $request->name;
        $product->price_normal = $request->price_normal;
        $product->price_member = $request->price_member;
        $product->brand_id = $request->brand;
        $product->category_id = $request->category;
        $product->size_id = $request->size;
        $product->amount = $request->amount;
        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('product');
        } 
        $product->start_display = $request->start_display;
        $product->end_display = $request->end_display;
        $product->is_highlight = $request->is_highlight;
        $product->is_active = $request->is_active;
        $product->save();

        return redirect()->back()->with('message','Product Updated Successfully');
    }
}
