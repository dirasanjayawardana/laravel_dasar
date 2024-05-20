<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText('Hello Dira');

        $this->get('/hello-again')
            ->assertSeeText('Hello Dira');
    }

    public function testNestedView()
    {
        $this->get('/hello-home')
            ->assertSeeText('Home, Hello Dira');
    }

    public function testViewWithoutRoute()
    {
        $this->view('hello', ['name' => 'Dira'])
            ->assertSeeText('Hello Dira');
    }
}
