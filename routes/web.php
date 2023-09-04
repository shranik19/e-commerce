<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShowController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class,'index'])->name('home');


Route::get('/home',[HomeController::class,'index'])->name('home');
Route::get('/products',[ProductController::class,'index']);
Route::get('/product/{slug}',[ProductController::class,'show']);
Route::get('/cart',[CartController::class,'show']);
Route::get('/checkout',[CheckoutController::class,'show']);
Route::get('/payment/{paymentGateways}',[PaymentController::class,'show'])->name('payment.show');
Route::get('/thankyou',[PaymentController::class,'thankyou'])->name('thankyou');

Route::post('/cart',[CartController::class,'add']);
Route::delete('/cart/remove',[CartController::class,'delete']);
Route::post('/cart/update',[CartController::class,'update']);
Route::post('/checkout',[CheckoutController::class,'store'])->name('checkout.store');

Route::get('/about',function(){
    return view('about');
});
Route::get('/thankyou',function(){
    return view('thankyou');
});

Route::get('/login',[LoginController::class,'authenticate']);

Route::get('/categories',[CategoryController::class,'getAction']);
