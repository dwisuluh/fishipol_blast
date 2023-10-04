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
        Schema::create('kontaks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama');
            $table->string('no_hp')->unique();
            $table->foreignUuid('dosen_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignUuid('tendik_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignUuid('mahasiswa_id')->nullable()->constrained()->onDelete('cascade');
            $table->enum('jenis',['1','2','3','4','5'])->default('5');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontaks');
    }
};
