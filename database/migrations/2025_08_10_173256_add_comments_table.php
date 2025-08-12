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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            // Foreign key to the posts table
            $table->foreignId('post_id')
                ->constrained()
                ->onDelete('cascade');
            // If a post is deleted, its comments are deleted too

            // Foreign key to the users table (who made the comment)
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            // If a user is deleted, their comments are deleted

            // Comment content
            $table->text('content');

            // Created_at and updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
