<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Dosen extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_dosen';
    protected $fillable = ['id_dosen','nidn', 'nama_dosen'];

    public function mataKuliahs()
    {
        return $this->hasMany(MataKuliah::class, 'id_dosen');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_dosen');
    }


}
