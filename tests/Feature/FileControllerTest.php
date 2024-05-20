<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FileControllerTest extends TestCase
{
    public function testUpload()
    {
        // membuat dummy picture
        // aktifkan extension=gd di file php.ini
        $image = UploadedFile::fake()->image("dira.png");

        $this->post("/file/upload", [
            "picture" => $image
        ])->assertSeeText("OK : dira.png");
    }
}
