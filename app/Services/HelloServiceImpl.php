<?php

namespace App\Services;

class HelloServiceImpl implements HelloService
{
    public function hello(string $name): string
    {
        return "Hello $name";
    }
}
