<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mahasiswa::create([
            'nama' => 'John Doe',
            'nim' => '123456789',
            'angkatan' => 2020,
            'total_sks' => 100,
        ]);

        Mahasiswa::create([
            'nama' => 'Jane Smith',
            'nim' => '987654321',
            'angkatan' => 2019,
            'total_sks' => 120,
        ]);
    }
}
