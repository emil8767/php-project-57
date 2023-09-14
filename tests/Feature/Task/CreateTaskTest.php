<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class CreateTaskTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_create_task_user(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/tasks/create');

        $response->assertStatus(200);
    }

    public function test_create_task_guest(): void
    {
        
        $response = $this->get('/tasks/create');

        $response->assertStatus(403);
    }
}
