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
        Schema::create('cancellation_requests', function (Blueprint $table) {
            $table->id(); // Primary key, AUTO_INCREMENT
            $table->integer('slot_id'); // Not nullable
            $table->integer('user_id'); // Not nullable
            $table->integer('cancellation_status')->default(0); // 0 = Pending, 1 = Approved

            // Laravel timestamps + soft delete
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
        Schema::dropIfExists('cancellation_requests');
    }
};
