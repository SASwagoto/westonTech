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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id')->unique();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('aid');
            $table->timestamp('date')->nullable();
            $table->double('total', 10, 2)->default(0.00);
            $table->double('payment', 10, 2)->default(0.00);
            $table->double('due', 10, 2)->default(0.00);
            $table->unsignedBigInteger('seller_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
