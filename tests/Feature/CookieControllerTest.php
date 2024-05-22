<?php

namespace Tests\Feature;

use Tests\TestCase;

class CookieControllerTest extends TestCase
{
   public function testCreateCookie()
   {
    // pada unit test akan dilakukan decrypt otomatis
    $this->get("/cookie/set")
    ->assertCookie("User-Id", "Dira")
    ->assertCookie("Is-Active", "true");
   }


   public function testGetCookie()
   {
    $this->withCookie("User-Id", "Dira")
    ->withCookie("Is-Active", true)
    ->get("/cookie/get")
    ->assertJson([
        "userId" => "Dira",
        "isActive" => "1"
    ]);
   }
}
