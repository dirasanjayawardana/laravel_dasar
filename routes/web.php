<?php

use App\Exceptions\ValidationException;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\SessionController;
use App\Http\Middleware\ContohMiddleware;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

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
Route::get("/users/{id?}", function (string $userId = '404') {
    return "Users : " . $userId;
})->name("user.detail");


// Named Route --> dengan menggunakan ->name(), memberikan nama pada sebuah route, untuk mendapatkan informasi seperti url, atau untuk redirect
Route::get('/pengguna/{id}', function ($id) {
    // mengambil url dari user detail
    $link = route('user.detail', [
        'id' => $id
    ]);
    return "Link : " . $link;
});
Route::get('/pengguna-redirect/{id}', function ($id) {
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


// ROUTE GROUP # ROUTE CONTROLLER --> Route::controller(controllernya)->group(closure)
Route::controller(CookieController::class)->group(function () {
    // Cookie
    // karena menggunakan route controller, tidak perlu menyebutkan class controllernya lagi
    Route::get("/cookie/set", "createCookie");
    Route::get("/cookie/get", "getCookie");
    Route::get("/cookie/clear", "clearCookie");
});


// ROUTE GROUP # ROUTE PREFIX --> Route::prefix('/prefixnya')->group(closure)
Route::prefix('/redirect')->group(function () {
    // Redirect
    Route::get("/from", [RedirectController::class, "redirectFrom"]);
    Route::get("/to", [RedirectController::class, "redirectTo"]);
    Route::get("/name", [RedirectController::class, "redirectName"]);
    Route::get("/hello/{name}", [RedirectController::class, "redirectHello"])
        ->name("redirect-hello");
    Route::get("/action", [RedirectController::class, "redirectAction"]);
    Route::get("/dirapp", [RedirectController::class, "redirectAway"]);
});


// Middleware: ->middleware(['namaMiddleware:parameter1,parameter2']);
Route::get("/middleware/api", function () {
    return "OK";
})->middleware(['contoh:DIRAPP, 401']);


// withouMiddleware --> untuk exclude middleware tertentu
Route::post('/file/upload/without-middleware', [FileController::class, "upload"])
    ->withoutMiddleware([VerifyCsrfToken::class]);


// ROUTE GROUP # ROUTE MIDDLEWARE --> Route::middleware(['namaMiddleware:parameter'])->group(closure)
Route::middleware(['contoh:DIRAPP,401'])->group(function () {
    Route::get("/middleware/group", function () {
        return "OK";
    });
});


// FORM -- CSRF Token
Route::get('/form', [FormController::class, "form"]);
Route::post('/form', [FormController::class, "submitForm"]);


// ROUTE GROUP # MULTIPLE GROUP --> menggunakan beberapa jenis route group sekaligus
Route::middleware(['contoh:DIRAPP,401'])->prefix('/multi-group')->group(function() {
    Route::get("/api", function () {
        return "OK";
    });
});


// URL Generator
// mengambil url saat ini
Route::get("/url/current", function() {
    // bisa menggunakan --> url()->current(); atau menggunakan facadenya
    return URL::full();
});

// membuat link menuju named route, akan mengembalikan url dari route dengan nama tertentu
Route::get("/url/named", function () {
    // bisa menggunakan = route(name, parameters); atau url()->route(name, parameters); atau URL::route(name, parameters);
    return URL::route("redirect-hello", ['name' => "dira"]);
});

// membuat link menuju controller action
// bisa menggunakan = action([classController, nameAction], [parameters]);
// atau URL::action([classController, nameAction], [parameters]);
// atau url()->action([classController, nameAction], [parameters])
Route::get("/url/action", function() {
    return URL::action([FormController::class, "form"], []);
});


// Session
Route::get("/session/create", [SessionController::class, "createSession"]);
Route::get("/session/get", [SessionController::class, "getSession"]);


// Exception - Error
Route::get("/error/sample", function () {
    // dengan throw exception, error akan ditampilkan dihalaman web dan mentriger method reportable() di app/Exceptions/Handler.php
    throw new Exception("Sample Error");
});
Route::get("/error/manual", function () {
    // dengan method report(), ketika terjadi error tidak ditampilkan dihalaman web, hanya mentriger method reportable() di app/Exceptions/Handler.php
    report(new Exception("Sample Error"));
    return "OK";
});
Route::get("/error/validation", function()
{
    // ketika terjadi ValidationException tidak akan mentriger method reportable() di app/Exceptions/Handler.php, karena sudah didaftarkan di field $dontReport pada App/Exceptions/Handler.php
    // ketika terjadi ValidationException akan mengeksekusi custom view karena telah di custom pada method register->renderable() di App/Exceptions/Handler.php
    throw new ValidationException("Validation Error");
});


// HTTP Exception --> exception dengan http status, menggunakan method: abort(statusCode, message, [headers]); atau
// throw new HttpException(statusCode, message, [headers]); dari package Symfony/Component/HttpKernel/HttpExceptio
Route::get("/abort/400", function ()
{
    // akan otomatis render custom view error 400.blade.php, jika custom view tidak dibuat maka akan merender view error bawaan laravel
    abort(400, "Ups something error");
});
Route::get("/abort/401", function ()
{
    abort(401);
});
Route::get("/abort/501", function ()
{
    abort(503, "Something wrong");
});


// Maintenance mode --> php artisan down --> php artisan serve
// ketika berada di maintenance mode, secara otomatis semua request akan mengembalikan HttpException 503 (service unavailable)
// secara otomatis akan ada file di storage/framework/down
// untuk keluar dari maintenance mode --> php artisan up --> atau bisa langusng hapus saja file di storage/framwork/down
// untuk mengakses aplikasi saat berada di maintenance mode --> php artisan down --secret="yourSecretKey" --> kemudian web bisa diakses dengan http://contoh.com/yourSecretKey





