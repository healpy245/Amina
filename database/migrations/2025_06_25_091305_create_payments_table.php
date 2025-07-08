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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->foreignId('contract_id')->constrained('contracts')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->string('payment_number')->unique();
            $table->enum('status', ['مكتمل', 'معلق', 'ملغي'])->default('مكتمل');
            $table->string('payment_method');
            $table->dateTime('paid_at');
            $table->double('deposit')->nullable()->comment('العربون');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
