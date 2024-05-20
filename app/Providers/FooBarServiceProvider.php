<?php

namespace App\Providers;

use App\Services\HelloService;
use App\Services\HelloServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

// Binding, Singleton/Instance, best practicenya dibuat di ServiceProvider
// setelah membuat ServiceProvider, harus didaftarkan pada config/app.php dibagian 'providers'
// DeferreableProvider --> ServiceProvider tidak akan dieksekusi jika class Foo atau Bar tidak di panggil (lazy)
class FooBarServiceProvider extends ServiceProvider implements DeferrableProvider
{
    // melakukan binding singleton interface to class sederhana
    public array $singletons = [
        HelloService::class => HelloServiceImpl::class
    ];

    // function register akan dieksekusi terlebih dahulu sebelum boot
    public function register()
    {
        echo"FooBarServiceProvider";
        $this->app->singleton(Foo::class, function () {
            return new Foo();
        });
        $this->app->singleton(Bar::class, function ($app) {
            return new Bar($app->make(Foo::class));
        });
    }

    public function boot()
    {

    }

    // DeferreableProvider --> ServiceProvider tidak akan dieksekusi jika class Foo atau Bar tidak di panggil (lazy)
    public function provides()
    {
       return [HelloService::class, Foo::class, Bar::class];
    }
}
