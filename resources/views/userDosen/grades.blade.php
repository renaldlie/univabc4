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
    <form>
        @csrf
        <div class="form-group">
            <label for="nama_matakuliah">Nama Mahasiswa :</label>
            <input type="text" class="form-control" id="AFL!" name="nama_matakuliah" required>
        </div>
        <div class="form-group">
            <label for="nama_matakuliah">AFL1:</label>
            <input type="text" class="form-control" id="AFL!" name="nama_matakuliah" required>
        </div>
        <div class="form-group">
            <label for="nama_matakuliah">AFL2:</label>
            <input type="text" class="form-control" id="AFL!" name="nama_matakuliah" required>
        </div>
        <div class="form-group">
            <label for="nama_matakuliah">AFL3:</label>
            <input type="text" class="form-control" id="AFL!" name="nama_matakuliah" required>
        </div>
        <div class="form-group">
            <label for="nama_matakuliah">ALP:</label>
            <input type="text" class="form-control" id="AFL!" name="nama_matakuliah" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<!-- Include Bootstrap JS (Optional) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
