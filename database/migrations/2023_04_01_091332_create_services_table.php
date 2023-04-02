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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('service_name');
            $table->string('image')->nullable();
            $table->string('description');
            $table->string('status');
            $table->float('price');
            $table->integer('point_ranking');
            $table->foreignId('feedback_id')->constrained('feedback')->onUpdate('cascade');
            $table->foreignId('service_type_id')->constrained('service_types')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
