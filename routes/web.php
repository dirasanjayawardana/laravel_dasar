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

// untuk melihat semua routing di laravel --> php artisan route:list

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dira', function () {
    return "Hello dira sanjaya wardana";
});

Route::redirect('/home', '/dira');

// fallback route --> ketika halaman yang diakses tidak ada
Route::fallback(function () {
    return "Page Not Found";
});
