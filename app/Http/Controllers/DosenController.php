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
    // Get the Dosen from the authenticated user
    $dosen = Auth::user()->dosen;

    // Retrieve the Mata Kuliah created by the Dosen
    $mataKuliahs = $dosen->mataKuliahs;

    // Initialize an empty array to hold Mahasiswa by Mata Kuliah
    $mahasiswasByMataKuliah = [];

    // Iterate through Mata Kuliah to get the corresponding Mahasiswa
    foreach ($mataKuliahs as $mataKuliah) {
        $mahasiswasByMataKuliah[$mataKuliah->id] = $mataKuliah->mahasiswas;
    }

    // Pass the data to the view, including $dosen
    return view('userDosen.index', compact('mataKuliahs', 'mahasiswasByMataKuliah', 'dosen'));
}

    public function changeGrades(MataKuliah $mataKuliah, Mahasiswa $mahasiswa)
    {
        // Retrieve the Mahasiswa related to this entry in daftarmatakuliahs
        // You can also filter by $mataKuliah if needed
        $mahasiswas = $mataKuliah->mahasiswas->where('id', $mahasiswa->id);

        return view('userDosen.change_grades', compact('mahasiswas'));
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

        $id_dosen = Auth::id(); // Change to get Dosen object

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

    public function editMahasiswaScores(Dosen $dosen, Mahasiswa $mahasiswa)
    {
        // Retrieve Mahasiswa scores and any other necessary data
        $mataKuliahs = $dosen->daftarmataKuliahs()->withPivot('AFL1', 'AFL2', 'AFL3', 'ALP')->get();

        // Pass the Mahasiswa and Mata Kuliah data to the view
        return view('userDosen.edit_mahasiswa_scores', compact('dosen', 'mahasiswa', 'mataKuliahs'));
    }
}
