<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TaskStatus;
use App\Models\Label;


class DatabaseSeeder extends Seeder
{
    

    public function run(): void
    {
        TaskStatus::factory()->create(['id' => 10, 'name' => 'sasha']);
        Label::factory()->create(['id' => 5, 'name' => 'super', 'description' => 'how are you']);

    }
}
