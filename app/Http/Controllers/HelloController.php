<?php

namespace App\Http\Controllers;

use App\Services\HelloService;
use Illuminate\Http\Request;

// Controller --> tempat menaruh logic aplikasi
// setelah membuat controller, daftarkan controller di closure Route, dengan mengganti closure berupa array yang berisi class controller dan nama function nya
// keuntungannya menggunakan controller, dikelola oleh service container, bisa menambahkan constructor
class HelloController extends Controller
{
    private HelloService $helloService;

    // karena HelloService telah di daftarkan di FooBarServiceProvider, maka service container akan melakukan dependency injection pada helloService
    public function __construct(HelloService $helloService)
    {
        $this->helloService = $helloService;
    }

    // Request --> untuk mengambil informasi http request, secara otomatis akan di inject oleh service container
    public function hello(Request $request, $name): string
    {
        return $this->helloService->hello($name);
    }

    // Request --> untuk mengambil informasi http request, secara otomatis akan di inject oleh service container
    public function request(Request $request)
    {
        return $request->path() . PHP_EOL . // mengambil path atau endpoint nya
            $request->url() . PHP_EOL . // mengambil url tanpa path parameter
            $request->fullUrl() . PHP_EOL . // mengambil url utuh beserta pathnya
            $request->method() . PHP_EOL . // mngambil methodnya apa
            $request->isMethod("GET") . PHP_EOL . // mengecek apakah methodnya post
            $request->header("keyHeader", "default value jika tidak ketemu") . PHP_EOL . // mengambil data header dengan keynya
            $request->bearerToken(); // mengambil token bearernya di header authorization
    }
}
