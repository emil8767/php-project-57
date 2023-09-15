<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowTaskTest extends TestCase
{
    use RefreshDatabase;

    public function testShow(): void
    {
        $this->seed();
        $response = $this->get('/tasks/2');
        $response->assertSee('baku');
        $response->assertSee('hexlet');
        $response->assertStatus(200);
    }
}
