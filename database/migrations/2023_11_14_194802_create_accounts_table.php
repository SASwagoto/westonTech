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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('acc_name');
            $table->string('acc_type');
            $table->string('bank_name')->nullable();
            $table->string('acc_no')->nullable();
            $table->double('balance', 10, 2)->default(0.00);
            $table->boolean('isActive')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aid');
            $table->string('source');
            $table->date('date');
            $table->string('description')->nullable();
            $table->double('amount',10,2);
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aid');
            $table->string('payee');
            $table->date('date');
            $table->string('description')->nullable();
            $table->double('amount',10,2);
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('statements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aid');
            $table->string('trans_id')->unique();
            $table->unsignedInteger('income_id')->nullable();
            $table->unsignedInteger('expense_id')->nullable();
            $table->unsignedInteger('others')->nullable();
            $table->date('date');
            $table->string('notes')->nullable();
            $table->double('amount', 10, 2);
            $table->double('current_balance', 10, 2);
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statements');
        Schema::dropIfExists('incomes');
        Schema::dropIfExists('expenses');
        Schema::dropIfExists('accounts');
    }
};
