<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigurationTest extends TestCase
{
    public function testConfig()
    {
        $firstName = config("contoh.name.first");
        $lastName = config("contoh.name.last");
        $email = config("contoh.email");

        self::assertEquals($firstName, "dira");
        self::assertEquals($lastName, "sanjaya");
        self::assertEquals($email, "contoh@email.com");
    }
}
