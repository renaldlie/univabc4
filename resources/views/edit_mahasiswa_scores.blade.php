@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('dosens.index') }}" class="btn btn-primary mb-4">Home</a>

    <h1 class="mb-4">Edit Scores for {{ $mahasiswa->nama }}</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('updateMahasiswaScores', ['mahasiswa' => $mahasiswa->id_mahasiswa, 'id_daftarmatakuliah' => $mataKuliahs->id_matakuliah]) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="AFL1">AFL1</label>
            <input type="number" class="form-control" id="AFL1" name="AFL1" value="{{ $mahasiswa->AFL1 }}" required>
        </div>
        <div class="form-group">
            <label for="AFL2">AFL2</label>
            <input type="number" class="form-control" id="AFL2" name="AFL2" value="{{ old('AFL2', optional($mahasiswa->pivot)->AFL2) }}" required>
        </div>
        <div class="form-group">
            <label for="AFL3">AFL3</label>
            <input type="number" class="form-control" id="AFL3" name="AFL3" value="{{ old('AFL3', optional($mahasiswa->pivot)->AFL3) }}" required>
        </div>
        <div class="form-group">
            <label for="ALP">ALP</label>
            <input type="number" class="form-control" id="ALP" name="ALP" value="{{ old('ALP', optional($mahasiswa->pivot)->ALP) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Scores</button>
    </form>
</div>
@endsection
