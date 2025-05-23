<?php
use App\Http\Controllers\DataMahasiswaController;

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
});


Route::get('/', [DataMahasiswaController::class, 'index']); // Halaman utama
Route::get('/mahasiswa', [DataMahasiswaController::class, 'index']); // Ini penting!
Route::get('/mahasiswa/create', [DataMahasiswaController::class, 'create']);
Route::post('/mahasiswa', [DataMahasiswaController::class, 'store']);
Route::get('/mahasiswa/{id}/edit', [DataMahasiswaController::class, 'edit']);
Route::put('/mahasiswa/{id}', [DataMahasiswaController::class, 'update']);
Route::delete('/mahasiswa/{id}', [DataMahasiswaController::class, 'destroy']);
