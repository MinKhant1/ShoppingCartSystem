<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DeliveryMethodController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Models\DeliveryMethod;
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
Route::get('/single_product/{id}',[ProductController::class,'single_product']);
//category
Route::get('/products/{category}',[ProductController::class,'category'])->name('category');


//cart
Route::get('/cart',[CartController::class,'cart'])->name('cart');
Route::post('/add_to_cart',[CartController::class,'add_to_cart'])->name('add_to_cart');
Route::get('/add_to_cart',function()
{
return redirect('/');
}
);

Route::post('/remove_from_cart',[CartController::class,'remove_from_cart'])->name('remove_from_cart');
Route::get('/remove_from_cart',function()
{
return redirect('/');
}
);

Route::post('/edit_product_quantity',[CartController::class,'edit_product_quantity'])->name('edit_product_quantity');
Route::get('/edit_product_quantity',function()
{
return redirect('/');
}
);
Route::get('/check_out',[CartController::class,'check_out'])->name('check_out');

Route::get('/order_detail',[CartController::class,'order_detail'])->name('order_detail');


//export pdf
Route::get('/index', [App\Http\Controllers\PdfController::class, 'index']);
Route::get('/view_pdf/{id}', [App\Http\Controllers\PdfController::class, 'view_pdf'])->name('view_pdf');


//delivery method

Route::get('/deliverymethodlist',[DeliveryMethodController::class,'deliverymethodlist'])->name('deliverymethodlist');
Route::get('/setupdeliverymethod',[DeliveryMethodController::class,'setupdeliverymethod'])->name('setupdeliverymethod');
Route::post('/savedeliverymethod',[DeliveryMethodController::class,'savedeliverymethod'])->name('savedeliverymethod');
Route::get('deletedeliverymethod/{id}',[DeliveryMethodController::class,'deletedeliverymethod']);
Route::get('editdeliverymethod/{id}',[DeliveryMethodController::class,'editdeliverymethod']);
Route::post('updatedeliverymethod',[DeliveryMethodController::class,'updatedeliverymethod']);


//payment method

Route::get('/paymentmethodlist',[PaymentMethodController::class,'paymentmethodlist'])->name('paymentmethodlist');
Route::get('/setuppaymentmethod',[PaymentMethodController::class,'setuppaymentmethod'])->name('setuppaymentmethod');
Route::post('/savepaymentmethod',[PaymentMethodController::class,'savepaymentmethod'])->name('savepaymentmethod');
Route::get('deletepaymentmethod/{id}',[PaymentMethodController::class,'deletepaymentmethod']);
Route::get('editpaymentmethod/{id}',[PaymentMethodController::class,'editpaymentmethod']);
Route::post('updatepaymentmethod',[PaymentMethodController::class,'updatepaymentmethod']);


//logout
Route::post('/logout',[ProjectController::class,'dologout'])->name('dologout');






Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
