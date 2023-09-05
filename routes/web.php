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

Route::get('/', [\App\Http\Controllers\PageController::class, 'showFirstPage'])->name('payment.form');

Route::post('/payment/process', [\App\Http\Controllers\PageController::class, 'processPayment'])->name('payment.process');

Route::post('/notification', [\App\Http\Controllers\PageController::class, 'handleNotification'])->name('payment.notification');

Route::get( '/dashboard',[\App\Http\Controllers\AdminController::class, 'adminHome'])->name('admin.home');

Route::get('/dashboard/create-payment-page', [\App\Http\Controllers\AdminController::class, 'createPaymentPage'])->name('admin.create_payment_page');

//Route::get('/export-csv', [\App\Http\Controllers\AdminController::class,'exportCsv'])->name('export.csv');

Route::post('/generate-pdf', [\App\Http\Controllers\AdminController::class, 'generatePDF'])->name('generate.pdf');

Route::post('/generate-csv', [\App\Http\Controllers\AdminController::class, 'generateCsv'])->name('generate.Csv');

Route::post('/save-excel', '\App\Http\Controllers\AdminController@generateExcel')->name('generate-excel');



Route::group(['prefix'=>'admin'], function(){
    Route::resource('payment-pages', \App\Http\Controllers\PaymentPageController::class);
    Route::post('/payment-pages/create', [\App\Http\Controllers\PaymentPageController::class, 'createPage'])->name('payment-pages.create');
    Route::post('/store-payment-page',[\App\Http\Controllers\PaymentPageController::class, 'store'])->name('payment-pages.store');
});

Route::get('/{slug}', [\App\Http\Controllers\PageController::class, 'showPage'])->name('page.show');


