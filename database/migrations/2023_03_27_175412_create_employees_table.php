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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('gender');
            $table->date('birthday');
            $table->string('email')->unique();
            $table->string('CMND')->unique();
            $table->string('address');
            $table->string('phone')->unique();
            $table->string('account_bank');
            $table->string('name_bank');
            $table->dateTime('day_start');
            $table->dateTime('day_quit');
            $table->binary('image')->nullable();
            $table->boolean('status');
            $table->foreignId('account_id')->constrained('accounts')->onUpdate('cascade');
            $table->foreignId('department_id')->constrained('departments')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};