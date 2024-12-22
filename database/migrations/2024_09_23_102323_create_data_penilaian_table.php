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
        Schema::create('data_penilaian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kriteria')->constrained('data_kriteria');
            $table->foreignId('id_alternatif')->constrained('data_alternatif');
            $table->string('nilai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_penilaian');
    }
};
