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
        Schema::create('bill_extra_service_details', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->float('amount');
            $table->foreignId('bill_extra_service_id')->constrained('bill_extra_services')->onUpdate('cascade');
            $table->foreignId('extra_service_id')->constrained('extra_services')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_extra_service_details');
    }
};
