<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Title Here</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

@include('headers')

<div class="container mt-5">
    <form action="{{ route('dosens.storeMatakuliah') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_matakuliah">Nama Mata Kuliah:</label>
            <input type="text" class="form-control" id="nama_matakuliah" name="nama_matakuliah" required>
        </div>
        <div class="form-group">
            <label for="hari">Hari:</label>
            <input type="text" class="form-control" id="hari" name="hari" required>
        </div>
        <div class="form-group">
            <label for="start_time">Waktu Mulai:</label>
            <input type="time" class="form-control" id="start_time" name="start_time" required>
        </div>
        <div class="form-group">
            <label for="end_time">Waktu Berakhir:</label>
            <input type="time" class="form-control" id="end_time" name="end_time" required>
        </div>
        <div class="form-group">
            <label for="sks">SKS:</label>
            <input type="number" class="form-control" id="sks" name="sks" required>
        </div>
        <div class="form-group">
            <label for="ruangan">Ruangan:</label>
            <input type="text" class="form-control" id="ruangan" name="ruangan" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<!-- Include Bootstrap JS (Optional) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
