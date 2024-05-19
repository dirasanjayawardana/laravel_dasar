<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HelloControllerTest extends TestCase
{
    public function testHello()
    {
        $this->get('/controller/hello/dira')
            ->assertSeeText("Hello dira");
    }

    public function testRequest()
    {
        $this->get('/controller/request', [
            "keyHeader" => "value header"
        ])->assertSeeText("controller/request")
            ->assertSeeText("http://localhost/controller/request")
            ->assertSeeText("http://localhost/controller/request")
            ->assertSeeText("GET")
            ->assertSeeText("1")
            ->assertSeeText("value header");
    }
}
