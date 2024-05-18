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

    public function hello($name): string
    {
        return $this->helloService->hello($name);
    }
}
