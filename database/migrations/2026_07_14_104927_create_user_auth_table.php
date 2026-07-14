<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('pgsql')->create('global.user_auth', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role')->default('Employee');
            $table->enum('status', ['aktif', 'non-aktif'])->default('aktif');
            $table->timestamp('last_login')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::connection('pgsql')->dropIfExists('global.user_auth');
    }
};
