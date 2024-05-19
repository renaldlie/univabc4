@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('home') }}" class="btn btn-primary mb-4">Home</a>
    <a href="{{ route('mata-kuliah.create') }}" class="btn btn-success mb-4">Tambah Mata Kuliah</a>
    <h1 class="mb-4">Mata Kuliah yang Diajarkan oleh Dosen</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($mataKuliahs->isEmpty())
        <div class="alert alert-info">Tidak ada Mata Kuliah yang ditemukan.</div>
    @else
        <div class="row">
            @foreach ($mataKuliahs as $mataKuliah)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            {{ $mataKuliah->nama_matakuliah }}
                        </div>
                        <div class="card-body">
                            <p class="card-text"><strong>Hari:</strong> {{ $mataKuliah->hari }}</p>
                            <p class="card-text"><strong>Waktu:</strong> {{ $mataKuliah->start_time }} - {{ $mataKuliah->end_time }}</p>
                            <p class="card-text"><strong>Ruangan:</strong> {{ $mataKuliah->ruangan }}</p>
                            <p class="card-text"><strong>SKS:</strong> {{ $mataKuliah->sks }}</p>
                            <h5 class="card-title">Mahasiswa yang Terdaftar</h5>
                            <ul class="list-group">
                                @forelse ($mahasiswasByMataKuliah[$mataKuliah->id_matakuliah] as $mahasiswa)
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                {{-- <a href="{{ route('change.grades', ['mahasiswa' => $mahasiswa->id]) }}">{{ $mahasiswa->nama }}</a> --}}
                                                <span class="badge badge-secondary ml-2">NIM: {{ $mahasiswa->nim }}</span>
                                            </div>
                                            <div>
                                                <span class=" badge-info">AFL1: {{ $mahasiswa->pivot->AFL1 }}</span>
                                                <span class=" badge-info">AFL2: {{ $mahasiswa->pivot->AFL2 }}</span>
                                                <span class=" badge-info">AFL3: {{ $mahasiswa->pivot->AFL3 }}</span>
                                                <span class=" badge-info">ALP: {{ $mahasiswa->pivot->ALP }}</span>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <li class="list-group-item">Tidak ada Mahasiswa yang terdaftar.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
