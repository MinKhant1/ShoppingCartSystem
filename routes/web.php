<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home');
});


//admin

Route::get('/addproduct',[ProductController::class,'addproduct'])->name('addproduct');
Route::get('/productlist',[ProductController::class,'productlist'])->name('productlist');
Route::post('saveproduct',[ProductController::class,'saveproduct'])->name('saveproduct');
Route::get('deleteproduct/{id}',[ProductController::class,'deleteproduct']);
Route::get('editproduct/{id}',[ProductController::class,'editproduct']);
Route::post('updateproduct',[ProductController::class,'updateproduct']);





//user

Route::get('/products',[ProductController::class,'products'])->name('products');








Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
