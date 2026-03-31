<?php

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
Route::get('/trang1','App\Http\Controllers\ViduLayoutController@trang1');
Route::get('sach','App\Http\Controllers\ViduLayoutController@sach');
Route::get('sach/chitiet/{id}','App\Http\Controllers\ViduLayoutController@chitiet');
Route::get('sach/theloai/{id}','App\Http\Controllers\ViduLayoutController@theloai');
Route::get('/order','App\Http\Controllers\ViduLayoutController@order')->name('order');
Route::post('/cart/add','App\Http\Controllers\ViduLayoutController@cartadd')->name('cartadd');
Route::post('/cart/delete','App\Http\Controllers\ViduLayoutController@cartdelete')->name('cartdelete');
Route::post('/order/create','App\Http\Controllers\ViduLayoutController@ordercreate') 
			->middleware('auth')->name('ordercreate');
Route::get('/account','App\Http\Controllers\BookController@booklist')
->middleware('auth')->name("account");
Route::get('/', function () {
    return view('welcome');
}); 

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php'; //