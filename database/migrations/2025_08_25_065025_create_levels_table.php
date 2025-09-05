<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('levels', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();       // Nama level
            $table->string('description')->nullable(); // Deskripsi level
            $table->timestamps();
        });

      
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('level_id')->nullable()->constrained('levels')->onDelete('set null');
        });
    }

    public function down(): void
    {
       
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('level_id');
        });

        Schema::dropIfExists('levels');
    }
};
