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
        Schema::create('bill_service_details', function (Blueprint $table) {
            $table->id();
            $table->float('amount');
            $table->integer('quantity');
            $table->foreignId('service_id')->constrained('services');
            $table->foreignId('bill_service_id')->constrained('bill_services');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_service_details');
    }
};
