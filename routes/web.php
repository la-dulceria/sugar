<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

/*Category*/
Route::get('admin/categories/new','CategoryController@new')
    ->name('CategoryController@new');
Route::post('admin/categories/create','CategoryController@create')
    ->name('CategoryController@create');
Route::get('admin/categories/index','CategoryController@index')
    ->name('CategoryController@index');
Route::get('Category/{id}/confirm', 'CategoryController@confirm')
    ->name('CategoryController@confirm');
Route::delete('admin/categories/delete{id}','CategoryController@delete')
    ->name('CategoryController@delete');
Route::get('admin/categories/edit{id}','CategoryController@edit')
    ->name('CategoryController@edit');
Route::put('admin/categories/edit{id}','CategoryController@update')
    ->name('CategoryController@update');

/*Product*/
Route::get('admin/products/new','ProductController@new')
    ->name('ProductController@new');
Route::post('admin/products/create','ProductController@create')
    ->name('ProductController@create');
Route::get('/admin/products/index','ProductController@index')
    ->name('ProductController@index');
Route::get('admin/products/delete{id}','ProductController@delete')
    ->name('ProductController@delete');
Route::get('admin/products/edit{id}','ProductController@edit')
    ->name('ProductController@edit');
Route::put('admin/products/update{id}','ProductController@update')
    ->name('ProductController@update');
Route::get('admin/autoComplete','ProductController@autoComplete')
    ->name('ProductController@autoComplete');
Route::get('admin/findProducts','ProductController@findProduct')
    ->name('ProductController@findProduct');
