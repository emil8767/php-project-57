<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\TaskStatus;

class StoreTaskStatusTest extends TestCase
{
    use RefreshDatabase;
   
    public function test_store_guest(): void
    {
        
        $response = $this->post(route('task_statuses.store'));

        $response->assertStatus(403);
    }

    public function test_store_user() {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post(route('task_statuses.store'), ['name' => 'Cantel']);
        $response->assertRedirect('/task_statuses');
        $this->assertDatabaseHas('task_statuses', [
            'name' => 'Cantel'
        ]);
    }
}
