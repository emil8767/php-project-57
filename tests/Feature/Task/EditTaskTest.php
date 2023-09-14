<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class EditTaskTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_edit_task_user(): void
    {
        $this->seed();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('tasks.edit', 2));

        $response->assertStatus(200);
    }

    public function test_edit_task_guest(): void
    {
        $this->seed();
        $response = $this->get(route('tasks.edit', 2));
        $response->assertStatus(403);
    }
}
