<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;


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

Route::get('/',[HomeController::class,'index']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/redirect',[HomeController::class,'redirect']);

// Category
Route::get('/view_category',[AdminController::class,'view_category']);
Route::post('/add_category',[AdminController::class,'add_category']);
Route::get('/delete_category/{id}',[AdminController::class,'delete_category']);

// Size
Route::get('/view_size',[AdminController::class,'view_size']);
Route::post('/add_size',[AdminController::class,'add_size']);
Route::get('/delete_size/{id}',[AdminController::class,'delete_size']);

// Brand
Route::get('/view_brand',[AdminController::class,'view_brand']);
Route::post('/add_brand',[AdminController::class,'add_brand']);
Route::get('/delete_brand/{id}',[AdminController::class,'delete_brand']);


// Product
Route::get('/view_product',[AdminController::class,'view_product']);
Route::post('/add_product',[AdminController::class,'add_product']);
Route::get('/show_product',[AdminController::class,'show_product']);
Route::get('/update_product/{id}',[AdminController::class,'update_product']);
Route::get('/delete_product/{id}',[AdminController::class,'delete_product']);
Route::post('/update_product_confirm/{id}', [AdminController::class, 'update_product_confirm']);











