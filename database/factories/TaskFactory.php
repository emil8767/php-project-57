<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TaskStatus;
use App\Models\User;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create();
        $status = TaskStatus::factory()->create(['id' => 3, 'name' => 'hexlet']);
        return [
            'name' => fake()->word(),
            'description' => fake()->text(),
            'status_id' => $status->id,
            'created_by_id' => $user->id,
            'assigned_to_id' => $user->id,
        ];
    }
}
