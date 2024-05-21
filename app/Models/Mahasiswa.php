<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_mahasiswa';
    protected $fillable = [
        'id_mahasiswa','nama', 'nim', 'angkatan', 'total_sks',
    ];

    public function daftarmatakuliah()
    {
        return $this->hasMany(DaftarMataKuliah::class,'id_mahasiswa');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_mahasiswa');
    }
    public function mataKuliahs()
    {
        return $this->belongsToMany(MataKuliah::class)
            ->withPivot('AFL1', 'AFL2', 'AFL3', 'ALP');
    }


}
