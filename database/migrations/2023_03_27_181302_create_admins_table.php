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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->date('birthday');
            $table->string('gender');
            $table->string('email')->unique();
            $table->string('CMND')->unique();
            $table->string('address');
            $table->string('phone')->unique();
            $table->string('image')->nullable();
            $table->boolean('status');
            $table->foreignId('account_id')->constrained('accounts');
            $table->foreignId('position_id')->constrained('positions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
