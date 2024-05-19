<!-- resources/views/dosens/show.blade.php -->

@extends('layout')

@section('content')
    <div class="container">
        <h1>Detail Dosen: {{ $dosen->nama_dosen }}</h1>
        <p>NIDN: {{ $dosen->nidn }}</p>

        <h2>Daftar Mata Kuliah:</h2>
        @if ($matakuliahs->isEmpty())
            <p>Tidak ada mata kuliah yang terkait dengan dosen ini.</p>
        @else
            <ul>
                @foreach ($matakuliahs as $matakuliah)
                    <li>{{ $matakuliah->nama_matakuliah }}</li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
