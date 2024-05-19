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
        // Get the Dosen from the request parameter
        $dosen = Auth::user()->dosen;

        // Retrieve the Mata Kuliah created by the Dosen
        $mataKuliahs = $dosen->mataKuliahs;

        // Initialize an empty array to hold Mahasiswa by Mata Kuliah
        $mahasiswasByMataKuliah = [];

        // Iterate through Mata Kuliah to get the corresponding Mahasiswa
        foreach ($mataKuliahs as $mataKuliah) {
            $mahasiswasByMataKuliah[$mataKuliah->id_matakuliah] = $mataKuliah->mahasiswas;
        }

        // Pass the data to the view
        return view('userDosen.index', compact('mataKuliahs', 'mahasiswasByMataKuliah'));

    }

   

    public function changeGrades(MataKuliah $mataKuliah, Mahasiswa $mahasiswa)
{
    // Retrieve the Mahasiswa related to this entry in daftarmatakuliahs
    // You can also filter by $mataKuliah if needed
    $mahasiswas = $mahasiswa->where('id', $mahasiswa->id)->first();

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

    // Get the authenticated Dosen's ID
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

    return redirect()->route('dosens.index')->with('success', 'Mata Kuliah created successfully.');
}


public function createMatakuliah()
{
    $dosen = Auth::user()->dosen;
    return view('mata-kuliah.createMatakuliah', compact('dosen'));
}


}
