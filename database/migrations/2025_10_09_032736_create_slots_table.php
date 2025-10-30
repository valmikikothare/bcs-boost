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
        Schema::create('slots', function (Blueprint $table) {
            $table->id(); // Primary key, AUTO_INCREMENT
            $table->string('name', 255); // Slot name
            $table->date('date'); // Slot date
            $table->time('start_time'); // Start time
            $table->time('end_time'); // End time
            $table->integer('no_of_attendees'); // Number of attendees
            $table->integer('status')->default(0); // 0=Pending,1=Approved,2=Completed

            // Timestamps and soft deletes
            $table->timestamp('created_at')->nullable()->default(null);
            $table->timestamp('updated_at')->nullable()->default(null);
            $table->timestamp('deleted_at')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slots');
    }
};
