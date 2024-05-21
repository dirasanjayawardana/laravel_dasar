<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ResponseController extends Controller
{
    public function response(Request $request): Response
    {
        // response(content, status, headers);
        return response("Hello Response", 200);
    }


    // mengembalikan response dengan header dan body berupa json
    public function header(Request $request): Response
    {
        $body = ["firstName" => "Dira", "lastName" => "Sanjaya"];

        // header hanya bisa satu key satu value
        // withHeaders bisa banyak key dan value
        return response(json_encode($body), 200)
            ->header("Content-Type", "application/json")
            ->withHeaders([
                "Author" => "Dira Sanjaya Wardana",
                "App" => "Laravel Dasar"
            ]);
    }


    // mengembalikan response berupa view
    public function responseView(Request $request): Response
    {
        // view(folder.namaView, [data]);
        return response()
            ->view("hello", ["name" => "Dira"]);
    }


    // mengembalikan response berupa json
    public function responseJson(Request $request): JsonResponse
    {
        $body = ["firstName" => "Dira", "lastName" => "Sanjaya"];

        // jika menggunakan json(), maka di header akan otomatis ada content-type application/json
        return response()
            ->json($body);
    }


    // mengembalikan response berupa file
    public function responseFile(Request $request): BinaryFileResponse
    {
        return response()
            ->file(storage_path("app/public/pictures/test.png"));
    }


    // mengembalikan response berupa download
    public function responseDownload(Request $request): BinaryFileResponse
    {
        return response()
            ->download(storage_path("app/public/pictures/test.png"), "gambar.png");
    }
}
