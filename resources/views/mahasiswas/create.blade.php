@extends('layout')
@include('navbar')
@section('content')
    <h2>Tambah Mahasiswa</h2>
    <a href="{{ route('mahasiswas.index') }}">KEMBALI</a>
    <form action="{{ route('mahasiswas.store') }}" method="POST">
        @csrf
        <table>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" required></td>
            </tr>
            <tr>
                <td>NIM</td>
                <td><input type="text" name="nim" required></td>
            </tr>
            <tr>
                <td>Angkatan</td>
                <td><input type="text" name="angkatan" required></td>
            </tr>
            <tr>
                <td>Total SKS</td>
                <td><input type="text" name="total_sks" required></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="SIMPAN"></td>
            </tr>
        </table>
    </form>
@endsection
