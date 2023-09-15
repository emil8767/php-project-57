<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexTaskTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex(): void
    {
        $this->seed();
        $response = $this->get('/tasks');
        $response->assertSee('baku');
        $response->assertStatus(200);
    }
}
