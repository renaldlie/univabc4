@extends('layouts.app')

@section('content')
<a href="{{ route('dosens.index', ['dosen' => $dosen->id]) }}" class="btn btn-primary">Back to Home</a>
<h1>Mata Kuliah yang Diajarkan oleh Dosen</h1>

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($mataKuliahs->isEmpty())
    <p>Tidak ada Mata Kuliah yang ditemukan.</p>
@else
    <ul>
        @foreach ($mataKuliahs as $mataKuliah)
            <li>
                <h2>{{ $mataKuliah->nama_matakuliah }}</h2>
                <p>{{ $mataKuliah->hari }} - {{ $mataKuliah->start_time }} to {{ $mataKuliah->end_time }}</p>
                <p>Ruangan: {{ $mataKuliah->ruangan }}</p>
                <p>SKS: {{ $mataKuliah->sks }}</p>
                <h3>Mahasiswa yang Terdaftar</h3>
                <ul>
                    @if($mahasiswasByMataKuliah[$mataKuliah->id_matakuliah]->isNotEmpty())
                        @foreach ($mahasiswasByMataKuliah[$mataKuliah->id_matakuliah] as $mahasiswa)
                            <li>
                                {{ $mahasiswa->nama }} - NIM: {{ $mahasiswa->nim }}
                                <ul>
                                    <li>AFL1: {{ $mahasiswa->pivot->AFL1 }}</li>
                                    <li>AFL2: {{ $mahasiswa->pivot->AFL2 }}</li>
                                    <li>AFL3: {{ $mahasiswa->pivot->AFL3 }}</li>
                                    <li>ALP: {{ $mahasiswa->pivot->ALP }}</li>
                                </ul>
                            </li>
                        @endforeach
                    @else
                        <li>Tidak ada Mahasiswa yang terdaftar.</li>
                    @endif
                </ul>
            </li>
        @endforeach
    </ul>
@endif
@endsection
