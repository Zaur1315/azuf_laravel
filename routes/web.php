<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\PageController@showFirstPage')->name('payment.form');
Route::post('/payment/process', 'App\Http\Controllers\PageController@processPayment')->name('payment.process');
Route::post('/notification', 'App\Http\Controllers\PageController@handleNotification')->name('payment.notification');
Route::get('/success', 'App\Http\Controllers\PageController@successOperation')->name('payment.success');
Route::get('/cancel', 'App\Http\Controllers\PageController@cancelOperation')->name('payment.cancel');

Route::middleware(['auth'])->group(function (){
    Route::get('dashboard/actions-list/{page}/payments', 'App\Http\Controllers\PaymentPageController@showPayments')->name('payment-pages.payment');
    Route::get( '/dashboard','App\Http\Controllers\AdminController@adminHome')->name('admin.home');
    Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
    Route::get('dashboard/user/change-password', 'App\Http\Controllers\AdminController@changePass')->name('change-password');
    Route::get('dashboard/user/profile', 'App\Http\Controllers\UserInfoController@profileEdit')->name('profile.edit');
    Route::put('dashboard/user/profile/update','App\Http\Controllers\UserInfoController@profileUpdate')->name('profile.update');
    Route::get('dashboard/actions-list', 'App\Http\Controllers\AdminController@actionList')->name('action.list');
    Route::post('dashboard/export-xlsx', 'App\Http\Controllers\ExportController@exportXLSX')->name('export.xlsx');
    Route::post('dashboard/export-csv', 'App\Http\Controllers\ExportController@exportCSV')->name('export.csv');
});

Route::get('/login','App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('/login','App\Http\Controllers\Auth\LoginController@login');
Route::middleware(['admin'])->group(function (){
    Route::get('/dashboard/actions-list/create-action-page', 'App\Http\Controllers\AdminController@createPaymentPage')->name('admin.create_payment_page');
    Route::post('/store-payment-page','App\Http\Controllers\AdminController@store')->name('payment-pages.store');
    Route::get('/dashboard/user/create-user', 'App\Http\Controllers\UserInfoController@create')->name('user.create');
    Route::post('/dashboard/user/create-user', 'App\Http\Controllers\UserInfoController@store')->name('user.store');
    Route::get('/dashboard/actions-list/edit/{id}', 'App\Http\Controllers\AdminController@editPaymentPage')->name('edit-payment');
    Route::put('/dashboard/update-payment-page/{id}', 'App\Http\Controllers\AdminController@updatePaymentPage')->name('update-payment-page');
    Route::get('/dashboard/user/edit-user/{id}', 'App\Http\Controllers\UserInfoController@editUser')->name('edit-user');
    Route::post('/dashboard/user/update-user/{id}', 'App\Http\Controllers\UserInfoController@updateUser')->name('update-user');
    Route::delete('/dashboard/user/delete-user/{id}','App\Http\Controllers\UserInfoController@destroy')->name('user.destroy');
    Route::get('/dashboard/user/deleted-user/{id}', 'App\Http\Controllers\UserInfoController@deletedUser')->name('user.deleted');
    Route::post('/dashboard/user/restore-user/{id}', 'App\Http\Controllers\UserInfoController@restore')->name('user.restore');
    Route::get('/dashboard/user/users-list', 'App\Http\Controllers\UserInfoController@index')->name('user.list')->middleware('admin');
});

Route::get('/{slug}', '\App\Http\Controllers\PageController@showPage')->name('page.show');
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/locale/{locale}', 'App\Http\Controllers\LocalizationController@setLocale')->name('locale');





