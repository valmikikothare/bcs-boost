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
        Schema::create('newsletter_subscribers', function (Blueprint $table) {
            $table->id(); // Primary key, AUTO_INCREMENT
            $table->string('email', 255)->nullable(); // Subscriber email
            $table->dateTime('date')->default(DB::raw('CURRENT_TIMESTAMP')); // Subscription date
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newsletter_subscribers');
    }
};
