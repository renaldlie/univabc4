<?php

namespace App\Http\Controllers;
use App\Models\Dosen;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CRUDDosenController extends Controller
{
    public function index(Request $request)
    {
        $dosen = Auth::user()->dosen;

        $mataKuliahs = $dosen->mataKuliahs;

        // Initialize an empty array to hold Mahasiswa by Mata Kuliah
        $mahasiswasByMataKuliah = [];

        // Iterate through Mata Kuliah to get the corresponding Mahasiswa
        foreach ($mataKuliahs as $mataKuliah) {
            $mahasiswasByMataKuliah[$mataKuliah->id_matakuliah] = $mataKuliah->mahasiswas;
        }

        // Pass the data to the view
        return view('dosens.index', compact('mataKuliahs', 'mahasiswasByMataKuliah'));
    }

    public function create()
    {
        return view('dosens.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nidn' => 'required|unique:dosens',
            'nama_dosen' => 'required',
        ]);

        Dosen::create($request->all());

        return redirect()->route('dosens.index')
                         ->with('success', 'Dosen created successfully.');
    }

    public function show(Dosen $id)
{

    $mataKuliah = MataKuliah::where('id_dosen', $id->id_dosen)->first();


    if ($mataKuliah) {

        $dosen = $mataKuliah->dosen;

        // Retrieve all MataKuliah instances related to the Dosen
        $matakuliahs = $dosen->matakuliahs;
    } else {
        // If no related MataKuliah record is found, set $dosen to the original Dosen instance
        $dosen = $id;
        $matakuliahs = collect(); // Create an empty collection
    }

    // Kirim data dosen dan daftar mata kuliah ke view dosen.show
    return view('dosens.show', compact('dosen', 'matakuliahs'));
}

    public function update(Request $request, Dosen $dosen)
    {
        $request->validate([
            'nama_dosen' => 'required',
        ]);

        $dosen->update($request->all());

        return redirect()->route('dosens.index')
                         ->with('success', 'Dosen updated successfully');
    }

    public function edit(Dosen $dosen)
    {
        return view('dosens.edit', compact('dosen'));
    }

    public function destroy(Dosen $dosen)
    {
        $dosen->delete();

        return redirect()->route('dosens.index')
                         ->with('success', 'Dosen deleted successfully');
    }

    public function createMatakuliah(Request $request)
{
    // Validate request data
    $request->validate([
        'nama_matakuliah' => 'required',
        'hari' => 'required',
        'start_time' => 'required',
        'end_time' => 'required',
        'sks' => 'required|numeric',
        'ruangan' => 'required',
    ]);

    // Create new Matakuliah
    $matakuliah = Matakuliah::create([
        'id_dosen' => auth()->user()->id, // Assuming authenticated dosen ID
        'nama_matakuliah' => $request->nama_matakuliah,
        'hari' => $request->hari,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'sks' => $request->sks,
        'ruangan' => $request->ruangan,
    ]);

    return redirect()->route('dosens.show')
                     ->with('success', 'Matakuliah created successfully.');
}


}
