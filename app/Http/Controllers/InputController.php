<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputController extends Controller
{
    // $request->input("namaKeyNya") --> untuk mengambil input pada request, input dapat diambil dari path parameter, query param, header, maupun body sesuai dengan key nya
    // $request->query()  --> jika hanya ingin mengambil input dari query param saja
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


    // untuk konversi tipe data pada input menggunakan method --> tipedata(key, default);
    // boolean(key, default); --> untuk ubah tipe data input ke boolean
    // date(key, pattern, timezone); --> untuk ubah tipe data input ke date, jika timezone tidak diisi otomatis memakai timezone server, menggunakan library Carbon
    public function inputType(Request $request): string
    {
        $name = $request->input("name");
        $isMarried = $request->boolean("married");
        $birthDate = $request->date("birth-date", "Y-m-d");

        return json_encode([
            "name" => $name,
            "married" => $isMarried,
            "birth-date" => $birthDate->format("Y-m-d")
        ]);
    }

    // Method untuk filter request input
    // $request->only([key1, key2])
    // $request->except([key1, key2])
    public function filterOnly(Request $request): string
    {
        $name = $request->only(["name.first", "name.last"]);

        return json_encode($name);
    }
    public function filterExcept(Request $request): string
    {
        $user = $request->except(["admin"]);

        return json_encode($user);
    }

    // merge(array) --> untuk menambahkan input request, jika ada key yg sama maka otomatis akan direplace
    // mergeIfMissing(array) --> untuk menambahkan input request ketika key yang diminta tidak ada
    public function filterMerge(Request $request): string
    {
        $request->merge(["admin" => false]);
        $user = $request->input();
        return json_encode($user);
    }
}
