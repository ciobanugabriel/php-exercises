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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });

        Schema::table('tasks', function (Blueprint $table) {
            // Add a foreign key constraint to the assigned_user_id column
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
        Schema::table('tasks', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['user_id']);
        });
    }
};
