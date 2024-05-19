@extends('layout')
@include('navbar')
<form action="{{ route('dosens.storeMatakuliah') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="nama_matakuliah">Nama Mata Kuliah</label>
        <input type="text" class="form-control" id="nama_matakuliah" name="nama_matakuliah" required>
    </div>
    <div class="form-group">
        <label for="hari">Hari</label>
        <input type="text" class="form-control" id="hari" name="hari" required>
    </div>
    <div class="form-group">
        <label for="start_time">Jam Mulai</label>
        <input type="time" class="form-control" id="start_time" name="start_time" required>
    </div>
    <div class="form-group">
        <label for="end_time">Jam Selesai</label>
        <input type="time" class="form-control" id="end_time" name="end_time" required>
    </div>
    <div class="form-group">
        <label for="sks">SKS</label>
        <input type="number" class="form-control" id="sks" name="sks" required>
    </div>
    <div class="form-group">
        <label for="ruangan">Ruangan</label>
        <input type="text" class="form-control" id="ruangan" name="ruangan" required>
    </div>
    <button type="submit" class="btn btn-primary">Tambah Mata Kuliah</button>
</form>
