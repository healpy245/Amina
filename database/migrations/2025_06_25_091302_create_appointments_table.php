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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->date('date');
            $table->time('time');
            $table->text('notes')->nullable();
            $table->enum('type', ['عروس', 'سهرة'])->nullable()->comment('عروس أو سهرة');
            $table->enum('dress_type', ['تصميم', 'جاهز'])->nullable()->comment('تصميم أو جاهز');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
