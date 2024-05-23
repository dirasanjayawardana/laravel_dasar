<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionControllerTest extends TestCase
{
    public function testCreateSession()
    {
        $this->get("/session/create")
            ->assertSeeText("OK")
            ->assertSessionHas("userId", "dira")
            ->assertSessionHas("isActive", "true");
    }

    public function testGetSession()
    {
        $this->withSession([
            "userId" => "dira",
            "isActive" => "true"
        ])->get("/session/get")
            ->assertSeeText("dira")->assertSeeText("true");
    }
}
