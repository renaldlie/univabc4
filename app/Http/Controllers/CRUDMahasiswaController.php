<?php

namespace App\Http\Controllers;
use App\Models\Mahasiswa;
use App\Models\DaftarMatakuliah;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class CRUDMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswas = Mahasiswa::all();
        return view('mahasiswas.index', compact('mahasiswas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required',
            'angkatan' => 'required',
            'total_sks' => 'required',
        ]);

        Mahasiswa::create($request->all());

        return redirect()->route('mahasiswas.index')
                         ->with('success', 'Mahasiswa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        $mataKuliahs = $mahasiswa->daftarmatakuliah()->with('matakuliah')->get();

        return view('mahasiswas.show', compact('mahasiswa', 'mataKuliahs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswas.edit', compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required',
            'angkatan' => 'required',
            'total_sks' => 'required',
        ]);

        $mahasiswa->update($request->all());

        return redirect()->route('mahasiswas.index')
                         ->with('success', 'Mahasiswa updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect()->route('mahasiswas.index')
                         ->with('success', 'Mahasiswa deleted successfully');
    }

    public function ambilMatakuliah(Request $request)
{
    // Validate request data
    $request->validate([
        'id_matakuliah' => 'required|exists:matakuliahs,id',
    ]);

    // Calculate total SKS already taken by Mahasiswa
    $totalSksTaken = DaftarMatakuliah::where('id_mahasiswa', auth()->user()->id)->sum('sks');

    // Get SKS of the selected Matakuliah
    $sksMatakuliah = Matakuliah::findOrFail($request->id_matakuliah)->sks;

    // Check if adding this Matakuliah exceeds the SKS limit (21)
    if ($totalSksTaken + $sksMatakuliah > 21) {
        return redirect()->back()->with('error', 'SKS limit exceeded.');
    }

    // Add the selected Matakuliah to DaftarMatakuliah
    DaftarMatakuliah::create([
        'id_mahasiswa' => auth()->user()->id,
        'id_matakuliah' => $request->id_matakuliah,
        'sks' => $sksMatakuliah,
    ]);

    return redirect()->route('dashboard')
                     ->with('success', 'Matakuliah added successfully.');
}
}
