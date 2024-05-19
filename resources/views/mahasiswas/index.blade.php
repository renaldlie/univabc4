@extends('layout')
@include('navbar')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>CRUD DATA MAHASISWA</h2>
        <a class="btn btn-primary" href="{{ route('mahasiswas.create') }}">+ TAMBAH MAHASISWA</a>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>NO</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Angkatan</th>
                <th>SKS</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswas as $index => $mahasiswa)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $mahasiswa->nama }}</td>
                    <td>{{ $mahasiswa->nim }}</td>
                    <td>{{ $mahasiswa->angkatan }}</td>
                    <td>{{ $mahasiswa->total_sks }}</td>
                    <td>
                        <a href="{{ route('mahasiswas.show', $mahasiswa->id_mahasiswa) }}" class="btn btn-warning btn-sm">Detail</a>
                        <a class="btn btn-warning btn-sm" href="{{ route('mahasiswas.edit', $mahasiswa->id_mahasiswa) }}">EDIT</a>
                        <form action="{{ route('mahasiswas.destroy', $mahasiswa->id_mahasiswa) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">HAPUS</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

