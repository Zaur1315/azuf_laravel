<?php

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

Route::get('/', [\App\Http\Controllers\PaymentController::class, 'showPaymentForm'])->name('payment.form');

Route::post('/payment/process', [\App\Http\Controllers\PaymentController::class, 'processPayment'])->name('payment.process');

Route::post('/notification', [\App\Http\Controllers\PaymentController::class, 'handleNotification'])->name('payment.notification');

Route::get( '/dashboard',[\App\Http\Controllers\AdminController::class, 'adminHome'])->name('admin.home');

Route::get('/create-payment-page', [\App\Http\Controllers\AdminController::class, 'createPaymentPage'])->name('admin.create_payment_page');

Route::post('/store-payment-page', [\App\Http\Controllers\AdminController::class, 'storePaymentPage'])->name('admin.store_payment_page');

Route::group(['prefix'=>'admin'], function(){
    Route::resource('payment-pages', \App\Http\Controllers\PaymentPageController::class);
    Route::post('/payment-pages/create', [\App\Http\Controllers\PaymentPageController::class, 'createPage'])->name('payment-pages.create');

});

