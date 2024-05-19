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
        Schema::create('matakuliahs', function (Blueprint $table) {
            $table->id('id_matakuliah');
            $table->unsignedBigInteger('id_dosen');
            $table->string('nama_matakuliah');
            $table->string('hari');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('sks');
            $table->string('ruangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matakuliahs');
    }
};
