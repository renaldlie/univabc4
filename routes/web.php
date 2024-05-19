<?php
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\CRUDDosenController;
use App\Http\Controllers\CRUDMahasiswaController;
use App\Http\Controllers\MataKuliahController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth', 'mahasiswa'])->group(function () {
    // Routes accessible only to authenticated mahasiswa users
    Route::get('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
    Route::get('/mahasiswa/{mahasiswa}/mata-kuliah', [MahasiswaController::class, 'mataKuliah']);
    Route::get('/mata-kuliah/create', [MataKuliahController::class, 'create'])->name('mata-kuliah.create');



});

Route::middleware(['auth', 'dosen'])->group(function () {
    Route::get('/dosens/{dosen}', [DosenController::class, 'index'])->name('dosens.index');
    Route::get('/change-grades/{mataKuliah}/{mahasiswa}', [DosenController::class, 'changeGrades'])->name('change.grades');
    Route::get('/dosens/create-matakuliah', [DosenController::class, 'createMatakuliah'])->name('dosens.createMatakuliah');
    Route::post('/mata-kuliah/store', [MataKuliahController::class, 'storeMatakuliah'])->name('mata-kuliah.store');

    Route::get('/mata-kuliah/createMatakuliah', [MataKuliahController::class, 'createMataKuliah'])->name('mata-kuliah.creatematakuliah');
    Route::post('/dosens/store-matakuliah', [DosenController::class, 'storeMatakuliah'])->name('dosens.storeMatakuliah');
});

Route::resource('dosens', CRUDDosenController::class);
Route::resource('mahasiswas', CRUDMahasiswaController::class);

// Use either default Laravel registration routes or custom registration routes, not both
// Option 1: Default Laravel registration routes
// Auth::routes();

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Route::get('/mahasiswa/{mahasiswa}/change-grades', [DosenController::class, 'changeGrades'])->name('change.grades');

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
