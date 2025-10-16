<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('archive_preference', function (Blueprint $table) {
            $table->id(); // Primary key, AUTO_INCREMENT
            $table->integer('manage_preference_id')->nullable();
            $table->string('diet', 255)->nullable();
            $table->string('taste', 255)->nullable();
            $table->string('kitchen', 255)->nullable();
            $table->string('preparation', 255)->nullable();
            $table->text('like_ingredients')->nullable();
            $table->text('dislike_ingredients')->nullable();
            $table->string('clarity_of_instructions', 255)->nullable();
            $table->integer('fooditem_id')->nullable();
            $table->integer('feedback_id')->nullable();

            // Timestamps with default CURRENT_TIMESTAMP behavior
            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->nullable()->default(DB::raw('NULL ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archive_preference');
    }
};
