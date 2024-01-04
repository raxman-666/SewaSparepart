<?php

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

// use Illuminate\Routing\Route;

use App\Http\Controllers\PeminjamanController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('register', function () {
    return view('auth.register');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('home', 'HomeController@index');
    Route::get('sparepart', 'SparepartController@index');
    Route::post('sparepart', 'SparepartController@store');
    Route::patch('sparepart', 'SparepartController@update');
    Route::delete('sparepart', 'SparepartController@destroy');

    Route::get('peminjaman', 'PeminjamanController@index');
    Route::get('tambahpinjaman', 'PeminjamanController@pinjam');
    Route::post('pinjam', 'PeminjamanController@store');
    Route::patch('setstatpinjam', 'PeminjamanController@update');

    Route::get('pengembalian', 'PengembalianController@index');
    Route::get('tambahpengembalian', 'PengembalianController@kembali');
    Route::post('kembali', 'PengembalianController@store');
    Route::patch('setstatkembali', 'PengembalianController@update');
});

Auth::routes();
