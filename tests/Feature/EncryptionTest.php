<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class EncryptionTest extends TestCase
{
   public function testEncrypt()
   {
    $encrypt = Crypt::encrypt("Dira Sanjaya Wardana");
    $decrypt = Crypt::decrypt($encrypt);

    self::assertEquals("Dira Sanjaya Wardana", $decrypt);
   }
}
