<?php

# Depedencies Injection --> ketergantungan suatu objek terhadap objek lain

# Bar depends on Foo (bar tergantung dengan foo), sehingga Foo adalah dependecy untuk Bar

# jadi Dependency Injection pada kasus ini adalah memasukkan Foo ke Bar

namespace Tests\Feature;

use App\Data\Foo;
use App\Data\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
    public function testDependencyInjection()
    {
        // cara lain instansiasi object dengan $this->app->make(nama_class::class)
        $foo = $this->app->make(Foo::class);

        self::assertEquals("foo", $foo->foo());
    }

    public function testBind()
    {
        // memberi tahu jika ada yang membuat Object Person, maka akan mengikuti autran constructor ini
        $this->app->bind(Person::class, function ($app) {
            return new Person("Dira", "Sanjaya");
        });

        $person = $this->app->make(Person::class);

        self::assertEquals("Dira", $person->firstName);
    }

    public function testSingleton()
    {
        // instansiasi object yang dihasilkan akan meruutk pada object yang sama
        $this->app->singleton(Person::class, function ($app){
            return new Person("Dira","sanjaya");
        });
    }
}
