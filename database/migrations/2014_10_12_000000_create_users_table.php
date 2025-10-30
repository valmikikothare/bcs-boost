<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key, UNSIGNED BIGINT AUTO_INCREMENT
            $table->string('name', 255);
            $table->integer('role')->default(2); // 1=Admin, 2=User
            $table->string('email', 255);
            $table->string('image', 255)->nullable();
            $table->text('laboratory_name')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255)->nullable();
            $table->string('mobile_no', 255)->nullable();
            $table->string('country', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->integer('zipcode')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->integer('isfirstlogin')->default(0);
            $table->string('language', 255)->default('en');
            $table->string('email_verification_token', 255)->nullable();
            $table->integer('verified_status')->nullable();

            // Timestamps and soft deletes
            $table->timestamp('created_at')->nullable()->default(null);
            $table->timestamp('updated_at')->nullable()->default(null);
            $table->timestamp('deleted_at')->nullable()->default(null);
        });

        // Insert default admin user
        DB::table('users')->insert([
            'name' => 'bcs-boost-admin',
            'role' => 1,
            'email' => 'bcs-boost@mit.edu',
            'password' => Hash::make('abcd1234!'),
            'verified_status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
