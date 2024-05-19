<!-- resources/views/dosens/create.blade.php -->

@extends('layout')
@include('navbar')
@section('content')
    <div class="container">
        <h1>Tambah Dosen Baru</h1>
        <form action="{{ route('dosens.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nidn">NIDN</label>
                <input type="text" class="form-control" id="nidn" name="nidn" required>
            </div>
            <div class="form-group">
                <label for="nama_dosen">Nama Dosen</label>
                <input type="text" class="form-control" id="nama_dosen" name="nama_dosen" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('dosens.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
