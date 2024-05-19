<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DaftarMataKuliah extends Model
{
    use HasFactory;
    protected $table = 'daftarmatakuliahs';
    protected $primaryKey = 'id_daftarmatakuliah';
    protected $fillable = ['id_mahasiswa', 'id_matakuliah','AFL1','AFL2','AFL3','ALP'];

    public function mahasiswa() : BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }

    public function mataKuliah(): BelongsTo
    {
        return $this->belongsTo(MataKuliah::class, 'id_matakuliah');
    }

    


}
