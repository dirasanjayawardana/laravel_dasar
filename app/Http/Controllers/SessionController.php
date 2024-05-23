<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

// setiap request http itu independent, satu request tidak ada hubungannya dengan request lain
// Session digunakan untuk menyimpan data yang bisa digunakan antar request
// config untuk session disimpan di config/session.php, secara default session disimpan di storage/framework/session

// method untuk menyimpan, mengubah dan menghapus data session
// put(key, value) --> menyimpan session dengan key dan value
// push(key, value) --> menambahkan data ke array sesion yang telah dibuat sebelumnya
// pull(key, value) --> mengambil data di array session dan menghapusnya
// increment(key, increment) --> menambahkan value di session
// decrement(key, decrement) --> menurunkan value di session
// forget(key) --> menghapus data session
// flush() --> menghapus semua data di session
// invalidate() --> menghapus semua data di session dan membuat session baru

// method untuk mengambil data session
// get(key, default) --> mengambil data session dengan key
// all() --> mengambil semua data session
// hash(key) --> untuk mengecek data di session
// missing(key) --> untuk mengecek apakah data tidak ada di session

class SessionController extends Controller
{
    public function createSession(Request $request): string
    {
        // bisa juga menggunakan facade dari Illuminate\Contracts\Session\Session --> Session::put(key, value);
        // atau session()->put(key,value);
        $request->session()->put("userId", "dira");
        $request->session()->put("isActive", "true");

        return "OK";
    }

    public function getSession(Request $request): string
    {
        $userId = $request->session()->get('userId', 'default-value');
        $isActive = $request->session()->get('isActive', 'default-value');
        return "User Id : " . $userId . " Is Active : " . $isActive;
    }
}
