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

// jika ada Route yang konflik ada ada route yang sama, maka tidak akan terjadi error, tetapi laravel akan mengeksekusi route yang paling atas

Route::get('/', function () {
    return view('welcome');
});


// cara1 menampilkan view --> langsung menggunakan class static view
// Route::view('uri', 'folder.namaFileViewnya', ['data' => 'value']);
Route::view('/hello', 'hello', ['name' => "Dira"]);


// cara2 menampilkan view --> dengan menggunakan closure
// Route::get('uri', function () {
//    return view('folder.namaFileViewnya', ['data' => 'value']);
// });
Route::get('/hello-again', function () {
    return view('hello', ['name' => 'Dira']);
});

Route::get("/hello-home", function () {
    return view('home.hello', ['name' => "Dira"]);
});


// Route Parameter --> untuk mengambil parameter dari route, akan di tampung di dalam paramter closure secara berurutan, nama paramter yg ada di route dengan yang ada di closure tidak harus sama
Route::get('/product/{id}/item/{item}', function ($productId, $productItem) {
    return "Product ID : " . $productId . ", Product Item : " . $productItem;
});


// Route parameter dengan Regular Expression (menerapkan aturan tertentu di Route parameternya), dengan menambahkan where
Route::get("category/{id}/item/{item}", function (string $categoryId, string $categoryItem) {
    return "Categories : " . $categoryId . ", Product Item : " . $categoryItem;
})->where('id', '[0-9]+')->where("item", "[0-9]+");


// Optional Route Paramter --> route parameter tidak wajib diisi, dengan menambahkan tanda ?, namun di closure harus diberi nilai defaultnya
Route::get("/users/{id?}", function(string $userId = '404') {
    return "Users : " . $userId;
});
