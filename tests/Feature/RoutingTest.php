<?php

namespace Tests\Feature;

use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testGet()
    {
        $this->get('/dira')
            ->assertStatus(200)
            ->assertSeeText("Hello dira sanjaya wardana");
    }

    public function testRedirect()
    {
        $this->get('/home')
            ->assertRedirect('/dira');
    }
}
