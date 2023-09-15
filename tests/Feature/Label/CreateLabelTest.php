<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class CreateLabelTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateLabelUser(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/labels/create');

        $response->assertStatus(200);
    }

    public function testCreateLabelGuest(): void
    {
        $response = $this->get('/labels/create');
        $response->assertStatus(403);
    }
}
