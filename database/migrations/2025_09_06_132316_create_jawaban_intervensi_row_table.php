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
        Schema::create('jawaban_intervensi_row', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jawaban_id')->constrained('jawaban')->onDelete('cascade');
            $table->string('intervensi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_intervensi_row');
    }
};
