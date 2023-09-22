<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\PageController@showFirstPage')->name('payment.form');

Route::post('/payment/process', 'App\Http\Controllers\PageController@processPayment')->name('payment.process');

Route::post('/notification', 'App\Http\Controllers\PageController@handleNotification')->name('payment.notification');


Route::middleware(['auth'])->group(function (){
    Route::get( '/dashboard','App\Http\Controllers\AdminController@adminHome')->name('admin.home');
    Route::get('/dashboard/create-payment-page', 'App\Http\Controllers\AdminController@createPaymentPage')->name('admin.create_payment_page')->middleware('admin');
    Route::post('/generate-pdf', 'App\Http\Controllers\AdminController@generatePDF')->name('generate.pdf');
    Route::post('/generate-csv', 'App\Http\Controllers\AdminController@generateCsv')->name('generate.Csv');
    Route::post('/generate-excel', '\App\Http\Controllers\AdminController@generateExcel')->name('generate-excel');
    Route::group(['prefix'=>'admin'], function(){
        Route::resource('payment-pages', 'App\Http\Controllers\PaymentPageController');
        Route::post('/payment-pages/create', 'App\Http\Controllers\PaymentPageController@createPage')->name('payment-pages.create')->middleware('admin');
        Route::post('/store-payment-page','App\Http\Controllers\PaymentPageController@store')->name('payment-pages.store')->middleware('admin');
        Route::get('payment-pages/{page}/payment', 'App\Http\Controllers\PaymentPageController@showPayments')->name('payment-pages.payment');
    });
    Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
    Route::get('dashboard/change-password', 'App\Http\Controllers\AdminController@changePass')->name('change-password');
    Route::get('dashboard/profile', 'App\Http\Controllers\AdminController@profileEdit')->name('profile.edit');
    Route::put('dashboard/profile/update','App\Http\Controllers\AdminController@profileUpdate')->name('profile.update');
    Route::get('dashboard/actions-list', 'App\Http\Controllers\ActionController@index')->name('action.list');
    Route::get('/api/data-table', 'DataTableController@index');
    Route::get('/admin/data', 'AdminController@getData');
});

Route::get('/login','App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('/login','App\Http\Controllers\Auth\LoginController@login');
Route::get('/register','App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@register');

Route::get('/dashboard/create-user', 'App\Http\Controllers\UserCreationController@create')->name('user.create')->middleware('admin');
Route::post('/dashboard/create-user', 'App\Http\Controllers\UserCreationController@store')->name('user.store')->middleware('admin');
Route::get('/dashboard/edit-payment-page/{id}', 'App\Http\Controllers\AdminController@editPaymentPage')->name('edit-payment')->middleware('admin');
Route::put('/dashboard/update-payment-page/{id}', 'App\Http\Controllers\AdminController@updatePaymentPage')->name('update-payment-page')->middleware('admin');
Route::get('/dashboard/edit-user/{id}', 'App\Http\Controllers\AdminController@editUser')->name('edit-user')->middleware('admin');
Route::post('/dashboard/update-user/{id}', 'App\Http\Controllers\AdminController@updateUser')->name('update-user')->middleware('admin');
Route::delete('/dashboard/delete-user/{id}','App\Http\Controllers\AdminController@destroy')->name('user.destroy');

Route::get('/dashboard/users-list', 'App\Http\Controllers\UserInfoController@index')->name('user.list')->middleware('admin');


Route::get('/{slug}', '\App\Http\Controllers\PageController@showPage')->name('page.show');

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
