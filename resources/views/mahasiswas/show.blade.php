@extends('layout')
@include('headers')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Detail Mahasiswa: {{ $mahasiswa->nama }}</h1>
                <h3>NIM: {{ $mahasiswa->nim }}</h3>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <h2>Daftar Mata Kuliah:</h2>
                @if ($mataKuliahs->isEmpty())
                    <p>Mahasiswa ini belum terdaftar pada mata kuliah apapun.</p>
                @else
                    <ul class="list-group">
                        @foreach ($mataKuliahs as $daftarMataKuliah)
                            <li class="list-group-item">
                                <strong>Nama Mata Kuliah:</strong> {{ $daftarMataKuliah->matakuliah->nama_matakuliah }}<br>
                                <strong>AFL1:</strong> {{ $daftarMataKuliah->AFL1 }}<br>
                                <strong>AFL2:</strong> {{ $daftarMataKuliah->AFL2 }}<br>
                                <strong>AFL3:</strong> {{ $daftarMataKuliah->AFL3 }}<br>
                                <strong>ALP:</strong> {{ $daftarMataKuliah->ALP }}<br>
                                <strong>SKS:</strong> {{ $daftarMataKuliah->matakuliah->sks }}<br>
                                <strong>Ruangan <a href=""></a>:</strong> {{ $daftarMataKuliah->matakuliah->ruangan }}<br>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
@endsection

@if(session('error'))
    <script>
        window.onload = function() {
            alert("{{ session('error') }}");
        };
    </script>
@endif
