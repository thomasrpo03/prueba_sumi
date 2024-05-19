<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTasksTableAddTaskStatusId extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('task_status_id')->nullable();
            $table->foreign('task_status_id')->references('id')->on('task_statuses');
            $table->dropColumn('completed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->boolean('completed')->default(0);
            $table->dropForeign(['task_status_id']);
            $table->dropColumn('task_status_id');
        });
    }
}
