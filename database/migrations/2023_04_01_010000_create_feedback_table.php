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
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_request');
            $table->dateTime('date_response');
            $table->string('feedback_type');
            $table->string('image')->nullable();
            $table->integer('rating');
            $table->string('title')->nullable();
            $table->string('comment')->nullable();
            $table->string('feedback_status');
            $table->foreignId('customer_id')->constrained('customers')->onUpdate('cascade');
            $table->foreignId('employee_id')->constrained('employees')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
