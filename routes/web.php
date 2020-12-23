<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::middleware([\App\Http\Middleware\AdminMiddleware::class])->group(function () {
    Route::get('/admin', 'AdminController@index')->name('AdminController@index');

    /*Category*/
    Route::get('/admin/categories/new', 'CategoryController@new')
        ->name('CategoryController@new');
    Route::post('admin/categories/create', 'CategoryController@create')
        ->name('CategoryController@create');
    Route::get('admin/categories/index', 'CategoryController@index')
        ->name('CategoryController@index');
    Route::get('Category/{id}/confirm', 'CategoryController@confirm')
        ->name('CategoryController@confirm');
    Route::get('admin/categories/delete/{id}', 'CategoryController@delete')
        ->name('CategoryController@delete');
    Route::get('admin/categories/edit/{id}', 'CategoryController@edit')
        ->name('CategoryController@edit');
    Route::put('admin/categories/edit/{id}', 'CategoryController@update')
        ->name('CategoryController@update');

    /*Product*/
    Route::get('admin/products/new', 'ProductController@new')
        ->name('ProductController@new');
    Route::post('admin/products/create', 'ProductController@create')
        ->name('ProductController@create');
    Route::get('/admin/products/index', 'ProductController@index')
        ->name('ProductController@index');
    Route::get('admin/products/delete/{id}', 'ProductController@delete')
        ->name('ProductController@delete');
    Route::get('admin/products/edit/{id}', 'ProductController@edit')
        ->name('ProductController@edit');
    Route::put('admin/products/update/{id}', 'ProductController@update')
        ->name('ProductController@update');
    Route::get('admin/autoComplete', 'ProductController@autoComplete')
        ->name('ProductController@autoComplete');
    Route::get('admin/findProducts', 'ProductController@findProduct')
        ->name('ProductController@findProduct');

    /*Delivery*/
    Route::get('admin/deliveries/new', 'DeliveryController@new')
        ->name('DeliveryController@new');
    Route::post('admin/deliveries/create', 'DeliveryController@create')
        ->name('DeliveryController@create');
    Route::get('admin/deliveries/index', 'DeliveryController@index')
        ->name('DeliveryController@index');
    Route::get('admin/deliveries/delete/{id}', 'DeliveryController@delete')
        ->name('DeliveryController@delete');
    Route::get('admin/deliveries/edit/{id}', 'DeliveryController@edit')
        ->name('DeliveryController@edit');
    Route::put('admin/deliveries/update/{id}', 'DeliveryController@update')
        ->name('DeliveryController@update');

    /*PurchaseOrder*/
    Route::get('admin/purchaseOrder/new', 'PurchaseOrderController@new')
        ->name('PurchaseOrderController@new');
    Route::post('admin/purchaseOrder/create', 'PurchaseOrderController@create')
        ->name('PurchaseOrderController@create');

});
