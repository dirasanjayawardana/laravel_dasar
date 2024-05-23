<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

// request dan response yang masuk antara route dan controller akan di validasi terlebih dahulu oleh middleware
// jika tidak valid middleware bisa langsung memberi response
// di middleware harus ada method handle(request, closure); untuk menangani request atau response yang masuk

// setelah membuat middleware, agar bisa digunakan harus diregistrasikan
// menerapkan middleware global (untuk semua route) --> registrasikan di field $middleware di app/http/kernel.php

// mendaftartkan beberapa middleware dengan satu nama alias --> registrasikan di field $middlewareGroups di app/http/kernel.php
// contoh untuk middleware 'api' dan 'web' diterapkan di /Providers/RouteServiceProvider/php
// untuk menerapkan di route tertentu dengan method:
// ->middleware([Middleware::class]); atau ->middleware(["nama_middleware_ygsudah_didaftarkan"]); bisa lebih dari satu group middleware

// menerapkan middleware untuk route tertentu --> registrasikan di field $routeMiddleware di app/http/kernel.php sebagai aliasnya, kemudian panggil nama middleware yang sudah didaftarkan di route dengan method:
// ->middleware([Middleware::class]); atau ->middleware(["nama_middleware_ygsudah_didaftarkan"]); bisa lebih dari satu middleware

class ContohMiddleware
{
    // di middleware harus ada method handle(request, closure); untuk menangani request atau response yang masuk
    // pada function handle bisa ditambahkan parameter lain setelah request dan closure, cara memasukkan parameternya:
    // ->middleware(["namaMiddleware:parmeter1,parameter2"])
    public function handle(Request $request, Closure $next, string $key, $status)
    {
        $apiKey = $request->header("X-API-KEY");
        if ($apiKey == $key) {
            // melanjutkan request ke controller
            return $next($request);
        } else {
            // langsung memberikan reponse
            return response("Access Denied", $status);
        }
    }
}
