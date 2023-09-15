<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class DestroyTaskStatusTest extends TestCase
{
    use RefreshDatabase;

    public function testDestroyTaskStatusUser()
    {
        $this->seed();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->delete(route('task_statuses.destroy', 10));
        $response->assertRedirect('/task_statuses');
        $this->assertDatabaseMissing('task_statuses', [
            'name' => 'sasha'
        ]);
    }

    public function testDestroyTaskStatusGuest()
    {
        $this->seed();
        $response = $this->delete(route('task_statuses.destroy', 10));
        $response->assertStatus(403);
    }
}
