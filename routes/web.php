<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ChangeOrderController;


use Illuminate\Http\Request;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Default Form Laravel
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[HomeController::class,'index'])->name('index');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/redirect',[HomeController::class,'redirect'])->name('redirect');


///ALL OF ADMIN///
// Category
Route::get('/view_category',[AdminController::class,'view_category'])->name('view_category');
Route::post('/add_category',[AdminController::class,'add_category'])->name('add_category');
Route::get('/update_category/{id}',[AdminController::class,'update_category'])->where('id', '[0-9]+')->name('update_category');
Route::post('/update_category_confirm/{id}', [AdminController::class, 'update_category_confirm'])->where('id', '[0-9]+')->name('update_category_confirm');
Route::get('/delete_category/{id}',[AdminController::class,'delete_category'])->where('id', '[0-9]+')->name('delete_category');


// Size
Route::get('/view_size',[AdminController::class,'view_size'])->name('view_size');
Route::post('/add_size',[AdminController::class,'add_size'])->name('add_size');
Route::get('/update_size/{id}',[AdminController::class,'update_size'])->where('id', '[0-9]+')->name('update_size');
Route::post('/update_size_confirm/{id}', [AdminController::class, 'update_size_confirm'])->where('id', '[0-9]+')->name('update_size_confirm');
Route::get('/delete_size/{id}',[AdminController::class,'delete_size'])->where('id', '[0-9]+')->name('delete_size');

// Brand
Route::get('/view_brand',[AdminController::class,'view_brand'])->name('view_brand');
Route::post('/add_brand',[AdminController::class,'add_brand'])->name('add_brand');
Route::get('/update_brand/{id}',[AdminController::class,'update_brand'])->where('id', '[0-9]+')->name('update_brand');
Route::post('/update_brand_confirm/{id}', [AdminController::class, 'update_brand_confirm'])->where('id', '[0-9]+')->name('update_brand_confirm');
Route::get('/delete_brand/{id}',[AdminController::class,'delete_brand'])->where('id', '[0-9]+')->name('delete_brand');


// Product
Route::get('/view_product',[AdminController::class,'view_product'])->name('view_product');
Route::post('/add_product',[AdminController::class,'add_product'])->name('add_product');
Route::get('/show_product',[AdminController::class,'show_product'])->name('show_product');
Route::get('/update_product/{id}',[AdminController::class,'update_product'])->where('id', '[0-9]+')->name('update_product');
Route::post('/update_product_confirm/{id}', [AdminController::class, 'update_product_confirm'])->where('id', '[0-9]+')->name('update_product_confirm');
Route::get('/delete_product/{id}',[AdminController::class,'delete_product'])->where('id', '[0-9]+')->name('delete_product');

//Product Detail
Route::get('/view_detail/{id}',[ProductController::class,'view_detail'])->where('id', '[0-9]+')->name('view_detail');
Route::post('/add_detail',[ProductController::class,'add_detail'])->name('add_detail');
Route::get('/show_detail/{id}',[ProductController::class,'show_detail'])->where('id', '[0-9]+')->name('show_detail');
Route::get('/update_detail/{id}',[ProductController::class,'update_detail'])->where('id', '[0-9]+')->name('update_detail');
Route::post('/update_detail_confirm/{id}', [ProductController::class, 'update_detail_confirm'])->where('id', '[0-9]+')->name('update_detail_confirm');
Route::get('/delete_detail/{id}', [ProductController::class, 'delete_detail'])->where('id', '[0-9]+')->name('delete_detail');

//Product Gallery
Route::get('/view_gallery/{id}',[ProductController::class,'view_gallery'])->where('id', '[0-9]+')->name('view_gallery');
Route::post('/add_gallery',[ProductController::class,'add_gallery'])->name('add_gallery');
Route::get('/show_gallery/{id}',[ProductController::class,'show_gallery'])->where('id', '[0-9]+')->name('show_gallery');
Route::get('/update_gallery/{id}',[ProductController::class,'update_gallery'])->where('id', '[0-9]+')->name('update_gallery');
Route::post('/update_gallery_confirm/{id}', [ProductController::class, 'update_gallery_confirm'])->where('id', '[0-9]+')->name('update_gallery_confirm');
Route::get('/delete_gallery/{id}', [ProductController::class, 'delete_gallery'])->where('id', '[0-9]+')->name('delete_gallery');

//Change Order
Route::post('/brand_arrow_down/{id}', [ChangeOrderController::class, 'brand_arrow_down'])->where('id', '[0-9]+')->name('brand_arrow_down');
Route::post('/brand_arrow_up/{id}', [ChangeOrderController::class, 'brand_arrow_up'])->where('id', '[0-9]+')->name('brand_arrow_up');
Route::post('/gallery_arrow_down/{id}', [ChangeOrderController::class, 'gallery_arrow_down'])->where('id', '[0-9]+')->name('gallery_arrow_down');
Route::post('/gallery_arrow_up/{id}', [ChangeOrderController::class, 'gallery_arrow_up'])->where('id', '[0-9]+')->name('gallery_arrow_up');


//ALL OF USERS
Route::get('/product_detail/{id}', [HomeController::class, 'product_detail'])->where('id', '[0-9]+')->name('product_detail');
Route::post('/add_cart/{id}',[HomeController::class,'add_cart'])->where('id', '[0-9]+')->name('add_cart');
Route::get('/all_brands', [HomeController::class, 'all_brands'])->name('all_brands');
Route::get('/brand_product/{id}',[HomeController::class,'brand_product'])->where('id', '[0-9]+')->name('brand_product');


















