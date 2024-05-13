<?php

namespace App\Data;

# Depedencies Injection --> ketergantungan suatu objek terhadap objek lain

# Bar depends on Foo (bar tergantung dengan foo), sehingga Foo adalah dependecy untuk Bar

# jadi Dependency Injection pada kasus ini adalah memasukkan Foo ke Bar

class Bar
{
    private Foo $foo;
    public function __construct(Foo $foo)
    {
        $this->foo = $foo;
    }

    public function bar(): string
    {
        return $this->foo->foo() . " and bar";
    }
}
