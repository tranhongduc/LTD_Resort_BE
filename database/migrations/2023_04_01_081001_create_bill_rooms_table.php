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
        Schema::create('bill_rooms', function (Blueprint $table) {
            $table->id();
            $table->float('total_amount');
            $table->integer('total_room');
            $table->integer('total_people');
            $table->string('payment_method');
            $table->date('pay_time');
            $table->date('checkout_time');
            $table->date('cancel_time');
            $table->float('tax');
            $table->float('discount');
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
        Schema::dropIfExists('bill_rooms');
    }
};
