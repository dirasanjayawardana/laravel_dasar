<?php

namespace App\Data;

class Person
{
    // fitur php 8, setiap variabel yang ada di constructor, secara otomatis akan dideklarasikan sebagai property class tersebut
    public function __construct(
        public string $firstName,
        public string $lastName
    )

    {
        
    }
}
