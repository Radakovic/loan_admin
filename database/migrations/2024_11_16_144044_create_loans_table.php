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
        Schema::create('loans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('adviser_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('client_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['CASH', 'HOME']);
            $table->integer('cash_loan_amount')->nullable();
            $table->integer('property_value')->nullable();
            $table->integer('down_payment_amount')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['client_id', 'type']); // Enforce one CASH and one HOME loan per client
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
