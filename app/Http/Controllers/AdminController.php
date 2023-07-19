<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Size;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment_log;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class AdminController extends Controller
{
    //Categories
    public function view_category()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if($user->usertype == 1){
                $data = Category::orderBy('id', 'desc')->paginate(6);

                return view('admin.category',compact('data'));
            }
            else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    public function add_category_page()
    {
        $user = Auth::user();
        if($user->usertype == 1){
            return view('admin.add_category');
        }
        else{
            abort(404);
        }
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

        return redirect()->back();

    }

    public function update_category($id)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $data= Category::find($id);
            if($user->usertype == 1){
                return view('admin.update_category', compact('data'));
            }
            else{
                abort(404);
            }
        } else {
            abort(404);
        }
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
        if (Auth::check()) {
            $user = Auth::user();
            if($user->usertype == 1){
                $size = Size::orderBy('id', 'desc')->paginate(6);

                return view('admin.size',compact('size'));
            }
            else{
                abort(404);
            }
        } else {
            abort(404);
        }   
    }

    public function add_size_page()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if($user->usertype == 1){
                return view('admin.add_size');
            }
            else{
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    public function add_size(Request $request)
    {
        $size = new Size;

        $size->size = $request->size;
        $size->is_active = $request->is_active;
        $size->save();

        
        return redirect()->back();
    }

    
    public function update_size($id)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if($user->usertype == 1){
                $size = Size::find($id);
        
                return view('admin.update_size', compact('size'));
            }
            else{
                abort(404);
            }
        } else{
            abort(404);
        }
    }

    public function update_size_confirm(Request $request,$id)
    {
        $size = Size::find($id);
        
        $size->size = $request->size;
        $size->is_active = $request->is_active;  
        $size->save();

        return redirect()->back();
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
        if (Auth::check()) {
            $user = Auth::user();
            if($user->usertype == 1){
                $brand = Brand::orderBy('order')->paginate(6);
                return view('admin.brand',compact('brand'));
            }
            else{
                abort(404);
            }
        } else{
            abort(404);
        }
    }

    public function add_brand_page()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if($user->usertype == 1){
                return view('admin.add_brand');
            }
            else{
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    public function add_brand(Request $request)
    {
        $this->increaseOrder();

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
        if (Auth::check()) {
            $user = Auth::user();
            if($user->usertype == 1){
                $brand= Brand::find($id);
        
                return view('admin.update_brand', compact('brand'));
            }
            else{
                abort(404);
            }
        } else{
            abort(404);
        }
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
        
        return redirect()->back();
    }


    public function delete_brand($id)
    {
        $brand = Brand::find($id);
        $order = $brand->order;
        Brand::where('order', '>', $order)->decrement('order');
        $brand->delete();
        
        return redirect()->back()->with('message','Brand Deleted Successfully');
    }

    //Products
    public function view_product()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if($user->usertype == 1){
                $category = Category::all();
                $brand = Brand::all();
                $size = Size::all();


                return view('admin.product', compact('category','brand','size'));
            }
            else{
                abort(404);
            }
        } else{
            abort(404);
        }
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
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->usertype == 1) {
                $product = Product::orderBy('id', 'desc')->paginate(6);
                return view('admin.show_product', compact('product'));
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
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

    public function increaseOrder()
    {
        $brand = Brand::all();

        foreach ($brand as $brand) {
            $brand->order += 1;
            $brand->save();
        }
    }

    public function show_order()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if($user->usertype == 1 ){
                $order = Order::with(['shipping_address' => function ($query) {
                    $query->withTrashed(); 
                }])
                ->withTrashed()
                ->orderBy('id', 'desc')
                ->paginate(6);

                return view('admin.show_order',compact('order'));
            }
            else{
                abort(404);
            }
        } else{
            abort(404);
        }
    }

    public function all_order_item($id)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $order = Order::withTrashed()->where('id', $id)->first();
            if($user->usertype == 1){
                $items = OrderItem::where('order_id', $order->id)
                    ->orderBy('id', 'desc')
                    ->get();
                return view('admin.all_order_item', compact('order', 'items'));
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    public function out_of_delivery($id)
    {
        $order = Order::withTrashed()->where('id', $id)->first();
        $order->delivery_status = "Out of delivery";
        $order->save();

        return redirect()->back();
    }

    public function delivered($id)
    {
        $order = Order::withTrashed()->where('id', $id)->first();
        if($order->payment_status == "Cash On Delivery"){
            $order->delivery_status = "Delivered";
            $order->payment_status= "Paid";
            $order->save();
        }
        else{
            $order->delivery_status = "Delivered";
            $order->save();
        }
        return redirect()->back();
    }

    public function returned($id)
    {
        $order = Order::withTrashed()->where('id', $id)->first();
        $order->delivery_status = "Returned";
        $order->save();

        return redirect()->back();
    }

    public function cancelled($id)
    {
        $order = Order::withTrashed()->where('id', $id)->first();
        $order->delivery_status = "Cancelled";
        $order->save();

        return redirect()->back();
    }

    

    public function view_slip($id)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $order = Order::withTrashed()->where('id', $id)->first();

            if($user->usertype == 1){
                $slip = Payment_log::where('order_id', $order->id)
                    ->orderBy('id', 'desc')
                    ->get();
                return view('admin.view_slip', compact('order', 'slip'));
            } else {
                abort(404);
            }
        } else{
            abort(404);
        }
    }

    public function approved($id)
    {
        $order = Order::withTrashed()->where('id', $id)->first();
        $order->payment_status = "Payment verified";
        $order->save();

        return redirect()->back();
    }

    public function print_pdf($id)
    {
        $order = Order::withTrashed()->where('id', $id)->first();
        $items = OrderItem::where('order_id', $order->id)
                            ->orderBy('id', 'desc')
                            ->get();
        $pdf = PDF::loadView('admin.pdf', compact('order','items'));
        return $pdf->download('order_detail.pdf');
    }
   
    public function add_tracking_no(Request $request,$id)
    {
        $order = Order::withTrashed()->where('id', $id)->first();

        $order->tracking_no = $request->tracking_no;
        $order->delivery_status = "Out of delivery";
        $order->save();
        return redirect()->back()->with('message', 'Add tracking no. successfully');
    }

    //Search Function

    public function search_order(Request $request)
    {
        $search_order = $request->search;   
        $order = Order::withTrashed(['user','shipping_address'])->where('order_no','LIKE', "%$search_order%")
                                    ->orWhere('total_price','LIKE', "%$search_order%")
                                    ->orWhere('tracking_no','LIKE', "%$search_order%")
                                    ->orWhere('delivery_status','LIKE', "%$search_order%")
                                    ->orWhere('payment_status','LIKE', "%$search_order%")
                                    ->orWhereHas('user', function ($query) use ($search_order) {
                                        $query->where('name', 'LIKE', "%$search_order%");
                                    })
                                    ->orWhereHas('shipping_address', function ($query) use ($search_order) {
                                        $query->where('address', 'LIKE', "%$search_order%");
                                    })
                                    ->orWhereHas('shipping_address', function ($query) use ($search_order) {
                                        $query->where('Phone', 'LIKE', "%$search_order%");
                                    })
                                    ->paginate(6);

        return view('admin.show_order' ,compact('order'));
    }

    public function search_product(Request $request)
    {
        $search_product = $request->search;
        $product = Product::with(['brand','size','category'])
                            ->where('name','LIKE',"%$search_product%")
                            ->orWhere('price_normal','LIKE',"%$search_product%")
                            ->orWhere('price_member','LIKE',"%$search_product%")
                            ->orWhereHas('brand', function ($query) use ($search_product) {
                                $query->where('name', 'LIKE', "%$search_product%");
                            })
                            ->orWhereHas('category', function ($query) use ($search_product) {
                                $query->where('name', 'LIKE', "%$search_product%");
                            })
                            ->orWhereHas('size', function ($query) use ($search_product) {
                                $query->where('size', 'LIKE', "%$search_product%");
                            })
                            ->paginate(6);

        return view('admin.show_product', compact('product'));

    }

    public function search_category(Request $request)
    {
        $search_category = $request->search;
        $data = Category::where('name','LIKE',"%$search_category%")
                            ->paginate(6);

        return view('admin.category', compact('data'));
    }

    public function search_size(Request $request)
    {
        $search_size = $request->search;
        $size = Size::where('size','LIKE',"%$search_size%")
                            ->paginate(6);

        return view('admin.size', compact('size'));
    }

    public function search_brand(Request $request)
    {
        $search_brand = $request->search;
        $brand = Brand::where('name','LIKE',"%$search_brand%")
                            ->orWhere('order','LIKE',"%$search_brand%")
                            ->paginate(6);

        return view('admin.brand', compact('brand'));
    }

}
