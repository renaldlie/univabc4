<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Dosen extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_dosen';
    protected $fillable = ['nidn', 'nama_dosen'];

    public function mataKuliahs()
    {
        return $this->hasMany(MataKuliah::class, 'id_dosen');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_dosen');
    }


    public function daftarmataKuliahs()
{
    return $this->hasMany(DaftarMataKuliah::class);
}
}
