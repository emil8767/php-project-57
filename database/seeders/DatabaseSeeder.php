<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TaskStatus;
use App\Models\Label;
use App\Models\Task;


class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        TaskStatus::factory()->create(['id' => 10, 'name' => 'sasha']);
        Task::factory()->create(['id' => 2, 'name' => 'baku', 'status_id' => 3]);
        Label::factory()->create(['id' => 5, 'name' => 'super', 'description' => 'how are you']);
    }
}
