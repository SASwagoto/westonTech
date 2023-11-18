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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('model')->nullable();
            $table->text('specification')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->string('slug')->unique();
            $table->unsignedInteger('stocks')->default(0);
            $table->double('purchase_price', 10, 2);
            $table->string('product_img')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('set null');
        });

        Schema::create('giftable', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->timestamps();
            
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
