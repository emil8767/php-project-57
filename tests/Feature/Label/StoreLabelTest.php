<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class StoreLabelTest extends TestCase
{
    use RefreshDatabase;

    public function testStoreGuest(): void
    {
        $response = $this->post(route('labels.store'));
        $response->assertStatus(403);
    }

    public function testStoreInvalid()
    {
        $this->seed();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post(route('labels.store'), ['name' => 'super']);
        $response->assertInvalid(['name']);
    }

    public function testStoreUserValid()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post(route('labels.store'), ['name' => 'Hi']);
        $response->assertRedirect('/labels');
        $this->assertDatabaseHas('labels', [
            'name' => 'Hi'
        ]);
        $response->assertValid();
    }
}
