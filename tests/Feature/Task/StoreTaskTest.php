<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class StoreTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_guest(): void
    {
        $response = $this->post(route('tasks.store'));
        $response->assertStatus(403);
    }

    public function test_store_invalid() {
        $this->seed();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post(route('tasks.store'), ['name' => 'baku']);
        $response->assertInvalid(['name']);
    }

    public function test_store_user_valid() {
        $this->seed();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post(route('tasks.store'), ['name' => 'Hi', 'status_id' => 10]);
        $response->assertRedirect('/tasks');
        $this->assertDatabaseHas('tasks', [
            'name' => 'Hi'
        ]);
        $response->assertValid();
    }

}
