<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Product_Gallery;


class ChangeOrderController extends Controller
{
     //Order of Brand
    public function  brand_arrow_down($id)
    {
        
        $brand = Brand::findOrFail($id);
        $nextBrand = Brand::where('order', '>', $brand->order)->orderBy('order')->first();
        $brand->order++;

    
        if ($nextBrand) {
            $nextBrand->order--;
            
            $brand->save();
            $nextBrand->save();

            
            return response()->json(['success' => true], 200);
        }
        
        return response()->json(['success' => false], 404);

    }

    public function  brand_arrow_up($id)
    {
        $brand = Brand::findOrFail($id);
        $previousBrand = Brand::where('order', '<', $brand->order)->orderBy('order','desc')->first();
        $brand->order--;
    
        if ($previousBrand) {
            $previousBrand->order++;
            
            $brand->save();
            $previousBrand->save();

            
            return response()->json(['success' => true], 200);
        }
        
        return response()->json(['success' => false], 404);

    }

    //Order of Gallery
    public function gallery_arrow_down($id)
    {
        $gallery = Product_Gallery::findOrFail($id);
        $nextGallery = Product_Gallery::where('product_id', $gallery->product_id)
                                    ->where('order', '>', $gallery->order)
                                    ->orderBy('order')
                                    ->first();
        
        if ($nextGallery) {
            $nextGallery->order--;
            $gallery->order++;
            
            $gallery->save();
            $nextGallery->save();
            
            return response()->json(['success' => true], 200);
        }
        
        return response()->json(['success' => false], 404);
    }


    public function gallery_arrow_up($id)
    {
        $gallery = Product_Gallery::findOrFail($id);
        $previousGallery = Product_Gallery::where('product_id', $gallery->product_id)
                                        ->where('order', '<', $gallery->order)
                                        ->orderBy('order', 'desc')
                                        ->first();
        
        if ($previousGallery) {
            $previousGallery->order++;
            $gallery->order--;
            
            $gallery->save();
            $previousGallery->save();
            
            return response()->json(['success' => true], 200);
        }
        
        return response()->json(['success' => false], 404);
    }

}
