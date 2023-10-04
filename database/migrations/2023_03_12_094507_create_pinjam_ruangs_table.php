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
        Schema::create('pinjam_ruangs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_ruang');
            $table->text('kegiatan');
            $table->string('penanggung_jawab');
            $table->dateTime('mulai');
            $table->dateTime('selesai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjam_ruangs');
    }
};
