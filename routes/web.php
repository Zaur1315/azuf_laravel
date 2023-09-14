<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\PageController::class, 'showFirstPage'])->name('payment.form');

Route::post('/payment/process', [\App\Http\Controllers\PageController::class, 'processPayment'])->name('payment.process');

Route::post('/notification', [\App\Http\Controllers\PageController::class, 'handleNotification'])->name('payment.notification');


Route::middleware(['App\Http\Middleware\AdminMiddleware'])->group(function (){
    Route::get( '/dashboard',[\App\Http\Controllers\AdminController::class, 'adminHome'])->name('admin.home');
    Route::get('/dashboard/create-payment-page', [\App\Http\Controllers\AdminController::class, 'createPaymentPage'])->name('admin.create_payment_page');
    Route::post('/generate-pdf', [\App\Http\Controllers\AdminController::class, 'generatePDF'])->name('generate.pdf');
    Route::post('/generate-csv', [\App\Http\Controllers\AdminController::class, 'generateCsv'])->name('generate.Csv');
    Route::post('/generate-excel', '\App\Http\Controllers\AdminController@generateExcel')->name('generate-excel');
    Route::group(['prefix'=>'admin'], function(){
        Route::resource('payment-pages', \App\Http\Controllers\PaymentPageController::class);
        Route::post('/payment-pages/create', [\App\Http\Controllers\PaymentPageController::class, 'createPage'])->name('payment-pages.create');
        Route::post('/store-payment-page',[\App\Http\Controllers\PaymentPageController::class, 'store'])->name('payment-pages.store');
    });
});

Route::get('/login','App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('/login','App\Http\Controllers\Auth\LoginController@login');
Route::get('/register','App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@register');






Route::get('/{slug}', [\App\Http\Controllers\PageController::class, 'showPage'])->name('page.show');






Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
