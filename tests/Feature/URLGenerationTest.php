<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class URLGenerationTest extends TestCase
{
    public function testURLCurrent()
    {
        $this->get("/url/current?name=dira")
            ->assertSeeText("/url/current?name=dira");
    }

    public function testNamed()
    {
        $this->get("/url/named")->assertSeeText("/redirect/hello/dira");
    }

    public function testAction()
    {
        $this->get("/url/action")->assertSeeText("/form");
    }
}
