<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
