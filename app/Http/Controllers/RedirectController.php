<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function redirectTo(): string
    {
        return "Redirect to";
    }

    public function redirectFrom(): RedirectResponse
    {
        // cara melakukan redirect dengan method redirect(url)
        return redirect("/redirect/to");
    }


    // melakukan redirect ke route tertentu berdasarkan nama routenya, menggunakan method ->route(namaRoute, parameterRoute)
    public function redirectName(): RedirectResponse
    {
        return redirect()->route("redirect-hello", ["name" => "dira"]);
    }

    public function redirectHello(string $name): string
    {
        return "Hello $name";
    }


    // melakukan redirect ke controller tertentu, menggunakan method ->action([Cotroller, function], [parameter])
    public function redirectAction(): RedirectResponse
    {
        return redirect()->action([RedirectController::class, "redirectHello"], ["name" => "dira"]);
    }


    // redirect ke luar domain, menggunakan method ->away(url)
    public function redirectAway(): RedirectResponse
    {
        return redirect()->away("https://dirhome.vercel.app/");
    }

}
