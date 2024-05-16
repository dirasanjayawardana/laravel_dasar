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

   public function testDependencyInjection2()
   {
    // membuat object Foo sebagai singleton (hanya dibuat sekali)
    $this->app->singleton(Foo::class, function($app){
        return new Foo();
    });
    $this->app->singleton(Bar::class, function($app){
        return new Bar($app->make(Foo::class));
    });

    // jika membuat object dengan $this->app->make, maka dependency yg dibutuhkan akan diisi otomatis oleh container laravel
    $bar = $this->app->make(Bar::class);

    $foo = $this->app->make(Foo::class);
    $bar1 = $this->app->make(Bar::class);
    $bar2 = $this->app->make(Bar::class);

    self::assertSame($foo, $bar1->foo);
    self::assertSame($bar1, $bar2);
   }
}
