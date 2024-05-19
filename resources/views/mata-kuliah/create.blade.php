@extends('layouts.app')

@section('content')
<a href="{{ route('mahasiswa.index', ['mahasiswa' => $mahasiswa]) }}" class="btn btn-primary">Back to Home</a>


    <h1>Add Mata Kuliah</h1>

    <form action="{{ route('mata-kuliah.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="matakuliah">Select Mata Kuliah:</label>
            <select name="matakuliah" id="matakuliah" class="form-control">
                @foreach ($matakuliahs as $matakuliah)
                    <option value="{{ $matakuliah->id_matakuliah }}">{{ $matakuliah->nama_matakuliah }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
@endsection


