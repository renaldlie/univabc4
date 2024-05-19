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
        Schema::table('mahasiswas', function (Blueprint $table) {
        $table->foreign('id_mahasiswa')->references('id')->on('users')->onDelete('cascade');
    });

    Schema::table('dosens', function (Blueprint $table) {
        $table->foreign('id_dosen')->references('id')->on('users')->onDelete('cascade');
    });

        Schema::table('matakuliahs', function (Blueprint $table) {
            $table->foreign('id_dosen')->references('id_dosen')->on('dosens')->onDelete('cascade');
        });

        Schema::table('daftarmatakuliahs', function (Blueprint $table) {
            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswas')->onDelete('cascade');
            $table->foreign('id_matakuliah')->references('id_matakuliah')->on('matakuliahs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('matakuliahs', function (Blueprint $table) {
            $table->dropForeign(['id_dosen']);
        });

        Schema::table('daftarmatakuliahs', function (Blueprint $table) {
            $table->dropForeign(['id_mahasiswa']);
            $table->dropForeign(['id_matakuliah']);
        });
    }
};
