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

        // Roles Table
        Schema::create('roles', function (Blueprint $table) {
            $table->id('role_id'); // Primary Key
            $table->string('role_name', 50)->unique(); // Role name should be unique
            $table->timestamps(0); // created_at and updated_at with default precision
        });

        // Users Table
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id'); // Primary Key
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->unsignedBigInteger('role_id');

            $table->foreign('role_id')->references('role_id')->on('roles')->cascadeOnDelete();
        });

        // Categories Table
        Schema::create('categories', function (Blueprint $table) {
            $table->id('category_id'); // Primary Key
            $table->string('name', 100)->unique();
            $table->text('description')->nullable();
            $table->timestamps(0); // created_at and updated_at with default precision
        });

        // Tourist Spots Table
        Schema::create('tourist_spots', function (Blueprint $table) {
            $table->id('spot_id'); // Primary Key
            $table->string('name', 100);
            $table->string('location', 255);
            $table->text('description')->nullable();
            $table->decimal('rating', 3, 1)->default(0.0); // Rating with 3 digits, 1 after the decimal point
            $table->unsignedBigInteger('created_by'); // Foreign key reference to users
            $table->unsignedBigInteger('category_id'); // Foreign key reference to categories
            $table->timestamps(0); // created_at and updated_at with default precision

            // Foreign Key Constraints
            $table->foreign('created_by')->references('user_id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('category_id')->references('category_id')->on('categories')->cascadeOnDelete()->cascadeOnUpdate();
        });

        // Logs Table
        Schema::create('logs', function (Blueprint $table) {
            $table->id('log_id'); // Primary Key
            $table->unsignedBigInteger('user_id');
            $table->string('current_user');
            $table->string('action_type');
            $table->string('table_name');
            $table->timestamp('date')->default(now());
            $table->string('column_name');

            $table->foreign('user_id')->references('user_id')->on('users')->cascadeOnDelete();
        });

        // Sessions Table
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // Cache Table
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });

        // Password Reset Tokens Table
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('cache');
        Schema::dropIfExists('logs');
        Schema::dropIfExists('tourist_spots');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
    }
};
