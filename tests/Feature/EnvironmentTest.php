<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EnvironmentTest extends TestCase
{
    public function testGetEnv()
    {
        # membaca file env bisa menggunakan --> env("key", nilai_default); atau --> Env::get("key", nilai default)

        # cara cek sekarang berada di environment local, staging, atau production --> App::environment();

        # membaca environment dari .env
        $env = env("DB_DATABASE");
        # membaca dari environment system
        $java_home = env("JAVA_HOME");

        self::assertEquals("laravel", $env);
        self::assertNotNull($java_home);
    }
}
