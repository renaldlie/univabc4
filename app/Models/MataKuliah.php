<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MataKuliah extends Model
{
    use HasFactory;
    protected $table = 'matakuliahs';
    protected $primaryKey = 'id_matakuliah';
    protected $fillable = ['id_dosen', 'nama_matakuliah','hari','start_time','end_time','sks','ruangan'];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }

    public function daftarMataKuliahs()
    {
        return $this->hasMany(DaftarMataKuliah::class, 'id_matakuliah');
    }

    public function mahasiswas()
    {
        return $this->belongsToMany(Mahasiswa::class, 'daftarmatakuliahs', 'id_matakuliah', 'id_mahasiswa')
        ->withPivot('AFL1', 'AFL2', 'AFL3', 'ALP');
    }
}
