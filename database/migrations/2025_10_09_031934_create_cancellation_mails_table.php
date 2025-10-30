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
        Schema::create('cancellation_mails', function (Blueprint $table) {
            $table->id(); // Primary key, AUTO_INCREMENT
            $table->string('email', 255);
            $table->text('mail_template');
            $table->integer('role'); // 1 = Lead, 2 = Participants
            $table->text('subject');
            $table->integer('email_send_status')->default(0); // 0 = Not Sent, 1 = Sent

            // timestamps
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
        Schema::dropIfExists('cancellation_mails');
    }
};
