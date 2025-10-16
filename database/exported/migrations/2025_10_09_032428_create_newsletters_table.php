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
        Schema::create('newsletters', function (Blueprint $table) {
            $table->id(); // Primary key, AUTO_INCREMENT
            $table->text('title')->nullable(); // Newsletter title
            $table->text('content')->nullable(); // Newsletter content
            $table->dateTime('date')->default(DB::raw('CURRENT_TIMESTAMP')); // Default current timestamp
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newsletters');
    }
};
