@extends('layouts.app')

@section('content')
    <h1>Mata Kuliah: {{ $mataKuliah->nama }}</h1>

    <h2>Mahasiswa:</h2>
    <ul>
        @foreach ($mahasiswas as $mahasiswa)
            <li>{{ $mahasiswa->nama }} ({{ $mahasiswa->nim }})</li>
            <ul>
                @foreach ($mahasiswa->nilais as $nilai)
                    <li>{{ $nilai->type }}: {{ $nilai->grade }}</li>
                @endforeach
            </ul>
        @endforeach
    </ul>
@endsection
