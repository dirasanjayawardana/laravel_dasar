<?php

# Depedencies Injection --> ketergantungan suatu objek terhadap objek lain

# Bar depends on Foo (bar tergantung dengan foo), sehingga Foo adalah dependecy untuk Bar

# jadi Dependency Injection pada kasus ini adalah memasukkan Foo ke Bar

namespace Tests\Feature;

use App\Data\Foo;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceImpl;
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

    // Binding, Singleton/Instance, best practicenya dibuat di ServiceProvider
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

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals($person1->firstName, $person2->firstName);
    }

    public function testInstance()
    {
        // cara lain membuat object singleton
        $person = new Person("Dira", "sanjaya");
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals($person1->firstName, $person2->firstName);
    }

    public function testInterfaceToClass()
    {
        // cara instansiasi interface agar seperti class, karena secara default interface tidak bisa diinstansiasi
        $this->app->singleton(HelloService::class, HelloServiceImpl::class);

        // cara lain bisa menggunakan closure, sama saja
        // $this->app->singleton(HelloService::class, function($app){
        //     return new HelloServiceImpl();
        // });

        $helloService = $this->app->make(HelloService::class);

        self::assertEquals("Hello Dira", $helloService->hello("Dira"));
    }
}
