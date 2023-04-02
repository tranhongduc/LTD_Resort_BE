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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_name');
            $table->string('status');
            $table->foreignId('feedback_id')->constrained('feedback')->onUpdate('cascade');
            $table->foreignId('area_id')->constrained('areas')->onUpdate('cascade');
            $table->foreignId('floor_id')->constrained('floors')->onUpdate('cascade');
            $table->foreignId('room_type_id')->constrained('room_types')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
