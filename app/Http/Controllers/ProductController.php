<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Product_Detail;
use App\Models\Product_Gallery;

class ProductController extends Controller
{
    //Product Detail

    public function view_detail($id)
    {
        $product = Product::find($id);
        $detail = Product_Detail::find($id);
 
        return view('admin.product_detail',compact('product','detail'));
         
    }

    public function search_detail(Request $request ,$id)
    {
        $product = Product::find($id);
        $search_detail = $request->search;
        $detail = Product_Detail::where('product_id', $id)
                                ->where(function ($query) use ($search_detail) {
                                $query->where('type', 'LIKE', "%$search_detail%")
                                    ->orWhere('value', 'LIKE', "%$search_detail%")
                                    ->orWhere('language', 'LIKE', "%$search_detail%");
                                })
                                    ->paginate(6);

        return view('admin.show_detail', compact('product','detail'));
    }

    public function add_detail(Request $request)
    {
        $detail = new Product_Detail;

        $detail->product_id = $request->product_id;
        $detail->type = $request->type;
        $detail->value = $request->value;
        $detail->language = $request->language;
        $detail->is_active = $request->is_active;
        $detail->save();

        return redirect()->back();
    }

    public function show_detail($id)
    {
        $product = Product::find($id);
        $detail = Product_detail::where('product_id', $id)->paginate(6);
        
        return view('admin.show_detail', compact('product', 'detail'));
    }

    public function update_detail($id)
    {
        $detail = Product_Detail::find($id);

        return view('admin.update_detail', compact('detail'));
    }

    public function update_detail_confirm(Request $request,$id)
    {
        $detail = Product_Detail::find($id);
        
        $detail->type = $request->type;
        $detail->value = $request->value;
        $detail->language = $request->language;
        $detail->is_active = $request->is_active;
        $detail->save();

        return redirect()->back()->with('message','Detail Updated Successfully');
    }

    public function delete_detail($id)
    {
        $detail = Product_detail::find($id);
        $detail->delete();
        return redirect()->back()->with('message','Detail Deleted Successfully');
    }
    //Product Gallery
    public function view_gallery($id)
    {
        $product = Product::find($id);
        $gallery = Product_Gallery::find($id);
    
        return view('admin.product_gallery', compact('product','gallery'));
    }

    public function add_gallery(Request $request)
    {
        $id = $request->product_id;
        $this->increaseOrder($id);

        $gallery = new Product_Gallery;

        $gallery->product_id = $request->product_id;
        $gallery->image = $request->image->store('product_gallery');
        $gallery->order = $request->order;
        $gallery->is_active = $request->is_active;
        $gallery->save();
        
        return redirect()->back()->with('message', 'Gallery Added Successfully') ;
    }

    public function show_gallery($id)
    {
        $product = Product::find($id);
        $gallery = Product_Gallery::where('product_id', $id)->orderBy('order')->paginate(6);

        return view('admin.show_gallery', compact('product', 'gallery'));
    }

    public function update_gallery($id)
    {
        $gallery = Product_Gallery::find($id);

        return view('admin.update_gallery', compact('gallery'));
    }

    public function update_gallery_confirm(Request $request,$id)
    {
        $gallery = Product_Gallery::find($id);
        
        if ($request->hasFile('image')) {
            $gallery->image = $request->file('image')->store('product_gallery');
        }
        $gallery->order = $request->order;
        $gallery->is_active = $request->is_active;
        $gallery->save();

        return redirect()->back()->with('message','Gallery Updated Successfully');
    }

    public function delete_gallery($id)
    {
        $gallery = Product_Gallery::find($id);
        $productId = $gallery->product_id;
        $deletedOrder = $gallery->order;

        $gallery->delete();
        $this->Reorder($productId, $deletedOrder);

        return redirect()->back()->with('message','Gallery Deleted Successfully');
    }

    public function increaseOrder($id)
    {
        $galleries = Product_Gallery::where('product_id', $id)->get();

        foreach ($galleries as $gallery) {
            $gallery->order += 1;
            $gallery->save();
        }
    }

    public function Reorder($productId, $deletedOrder)
    {

        $galleries = Product_Gallery::where('product_id', $productId)->where('order', '>', $deletedOrder)->get();

        foreach ($galleries as $gallery) {
            $gallery->order--;
            $gallery->save();
        }

    }

}
