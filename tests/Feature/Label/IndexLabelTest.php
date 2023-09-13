<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexLabelTest extends TestCase
{
    use RefreshDatabase;

    public function test_index(): void
    {
        $this->seed();
        $response = $this->get('/labels');
        $response->assertSee('how are you');
        $response->assertStatus(200);
    }
}
