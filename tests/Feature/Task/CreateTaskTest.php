<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class CreateTaskTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateTaskUser(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/tasks/create');

        $response->assertStatus(200);
    }

    public function testCreateTaskGuest(): void
    {
        $response = $this->get('/tasks/create');

        $response->assertStatus(403);
    }
}
