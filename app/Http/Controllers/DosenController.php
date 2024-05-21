<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\DaftarMataKuliah;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index(Request $request)
{

    $dosen = Auth::user()->dosen;

    $mataKuliahs = $dosen->mataKuliahs;

    $mahasiswasByMataKuliah = [];

    // Iterate through Mata Kuliah to get the corresponding Mahasiswa
    foreach ($mataKuliahs as $mataKuliah) {
        $mahasiswasByMataKuliah[$mataKuliah->id] = $mataKuliah->mahasiswas;
    }

    return view('userDosen.index', compact('mataKuliahs', 'mahasiswasByMataKuliah', 'dosen'));
}



    public function storeMatakuliah(Request $request)
    {
        $request->validate([
            'nama_matakuliah' => 'required|string|max:255',
            'hari' => 'required|string|max:255',
            'start_time' => 'required',
            'end_time' => 'required',
            'sks' => 'required|integer',
            'ruangan' => 'required|string|max:255',
        ]);

        $id_dosen = Auth::id();

    MataKuliah::create([
        'id_dosen' => $id_dosen,
        'nama_matakuliah' => $request->nama_matakuliah,
        'hari' => $request->hari,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'sks' => $request->sks,
        'ruangan' => $request->ruangan,
    ]);

    return redirect()->route('dosens.index', ['dosen' => $id_dosen])->with('success', 'Mata Kuliah created successfully.');
    }

    public function createMatakuliah()
    {
        $dosen = Auth::user()->dosen;
        return view('mata-kuliah.createMatakuliah', compact('dosen'));
    }

    public function grade()
    {
        $dosen = Auth::user()->dosen;
        return view('userDosen.grades', compact('dosen'));
    }

    public function editMahasiswaScores($mahasiswaId, $id_daftarmatakuliah)
{
        $mahasiswa = Mahasiswa::findOrFail($mahasiswaId);

    $mataKuliahs = MataKuliah::findOrFail($id_daftarmatakuliah);

        return view('edit_mahasiswa_scores', compact('mahasiswa', 'mataKuliahs'));
    }

    public function updateMahasiswaScores(Request $request, $mahasiswaId, $id_daftarmatakuliah)
{

    $request->validate([
        'AFL1' => 'required|numeric|min:0|max:100',
        'AFL2' => 'required|numeric|min:0|max:100',
        'AFL3' => 'required|numeric|min:0|max:100',
        'ALP' => 'required|numeric|min:0|max:100',
    ]);

    // Find the Mahasiswa and MataKuliah instances
    $mahasiswa = Mahasiswa::findOrFail($mahasiswaId);
    $mataKuliah = MataKuliah::findOrFail($id_daftarmatakuliah);


    $mataKuliah->mahasiswas()->updateExistingPivot($mahasiswa->id_mahasiswa, [
        'AFL1' => $request->AFL1,
        'AFL2' => $request->AFL2,
        'AFL3' => $request->AFL3,
        'ALP' => $request->ALP,
    ]);

    
    return redirect()->route('editMahasiswaScores', ['mahasiswa' => $mahasiswa->id_mahasiswa, 'id_daftarmatakuliah' => $mataKuliah->id_matakuliah])
                     ->with('success', 'Scores updated successfully.');
}
}
