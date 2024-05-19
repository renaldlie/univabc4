<?php

namespace App\Http\Controllers;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        public function index(Mahasiswa $mahasiswa)
    {
        $mataKuliahs = $mahasiswa->daftarmatakuliah()->with('matakuliah')->get();

        return view('userMahasiswa.index', compact('mahasiswa', 'mataKuliahs'));

    }
   


public function mataKuliah(Mahasiswa $mahasiswa)
{
    $mataKuliah = $mahasiswa->mataKuliah; // Ambil mata kuliah yang diambil oleh mahasiswa
    return view('mahasiswas.mata_kuliah', compact('mataKuliah'));
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
