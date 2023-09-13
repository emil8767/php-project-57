<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('label_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('label_id')->nullable();
            $table->unsignedBigInteger('task_id');
            $table->index('label_id', 'label_task_label_idx');
            $table->index('task_id', 'label_task_task_idx');
            $table->foreign('task_id')->references('id')->on('tasks');
            $table->foreign('label_id')->references('id')->on('labels');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('label_tasks');
    }
};
