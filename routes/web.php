<?php

use App\Http\Controllers\CookieController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\ResponseController;
use Illuminate\Support\Facades\Route;

// Logic untuk Route sebaiknya disimpan dalam controller
// jika ada Route yang konflik ada ada route yang sama, maka tidak akan terjadi error, tetapi laravel akan mengeksekusi route yang paling atas
// untuk melihat semua routing di laravel --> php artisan route:list

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
})->name("user.detail");


// Named Route --> dengan menggunakan ->name(), memberikan nama pada sebuah route, untuk mendapatkan informasi seperti url, atau untuk redirect
Route::get('/pengguna/{id}', function($id) {
    // mengambil url dari user detail
    $link = route('user.detail', [
        'id' => $id
    ]);
    return "Link : " . $link;
});
Route::get('/pengguna-redirect/{id}', function($id) {
    return redirect()->route('user.detail', [
        'id' => $id
    ]);
});


// Menggunakan Controller --> daftarkan controller di closure Route, dengan mengganti closure berupa array yang berisi class controller dan nama function nya
Route::get('/controller/hello/{name}', [HelloController::class, 'hello']);
Route::get("/controller/request", [HelloController::class, 'request']);


// Menggunakan InputController --> menerima input dari request
Route::get('/input/hello', [InputController::class, "hello"]);
Route::post('/input/hello', [InputController::class, "hello"]);
Route::post('/input/hello/first', [InputController::class, "helloFirst"]);
Route::post('/input/hello/all-input', [InputController::class, "helloAllInput"]);
Route::post('/input/hello/array-input', [InputController::class, "helloArrayInput"]);
Route::post("/input/type", [InputController::class, "inputType"]);
Route::post("/input/filter/only", [InputController::class, "filterOnly"]);
Route::post("/input/filter/except", [InputController::class, "filterExcept"]);
Route::post("/input/filter/merge", [InputController::class, "filterMerge"]);


// File Upload
Route::post('/file/upload', [FileController::class, "upload"]);


// Reponse
Route::get('/response/hello', [ResponseController::class, "response"]);
Route::get("/response/header", [ResponseController::class, "header"]);
Route::get("/response/view", [ResponseController::class, "responseView"]);
Route::get("/response/json", [ResponseController::class, "responseJson"]);
Route::get("/response/file", [ResponseController::class, "responseFile"]);
Route::get("/response/download", [ResponseController::class, "responseDownload"]);


// Cookie
Route::get("/cookie/set", [CookieController::class, "createCookie"]);
