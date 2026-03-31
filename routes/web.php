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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
  

require __DIR__.'/auth.php'; //

Route::get("/","App\Http\Controllers\ViDuLayoutController@sach");

Route::get('/accountpanel','App\Http\Controllers\AccountController@accountpanel')
            ->middleware('auth')->name("account");

Route::post('/saveaccountinfo','App\Http\Controllers\AccountController@saveaccountinfo')
            ->middleware('auth')->name('saveinfo');

Route::post('/bookview','App\Http\Controllers\BookController@bookview')->name("bookview");

Route::get('/sach','App\Http\Controllers\ViduLayoutController@sach');
Route::get('sach/chitiet/{id}','App\Http\Controllers\ViduLayoutController@chitiet');
Route::get('sach/theloai/{id}','App\Http\Controllers\ViduLayoutController@theloai');

Route::get('/book/list','App\Http\Controllers\BookController@booklist')
            ->middleware('auth')->name("booklist");

Route::get('/book/create','App\Http\Controllers\BookController@bookcreate')
            ->middleware('auth')->name("bookcreate");

Route::get('/book/edit/{id}','App\Http\Controllers\BookController@bookedit')
            ->middleware('auth')->name("bookedit");

Route::post('/book/save/{action}','App\Http\Controllers\BookController@booksave')
            ->middleware('auth')->name("booksave");
            
Route::post('/book/delete','App\Http\Controllers\BookController@bookdelete')
            ->middleware('auth')->name("bookdelete");

Route::get('/order','App\Http\Controllers\BookController@order')->name('order');

Route::post('/cart/add','App\Http\Controllers\BookController@cartadd')->name('cartadd');

Route::post('/cart/delete','App\Http\Controllers\BookController@cartdelete')->name('cartdelete');

Route::post('/order/create','App\Http\Controllers\BookController@ordercreate') 
			->middleware('auth')->name('ordercreate');
