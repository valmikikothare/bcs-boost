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
        Schema::create('session_leads', function (Blueprint $table) {
            $table->id(); // Primary key, AUTO_INCREMENT
            $table->integer('user_id')->nullable();
            $table->integer('slot_id')->nullable();
            $table->text('agenda'); // Not nullable
            $table->longText('description'); // Not nullable
            $table->mediumText('other_details'); // Not nullable
            $table->integer('status')->default(0); // Default 0
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable()->default(DB::raw('NULL ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_leads');
    }
};
