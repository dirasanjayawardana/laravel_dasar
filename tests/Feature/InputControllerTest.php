<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        $this->get("/input/hello?name=dira")
            ->assertSeeText("Hello dira");

        $this->post("/input/hello", [
            "name" => "dira"
        ])
            ->assertSeeText("Hello dira");
    }


    // untuk mengirim request nya contoh via postman, bisa gunakan keynya --> name[first] dan name[last]
    public function testNestedInput()
    {
        $this->post("/input/hello/first", [
            "name" => [
                "first" => "dira",
                "last" => "sanjaya"
            ]
        ])->assertSeeText("Hello dira");
    }


    public function testAllInput()
    {
        $this->post("/input/hello/all-input", [
            "name" => [
                "first" => "dira",
                "last" => "sanjaya"
            ]
        ])->assertSeeText("name")->assertSeeText("first")->assertSeeText("last")
            ->assertSeeText("dira")->assertSeeText("sanjaya");
    }


    // untuk mengirim request nya contoh via postman, bisa gunakan keynya --> products[0][name] dan product[1][name]
    public function testArrayInput()
    {
        $this->post("/input/hello/array-input", [
            "products" => [
                [
                    "name" => "baju",
                    "price" => "10000"
                ],
                [
                    "name" => "celana",
                    "price" => "20000"
                ]
            ]
        ])->assertSeeText("baju")->assertSeeText("celana");
    }


    public function testInputType()
    {
        $this->post("/input/type", [
            "name" => "dira",
            "married" => false,
            "birth-date" => "1999-10-10"
        ])->assertSeeText("dira")->assertSeeText("false")->assertSeeText("1999-10-10");
    }


    public function testFilterOnly()
    {
        $this->post("/input/filter/only", [
            "name" => [
                "first" => "dira",
                "middle" => "sanjaya",
                "last" => "wardana"
            ]
        ])->assertSeeText("dira")->assertSeeText("wardana")->assertDontSeeText("sanjaya");
    }
    public function testFilterExcept()
    {
        $this->post("/input/filter/except", [
            "username" => "dirasanjaya",
            "password" => "pass",
            "admin" => "true"
        ])->assertSeeText("dirasanjaya")->assertSeeText("pass")->assertDontSeeText("admin");
    }

    public function testFilterMerge()
    {
        $this->post("/input/filter/merge", [
            "username" => "dirasanjaya",
            "admin" => "true"
        ])->assertSeeText("dirasanjaya")
            ->assertSeeText("admin")->assertSeeText("false");
    }
}
