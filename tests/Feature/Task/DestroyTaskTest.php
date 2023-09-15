<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Task;

class DestroyTaskTest extends TestCase
{
    use RefreshDatabase;

    public function testDestroyTaskNotTheAuthor()
    {
        $this->seed();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->delete(route('tasks.destroy', 2));
        $response->assertStatus(403);
    }

    public function testDestroyTaskGuest()
    {
        $this->seed();
        $response = $this->delete(route('tasks.destroy', 2));
        $response->assertStatus(403);
        $this->assertDatabaseHas('tasks', [
            'name' => 'baku'
        ]);
    }

    public function testDestroyTaskAuthor()
    {
        $this->seed();
        $task = Task::where('name', 'baku')->firstOrFail();
        $response = $this->actingAs($task->created_by)->delete(route('tasks.destroy', $task));
        $response->assertRedirect('/tasks');
        $this->assertDatabaseMissing('tasks', [
            'name' => 'baku'
        ]);
    }
}
