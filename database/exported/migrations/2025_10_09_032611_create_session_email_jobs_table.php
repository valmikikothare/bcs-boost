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
        Schema::create('session_email_jobs', function (Blueprint $table) {
            $table->id(); // Primary key, AUTO_INCREMENT
            $table->string('email', 255); // Recipient email
            $table->integer('type')->nullable(); // 0 = Lead, 1 = Participants
            $table->integer('status')->default(0); // 0 = Not sent, 1 = Mail sent

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
        Schema::dropIfExists('session_email_jobs');
    }
};
