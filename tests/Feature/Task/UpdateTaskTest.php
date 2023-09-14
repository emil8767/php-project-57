<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UpdateTaskTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_update_task_user_valid(): void
    {
        $this->seed();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->patch(route('tasks.update', 2), ['name' => 'Aslan', 'status_id' => 10]);
        $response->assertRedirect('/tasks');
        $response->assertValid();
        $this->assertDatabaseHas('tasks', [
            'name' => 'Aslan'
        ]);
    }

    public function test_update_task_user_invalid(): void
    {
        $this->seed();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->patch(route('tasks.update', 2), ['name' => '']);
        $response->assertInvalid(['name']);
    }

    public function test_update_task_guest(): void
    {
        $this->seed();
        $response = $this->patch(route('tasks.update', 2));
        $response->assertStatus(403);
    }
}
