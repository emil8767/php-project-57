<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class DestroyLabelTest extends TestCase
{
    use RefreshDatabase;

    public function testDestroyLabelUser()
    {
        $this->seed();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->delete(route('labels.destroy', 5));
        $response->assertRedirect('/labels');
        $this->assertDatabaseMissing('labels', [
            'description' => 'how are you'
        ]);
    }

    public function testDestroyLabelGuest()
    {
        $this->seed();
        $response = $this->delete(route('labels.destroy', 5));
        $response->assertStatus(403);
        $this->assertDatabaseHas('labels', [
            'description' => 'how are you'
        ]);
    }
}
