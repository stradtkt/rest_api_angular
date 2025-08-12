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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            // Foreign key to users table (author of the post)
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            // This assumes you have a `users` table

            // Post fields
            $table->string('title');
            $table->text('content');

            // Laravel's timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
