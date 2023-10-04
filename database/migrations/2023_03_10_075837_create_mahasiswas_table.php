<?php

use App\Models\ProgramStudi;
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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nim')->unique();
            $table->string('nama');
            $table->string('kode_prodi',5)->nullable();
            $table->foreign('kode_prodi')->references('kode')->on('program_studis')->onDelete('set null');
            $table->string('angkatan');
            $table->string('no_hp')->unique()->nullable();
            $table->string('email')->unique();
            $table->timestamps();
        });

        // Schema::table('mahasiswas', function (Blueprint $table){
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
