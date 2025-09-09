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
        Schema::create('hasil_skrining', function (Blueprint $table) {
            $table->id();
            $table->string('nama_siswa');
            $table->string('nama_orangtua')->nullable();
            $table->string('tanggal_lahir');
            $table->foreignId('formulir_id')->constrained('formulir')->onDelete('cascade');
            $table->foreignId('jawaban_id')->nullable()->constrained('jawaban')->onDelete('set null');
            $table->integer('usia_pembulatan');
            $table->string('usia_aktual', 50);
            $table->json('jawaban');
            $table->integer('total_skor')->default(0);
            $table->integer('total_ya')->default(0);
            $table->integer('total_tidak')->default(0);
            $table->integer('user_id')->constrained()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_skrining');
    }
};
