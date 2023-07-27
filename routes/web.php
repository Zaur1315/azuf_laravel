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

