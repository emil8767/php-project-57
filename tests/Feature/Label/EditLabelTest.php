<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class EditLabelTest extends TestCase
{
    use RefreshDatabase;

    public function testEditLabelUser(): void
    {
        $this->seed();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('labels.edit', 5));

        $response->assertStatus(200);
    }

    public function testEditLabelGuest(): void
    {
        $this->seed();
        $response = $this->get(route('labels.edit', 5));
        $response->assertStatus(403);
    }
}
