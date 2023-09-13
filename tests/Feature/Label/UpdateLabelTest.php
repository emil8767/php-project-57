<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UpdateLabelTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_update_label_user_valid(): void
    {
        $this->seed();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->patch(route('labels.update', 5), ['name' => 'Aslan']);
        $response->assertRedirect('/labels');
        $response->assertValid();
        $this->assertDatabaseHas('labels', [
            'name' => 'Aslan'
        ]);
    }

    public function test_update_label_user_invalid(): void
    {
        $this->seed();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->patch(route('labels.update', 5), ['name' => '']);
        $response->assertInvalid(['name']);
    }

    public function test_update_label_guest(): void
    {
        $this->seed();
        $response = $this->patch(route('labels.update', 5));
        $response->assertStatus(403);
    }
}
