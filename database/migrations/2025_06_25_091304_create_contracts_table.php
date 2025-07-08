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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->foreignId('dress_id')->constrained('dresses')->onDelete('cascade');
            $table->boolean('deposit_paid')->default(false);
            $table->dateTime('signed_at');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->decimal('amount', 10, 2)->default(0);
            $table->string('contract_number')->unique();
            $table->enum('status', ['مكتمل', 'معلق', 'ملغي'])->default('مكتمل');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
