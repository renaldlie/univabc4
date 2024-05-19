@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Scores for {{ $mahasiswa->nama }}</h1>
        <form action="{{ route('dosens.updateMahasiswaScores', ['dosen' => $dosen, 'mahasiswa' => $mahasiswa]) }}" method="POST">
            @csrf
            @method('PUT')
            <!-- Add input fields for updating scores -->
            <!-- Example: AFL1 <input type="text" name="AFL1" value="{{ $mahasiswa->pivot->AFL1 }}"> -->
            <!-- Similar inputs for other scores -->

            <button type="submit" class="btn btn-primary">Save Scores</button>
        </form>
    </div>
@endsection
