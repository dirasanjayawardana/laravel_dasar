<?php

namespace Tests\Feature;

use Tests\TestCase;

class RedirectControllerTest extends TestCase
{
    public function testRedirect()
    {
        $this->get("/redirect/from")
            ->assertRedirect("redirect/to");
    }

    public function testRedirectName()
    {
        $this->get("/redirect/name")
            ->assertRedirect("/redirect/hello/dira");
    }

    public function testRedirectAction()
    {
        $this->get("/redirect/action")
            ->assertRedirect("/redirect/hello/dira");
    }

    public function testRedirectAway()
    {
        $this->get("/redirect/dirapp")
            ->assertRedirect("https://dirhome.vercel.app/");
    }
}
