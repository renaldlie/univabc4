@extends('layout')
@include('navbar')
@section('content')
    <h2>Edit Mahasiswa</h2>
    <a href="{{ route('mahasiswas.index') }}">KEMBALI</a>
    <form action="{{ route('mahasiswas.update', $mahasiswa->id_mahasiswa) }}" method="POST">
        @csrf
        @method('PUT')
        <table>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" value="{{ $mahasiswa->nama }}" required></td>
            </tr>
            <tr>
                <td>NIM</td>
                <td><input type="text" name="nim" value="{{ $mahasiswa->nim }}" required></td>
            </tr>
            <tr>
                <td>Angkatan</td>
                <td><input type="text" name="angkatan" value="{{ $mahasiswa->angkatan }}" required></td>
            </tr>
            <tr>
                <td>Total SKS</td>
                <td><input type="text" name="total_sks" value="{{ $mahasiswa->total_sks }}" required></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="UPDATE"></td>
            </tr>
        </table>
    </form>
@endsection
