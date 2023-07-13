<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ChangeOrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

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
Route::get('/all_products', [HomeController::class, 'all_products'])->name('all_products');
Route::get('/product_detail/{id}', [HomeController::class, 'product_detail'])->where('id', '[0-9]+')->name('product_detail');
Route::get('/all_brands', [HomeController::class, 'all_brands'])->name('all_brands');
Route::get('/brand_product/{id}',[HomeController::class,'brand_product'])->where('id', '[0-9]+')->name('brand_product');
Route::get('/all_categories', [HomeController::class, 'all_categories'])->name('all_categories');
Route::get('/category_product/{id}',[HomeController::class,'category_product'])->where('id', '[0-9]+')->name('category_product');
Route::get('/all_sizes', [HomeController::class, 'all_sizes'])->name('all_sizes');
Route::get('/size_product/{id}',[HomeController::class,'size_product'])->where('id', '[0-9]+')->name('size_product');
Route::get('/shipping_address', [HomeController::class, 'shipping_address'])->name('shipping_address');
Route::post('/add_shipping',[HomeController::class,'add_shipping'])->name('add_shipping');
Route::get('/all_addresses', [HomeController::class, 'all_addresses'])->name('all_addresses');

Route::get('/delete_address/{id}', [HomeController::class, 'delete_address'])->where('id', '[0-9]+')->name('delete_address');
Route::get('/update_address/{id}',[HomeController::class,'update_address'])->where('id', '[0-9]+')->name('update_address');
Route::post('/update_address_confirm/{id}', [HomeController::class, 'update_address_confirm'])->where('id', '[0-9]+')->name('update_address_confirm');


//Cart
Route::post('/add_cart/{id}',[CartController::class,'add_cart'])->where('id', '[0-9]+')->name('add_cart');
Route::get('/show_cart', [CartController::class, 'show_cart'])->name('show_cart');
Route::post('/update_quantity',[CartController::class,'update_quantity'])->name('update_quantity');
Route::get('/delete_cart/{id}', [CartController::class, 'delete_cart'])->where('id', '[0-9]+')->name('delete_cart');

//Order
Route::get('/cash_order', [OrderController::class, 'cash_order'])->name('cash_order');
Route::get('/pay_qrcode', [OrderController::class, 'pay_qrcode'])->name('pay_qrcode');
Route::post('/payment_log',[OrderController::class,'payment_log'])->name('payment_log');
Route::get('/select_address', [OrderController::class, 'select_address'])->name('select_address');
Route::post('/select_address_confirm', [OrderController::class, 'select_address_confirm'])->name('select_address_confirm');























