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
        Schema::create('pertanyaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formulir_id')->constrained('formulir')->onDelete('cascade');
            $table->integer('nomor');
            $table->text('teks');
            $table->enum('kategori', ['Gerak halus', 'Gerak kasar', 'Bicara dan bahasa', 'Sosialisasi dan kemandirian']);
            $table->enum('tipe_jawaban', ['Ya/Tidak'])->default('Ya/Tidak');
            $table->integer('bobot_nilai')->default(1);
            $table->string('petunjuk_gambar')->nullable();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pertanyaan');
    }
};
