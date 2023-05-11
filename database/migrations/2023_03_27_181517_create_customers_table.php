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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->nullable();
            $table->string('gender')->nullable();
            $table->date('birthday')->nullable();
            $table->string('CMND')->unique()->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->integer('ranking_point');
            $table->foreignId('account_id')->constrained('accounts');
            $table->foreignId('ranking_id')->constrained('rankings');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
