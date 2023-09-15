<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UpdateTaskTest extends TestCase
{
    use RefreshDatabase;

    public function testUpdateTaskUserValid(): void
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

    public function testUpdateTaskUserInvalid(): void
    {
        $this->seed();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->patch(route('tasks.update', 2), ['name' => '']);
        $response->assertInvalid(['name']);
    }

    public function testUpdateTaskGuest(): void
    {
        $this->seed();
        $response = $this->patch(route('tasks.update', 2));
        $response->assertStatus(403);
    }
}
