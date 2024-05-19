@extends('layouts.app')

@section('content')
    <h1>Change Grades for {{ $mahasiswa->nama }}</h1>

    <form action="{{ route('update.grades', ['mahasiswa' => $mahasiswa->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Add input fields for AFL1, AFL2, AFL3, ALP here -->

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
@endsection
