<?php

# Depedencies Injection --> ketergantungan suatu objek terhadap objek lain

# Bar depends on Foo (bar tergantung dengan foo), sehingga Foo adalah dependecy untuk Bar

# jadi Dependency Injection pada kasus ini adalah memasukkan Foo ke Bar

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DependencyInjectionTest extends TestCase
{
   public function testDependencyInjection()
   {
    $foo = new Foo();
    $bar = new Bar($foo);

    self::assertEquals("foo and bar", $bar->bar());
   }
}
