<?php

# config --> berisi file konfigurasi, berupa return array
# untuk mengakses valuenya --> config(nama_file_config.key.key);
return [
    "name" => [
        "first" => env("FIRSTNAME", "dira"),
        "last" => env("LASTNAME", "sanjaya"),
    ],
    "email" => "contoh@email.com"
];
