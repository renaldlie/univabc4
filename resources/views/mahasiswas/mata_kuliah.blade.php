@extends('layouts.app')

@section('content')
    <h1>Mata Kuliah yang Diambil</h1>
    <ul>
        @foreach ($mataKuliah as $mk)
            <li>{{ $mk->nama_matakuliah }}</li>
        @endforeach
    </ul>
@endsection
