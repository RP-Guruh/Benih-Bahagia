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
        Schema::table('hasil_skrining', function (Blueprint $table) {
            $table->integer('prematur_minggu')->nullable();
            $table->string('usia_setelah_koreksi_prematur')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hasil_skrining', function (Blueprint $table) {
            //
        });
    }
};
