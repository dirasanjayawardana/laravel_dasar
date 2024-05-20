<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Config;

// Facades --> class yang menyediakan static akses di Service Container atau Application
// Contoh Facades --> Config, Route
class FacadeTest extends TestCase
{
    public function testConfig()
    {
        $config1 = Config::all();

        // jika tidak memakai Facades
        $config2 = $this->app->make("config");
        $config2->all();

        // self::assertEquals($config1, $config2);
    }
}
