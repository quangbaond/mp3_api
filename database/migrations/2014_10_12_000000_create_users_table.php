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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('user_name')->unique();
            $table->string('image')->nullable();
            $table->boolean('is_admin')->default(false);
            $table->bigInteger('balance')->default(0);
            $table->boolean('role')->default(1);
            $table->integer('sum_comment')->default(0);
            $table->integer('sum_list_music')->default(0);
            $table->integer('sum_upload')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('vip')->default(0);
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
