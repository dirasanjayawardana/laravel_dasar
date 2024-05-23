<?php

namespace Tests\Feature;

use Tests\TestCase;

class ContohMiddlewareTest extends TestCase
{
    public function testInvalid()
    {
        $this->get("/middleware/api")
            ->assertStatus(401)
            ->assertSeeText("Access Denied");
    }

    public function testValid()
    {
        $this->withHeader("X-API-KEY", "DIRAPP")
            ->get("/middleware/api")
            ->assertStatus(200)
            ->assertSeeText("OK");
    }
}
