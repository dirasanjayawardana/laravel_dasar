<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    public function testResponse()
    {
        $this->get("/response/hello")
            ->assertStatus(200)
            ->assertSeeText("Hello Response");
    }


    public function testHeader()
    {
        $this->get("/response/header")
            ->assertStatus(200)
            ->assertSeeText("Dira")->assertSeeText("Sanjaya")
            ->assertHeader("Content-Type", "application/json")
            ->assertHeader("Author", "Dira Sanjaya Wardana")
            ->assertHeader("App", "Laravel Dasar");
    }


    public function testView()
    {
        $this->get("/response/view")
            ->assertSeeText("Hello Dira");
    }


    public function testJson()
    {
        $this->get("/response/json")
            ->assertJson(["firstName" => "Dira", "lastName" => "Sanjaya"]);
    }


    public function testDownload()
    {
        $this->get("/response/download")
            ->assertDownload("gambar.png");
    }
}
