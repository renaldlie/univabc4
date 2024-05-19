<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\Mahasiswa;
use App\Models\DaftarMataKuliah;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{

    public function index(Mahasiswa $mahasiswa)
    {
        $mahasiswa = Auth::user()->mahasiswa;
        $mataKuliah = $mahasiswa->mataKuliah; // Ambil mata kuliah yang diambil oleh mahasiswa
        return view('mahasiswas.mata_kuliah', compact('mataKuliah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mahasiswa = Auth::user()->mahasiswa;
        $matakuliahs = \App\Models\MataKuliah::all();
        return view('mata-kuliah.create', compact('mahasiswa', 'matakuliahs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'matakuliah' => 'required|exists:matakuliahs,id_matakuliah', // Ensure the selected Mata Kuliah exists
        ]);

        // Get the logged-in Mahasiswa
        $mahasiswa = Auth::user()->mahasiswa;

        // Get the SKS for the selected Mata Kuliah
        $selectedMataKuliah = MataKuliah::findOrFail($request->matakuliah);
        $sksForSelectedMataKuliah = $selectedMataKuliah->sks;

        // Get the total SKS of all the MataKuliahs associated with the Mahasiswa
        $newTotalSks = $mahasiswa->daftarmatakuliah->sum(function ($daftarMataKuliah) {
            return $daftarMataKuliah->matakuliah->sks;
        });

        // Check if adding the new Mata Kuliah will exceed the total SKS limit
        $sksForSelectedMataKuliah = MataKuliah::find($request->matakuliah)->sks;
        if ($newTotalSks + $sksForSelectedMataKuliah > $mahasiswa->total_sks) {
            return redirect()->route('mata-kuliah.create')->with('error', 'Adding this Mata Kuliah will exceed the total SKS limit.');
        }

        // Check if the Mahasiswa already has the selected Mata Kuliah
        if ($mahasiswa->daftarmatakuliah()->where('id_matakuliah', $request->matakuliah)->exists()) {
            return redirect()->route('mata-kuliah.create')->with('error', 'You have already added this Mata Kuliah.');
        }

        // Create a new entry in the daftarmatakuliahs table associating the Mahasiswa with the selected Mata Kuliah
        DaftarMataKuliah::create([
            'id_mahasiswa' => $mahasiswa->id_mahasiswa,
            'id_matakuliah' => $request->matakuliah,
            // Add more fields as needed
        ]);

        // Redirect to the mahasiswa.index route with the appropriate mahasiswa parameter
        return redirect()->route('mahasiswa.index', ['mahasiswa' => $mahasiswa])->with('success', 'Mata Kuliah added successfully.');
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

        return redirect()->route('dosen.index', ['dosen' => $id_dosen])->with('success', 'Mata Kuliah added successfully.');
    }


    public function createMatakuliah()
    {
        $dosen = Auth::user()->dosen;
        return view('mata-kuliah.createMatakuliah', compact('dosen'));
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
