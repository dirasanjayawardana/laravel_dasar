<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileStorageTest extends TestCase
{
    public function testSotrage()
    {
        $fileSystem = Storage::disk("local");

        // menyimpan file, akan disimpan di folder /storage/app
        $fileSystem->put("file.txt", "Dira Sanjaya Wardana");

        // mengambil isi file
        $content = $fileSystem->get("file.txt");

        self::assertEquals("Dira Sanjaya Wardana", $content);
    }

    // php artisan storage:link --> untuk membuat link dari folder /storage/app ke folder /public/storage

    public function testSotragePublic()
    {
        $fileSystem = Storage::disk("public");

        // menyimpan file, akan disimpan di folder /storage/app
        $fileSystem->put("file.txt", "Dira Sanjaya Wardana");

        // mengambil isi file
        $content = $fileSystem->get("file.txt");

        self::assertEquals("Dira Sanjaya Wardana", $content);
    }
}
