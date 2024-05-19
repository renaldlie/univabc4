<!-- resources/views/dosens/edit.blade.php -->

@extends('layout')
@include('navbar')
@section('content')
    <div class="container">
        <h1>Edit Dosen</h1>
        <form action="{{ route('dosens.update', $dosen->id_dosen) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nidn">NIDN</label>
                <input type="text" class="form-control" id="nidn" name="nidn" value="{{ $dosen->nidn }}" required>
            </div>
            <div class="form-group">
                <label for="nama_dosen">Nama Dosen</label>
                <input type="text" class="form-control" id="nama_dosen" name="nama_dosen" value="{{ $dosen->nama_dosen }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('dosens.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
