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
        Schema::create('daftarmatakuliahs', function (Blueprint $table) {
            $table->id('id_daftarmatakuliah');
            $table->unsignedBigInteger('id_mahasiswa');
            $table->unsignedBigInteger('id_matakuliah');
            $table->float('AFL1')->nullable();
            $table->float('AFL2')->nullable();
            $table->float('AFL3')->nullable();
            $table->float('ALP')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftarmatakuliahs');
    }
};
