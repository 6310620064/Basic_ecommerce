<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Size;
use App\Models\Brand;
use App\Models\Product;
use RealRashid\SweetAlert\Facades\Alert;


class AdminController extends Controller
{
    //Categories
    public function view_category()
    {

        $datas = Category::paginate(6);

        return view('admin.category',compact('datas'));
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

        Alert::success('Category Added Successfully','We have added category to the database');
        return redirect()->back();

    }

    public function update_category($id)
    {
        $data= Category::find($id);


        return view('admin.update_category', compact('data'));
    }

    public function update_category_confirm(Request $request,$id)
    {
        $data = Category::find($id);
        
        $data->name = $request->name;
        if ($request->hasFile('image')) {
            $data->image = $request->file('image')->store('category');
        } 
        $data->is_display_homepage = $request->is_display_homepage;
        $data->is_active = $request->is_active;
        $data->save();

        return redirect()->back();
    }

    public function delete_category($id)
    {
        $data = Category::find($id);
        $data->delete();
        return redirect()->back()->with('message','Category Deleted Successfully');
    }

    //Sizes
    public function view_size()
    {
        
        $sizes = Size::paginate(6);

        return view('admin.size',compact('sizes'));
    }

    public function add_size(Request $request)
    {
        $size = new Size;

        $size->size = $request->size;
        $size->is_active = $request->is_active;
        $size->save();

        
        return redirect()->back()->with('message','Size Added Successfully');
    }

    
    public function update_size($id)
    {
        $size = Size::find($id);
      
        return view('admin.update_size', compact('size'));
    }

    public function update_size_confirm(Request $request,$id)
    {
        $size = Size::find($id);
        
        $size->size = $request->size;
        $size->is_active = $request->is_active;  
        $size->save();

        return redirect()->back()->with('message','Size Updated Successfully');
    }


    public function delete_size($id)
    {
        $size = Size::find($id);
        $size->delete();

        return redirect()->back()->with('message','Size Deleted Successfully');
    }

    //Brands
    public function view_brand()
    {
        $brands = Brand::paginate(6);
        return view('admin.brand',compact('brands'));
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

        return redirect()->back();

    }

    
    public function update_brand($id)
    {
        $brand= Brand::find($id);
      
        return view('admin.update_brand', compact('brand'));
    }

    
    public function update_brand_confirm(Request $request,$id)
    {
        $brand = Brand::find($id);

        $brand->name = $request->name;
        if ($request->hasFile('image')) {
            $brand->image = $request->file('image')->store('brand');
        } 
        $brand->order = $request->order;
        $brand->is_active = $request->is_active;
        $brand->save();
        
        return redirect()->back()->with('message','Brand Updated Successfully');
    }


    public function delete_brand($id)
    {
        $brand = Brand::find($id);
        $brand->delete();
        return redirect()->back()->with('message','Brand Deleted Successfully');
    }

    //Products
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
        $products = Product::paginate(6);

        return view('admin.show_product', compact('products'));
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
