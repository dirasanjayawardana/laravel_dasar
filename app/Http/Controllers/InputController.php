<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputController extends Controller
{
    // $request->input("namaKeyNya") --> untuk mengambil input pada request, input dapat diambil dari path parameter, query param, header, maupun body sesuai dengan key nya
    // di laravel tidak perlu menentukan methodnya apa, input request tetap akan dicari berdasarkan nama key nya
    public function hello(Request $request): string
    {
        $name = $request->input("name");

        return "Hello " . $name;
    }

    // untuk nested request input, cukup gunakan titik
    // untuk mengirim request nya contoh via postman, bisa gunakan keynya --> name[first] dan name[last]
    public function helloFirst(Request $request): string
    {
        $firstName = $request->input("name.first");

        return "Hello " . $firstName;
    }

    // mengambil semua input
    public function helloAllInput(Request $request): string
    {
        $input = $request->input();

        // konversi array menjadi json
        return json_encode($input);
    }

    // mengambil value dari input berupa array, dengan menggunakan .*.
    // untuk mengirim request nya contoh via postman, bisa gunakan keynya --> products[0][name] dan product[1][name]
    public function helloArrayInput(Request $request): string
    {
        $names = $request->input("products.*.name");

        return json_encode($names);
    }
}
