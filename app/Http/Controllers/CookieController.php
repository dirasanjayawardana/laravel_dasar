<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CookieController extends Controller
{
    // meyertakan cookie pada response
    public function createCookie(Request $request)
    {
        // ->cookie(name, value, timeout(menit), path, domain, secure, httpOnly);
        // path pada cookie artinya cookie akan dikirimkan ketika domain dan path tersebut di akses
        return response("Hello Cookie")
            ->cookie("User-Id", "Dira", 1000, "/")
            ->cookie("Is-Active", "true", 1000, "/");
    }


    public function getCookie(Request $request): JsonResponse
    {
        // untuk mendapatkan cookie dengan method ->cookie(name, default);
        return response()
            ->json([
                "userId" => $request->cookie("User-Id", "guest"),
                "isActive" => $request->cookie("Is-Active", "false")
            ]);
    }


    public function clearCookie(Request $request): Response
    {
        // ketika menggunakan method ->withoutCookie(nama); akan otomatis membuat cookie dengan nama yang sama dengan value kosong dan expired secepatnya
        return response("Clear Cookie")
            ->withoutCookie("User-Id")
            ->withoutCookie("Is-Active");
    }
}
