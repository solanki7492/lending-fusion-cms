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
        Schema::create('termsheets', function (Blueprint $table) {
            $table->id();
            $table->string('merchant_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->text('address')->nullable();
            $table->string('sent_to')->nullable();
            $table->text('termsheet')->nullable();
            $table->string('loan_amount')->nullable();
            $table->string('origination_fee')->nullable();
            $table->string('net_loan_amount')->nullable();
            $table->string('monthly_payment')->nullable();
            $table->string('interest_rate')->nullable();
            $table->string('loan_type_and_program_type')->nullable();
            $table->string('loan_type_and_program')->nullable();
            $table->string('additional_financing_available')->nullable();
            $table->enum ('status', ['pending', 'mail-send', 'funded'])->default('pending');
            $table->text('notes')->nullable();
            $table->string('email_sent_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('termsheets');
    }
};
