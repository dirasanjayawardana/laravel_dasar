<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    // menerima data request berupa file
    public function upload(Request $request)
    {
        // mengambil semua file yang diupload
        // $allFiles = $request->allFiles();

        // mengambil file di request dengan key "picture"
        $picture = $request->file("picture");

        // simpan file didalam folder pictures dengan fileSystem public
        $picture->storePubliclyAs("pictures", $picture->getClientOriginalName(), "public");

        return "OK : " . $picture->getClientOriginalName();
    }
}
