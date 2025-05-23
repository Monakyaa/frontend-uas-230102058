## KONFIGURASI DI DATABASE
import database
```
https://github.com/WindyAnggitaPutri/SI_KRS_Database
```
## KONFIGURASI DI BACKEND
### 1. Clone Repository BE
```
https://github.com/kristiandimasadiwicaksono/SI-KRS-Backend.git
```


### 2. Install composer CI
```
composer install
```
### 3. Copy File Environment
```
cp .env.example .env
```

### 4. Menjalankan CI
```
php spark serve
```

### 5. Cek EndPoint menggunakan Postman
```
Kelas:
GET → http://localhost:8080/kelas / http://localhost:8080/kelas/{id}
POST → http://localhost:8080/kelas
PUT → http://localhost:8080/kelas/{id}
DELETE → http://localhost:8080/kelas/{id}

Matkul:
GET → http://localhost:8080/matkul / http://localhost:8080/matkul/{id}
POST → http://localhost:8080/matkul
PUT → http://localhost:8080/matkul/{id}
DELETE → http://localhost:8080/matkul/{id}

Prodi:
GET → http://localhost:8080/prodi / http://localhost:8080/prodi/{id}
POST → http://localhost:8080/prodi
PUT → http://localhost:8080/prodi/{id}
DELETE → http://localhost:8080/prodi/{id}


Mahasiswa:
GET → http://localhost:8080/mahasiswa / http://localhost:8080/mahasiswa/{id}
POST → http://localhost:8080/mahasiswa
PUT → http://localhost:8080/mahasiswa/{id}
DELETE → http://localhost:8080/mahasiswa/{id}

KRS:
GET → http://localhost:8080/krs / http://localhost:8080/krs/{id}
POST → http://localhost:8080/krs
PUT → http://localhost:8080/krs/{id}
DELETE → http://localhost:8080/krs/{id}
```



### Troubleshooting umum Postman & Laravel
| Masalah        | Penyebab                             | Solusi                                                                                            |
| -------------- | ------------------------------------ | ------------------------------------------------------------------------------------------------- |
| 404 Not Found  | Route belum terdaftar atau salah URL | Cek `routes/api.php`, pastikan ada `Route::apiResource('mahasiswa', MahasiswaController::class);` |
|                | Server Laravel belum dijalankan      | Jalankan dengan `php artisan serve`                                                               |
| Database Error | Konfigurasi `.env` salah             | Cek konfigurasi database di `.env`:                                                               |

DB_DATABASE=laravel_crud
DB_USERNAME=root
DB_PASSWORD=

### Jika migration belum dijalankan, jalankan:
```
php artisan migrate    
``` |
| **Vendor Not Found** | Paket Composer belum terinstall | Install package Composer dengan perintah:  
```bash
composer install
```








## MEMBUAT PROJECT BARU LARAVEL DENGAN LARAGON

Klik kanan Laragon → Quick App → Laravel → beri nama project

```
composer create-project laravel/laravel laravel-crud-app
cd laravel-crud-app
cp .env.example .env
php artisan key:generate
```

### EDIT .env
```
DB_DATABASE=laravel_crud
DB_USERNAME=root
DB_PASSWORD=
```

## PENGUBAHAN PADA LARAVEL
###BUAT CONTROLLER 
```
php artisan make:controller nama_fileController / php artisan make:model nama-file -mcr
```
### a. ROUTES (routes/web.php)
```
<?php
use App\Http\Controllers\DataMahasiswaController;
use App\Http\Controllers\DataJadwalSidangController;
use App\Http\Controllers\DataRuanganController;
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

#ini ruangan
Route::get('/ruangan', [DataRuanganController::class, 'index']);           // Tampil data ruangan
Route::get('/ruangan/create', [DataRuanganController::class, 'create']);  // Form tambah ruangan
Route::post('/ruangan', [DataRuanganController::class, 'store']);         // Simpan ruangan baru
Route::get('/ruangan/{kode_ruangan}/edit', [DataRuanganController::class, 'edit']);    // Form edit ruangan
Route::put('/ruangan/{kode_ruangan}', [DataRuanganController::class, 'update']);        // Update ruangan
Route::delete('/ruangan/{kode_ruangan}', [DataRuanganController::class, 'destroy']);    // Hapus ruangan

?>
```
### b. CONTROLLER (app/Http/Controllers/MahasiswaController.php)
```
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DataMahasiswaController extends Controller
{
    private $apiBase = "http://localhost:8080/mahasiswa";

    public function index() {
        $response = Http::get($this->apiBase);
        $json = $response->json();
        $mahasiswa = $json['data'] ?? []; // Ambil hanya data array
        return view('DataMahasiswa', compact('mahasiswa'));
    }

    public function create() {
        return view('tambahMahasiswa');
    }

    public function store(Request $request) {
        Http::post($this->apiBase, $request->all());
        return redirect('/'); // Ganti jika index route-nya lain
    }

    public function edit($id) {
    $response = Http::get("{$this->apiBase}/{$id}");
    $json = $response->json();
    $data = $json['data'] ?? null;
    return view('editMahasiswa', compact('data'));
}


    public function update(Request $request, $id) {
        Http::put("{$this->apiBase}/{$id}", $request->all());
        return redirect('/');
    }

    public function destroy($id) {
        Http::delete("{$this->apiBase}/{$id}");
        return redirect('/');
    }
}

```
### c. MODEL (app/Models/Mahasiswa.php)
```
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    //
}


```
### mahasiswa.blade.php
```
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script> 
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal"> 

<div class="flex"> 

    <!-- Sidebar -->
    <div class="w-64 bg-blue-800 min-h-screen text-white"> 
        <div class="p-6 font-bold text-xl border-b border-blue-600">
            KRS
        </div>
        <nav class="mt-4">
            <a href="/mahasiswa" class="block px-6 py-3 bg-blue-700">Daftar Mahasiswa</a> 
            
            
            
        </nav>
    </div>

    <!-- Main content -->
    <div class="flex-1 p-8"> 
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-semibold">Daftar Mahasiswa</h1> 
            <a href="/mahasiswa/create" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                + Tambah Mahasiswa 
            </a>
        </div>

        <div class="overflow-x-auto bg-white rounded shadow"> 
            <table class="min-w-full table-auto text-left"> 
                <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal"> 
                    <tr>
                        <th class="py-3 px-6">NPM</th>
                        <th class="py-3 px-6">Nama</th>
                        <th class="py-3 px-6">Kelas</th>
                        <th class="py-3 px-6">Prodi</th>
                        <th class="py-3 px-6">Aksi</th> 
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm">
                    @foreach($mahasiswa as $mhs) 
                    <tr class="border-b hover:bg-gray-100"> 
                        <td class="py-3 px-6">{{ $mhs['npm'] }}</td> 
                        <td class="py-3 px-6">{{ $mhs['nama_mahasiswa'] }}</td> 
                        <td class="py-3 px-6">{{ $mhs['nama_kelas'] }}</td> 
                        <td class="py-3 px-6">{{ $mhs['nama_prodi'] }}</td>
                        <td class="py-3 px-6 flex space-x-2"> 
                            <a href="/mahasiswa/{{ $mhs['npm'] }}/edit" class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">Edit</a>
                            

                            <form action="/mahasiswa/{{ $mhs['npm'] }}" method="POST" onsubmit="return confirm('Hapus data ini?');">
                                @csrf 
                                @method('DELETE') 
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Hapus</button>
                                
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>

```

### tambahMahasiswa.blade.php
```
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center text-gray-800">
            {{ isset($data) ? 'Edit Data Mahasiswa' : 'Tambah Data Mahasiswa' }}
        </h1>

        <form method="POST" action="{{ isset($data) ? url('/mahasiswa/' . $data['id']) : url('/mahasiswa') }}">
            @csrf
            @if(isset($data))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">NPM</label>
                <input type="text" name="npm" value="{{ $data['npm'] ?? '' }}" required
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Nama Mahasiswa</label>
                <input type="text" name="nama_mahasiswa" value="{{ $data['nama_mahasiswa'] ?? '' }}" required
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Kelas</label>
                <input type="text" name="nama_kelas" value="{{ $data['nama_kelas'] }}"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-1">Prodi</label>
                <input type="text" name="prodi" value="{{ $data['prodi'] ?? '' }}" required
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            

            <button type="submit"
                    class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-200">
                {{ isset($data) ? 'Update' : 'Simpan' }}
            </button>
        </form>
    </div>

</body>
</html>

```

### editMahasiswa.blade.php
```
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-lg">
        <h1 class="text-2xl font-bold mb-6 text-center text-gray-800">Edit Data Mahasiswa</h1>

        <form method="POST" action="{{ url('/mahasiswa/' . $data['npm']) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">NPM</label>
                <input type="text" name="npm" value="{{ $data['npm'] }}" readonly
                       class="w-full px-4 py-2 border bg-gray-100 rounded-lg text-gray-600">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Nama Mahasiswa</label>
                <input type="text" name="nama_mahasiswa" value="{{ $data['nama_mahasiswa'] }}"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Kelas</label>
                <input type="text" name="nama_kelas" value="{{ $data['nama_kelas'] }}"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Prodi</label>
                <input type="text" name="nama_prodi" value="{{ $data['nama_prodi'] }}"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit"
                    class="w-full bg-green-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-green-700 transition duration-200">
                Simpan Perubahan
            </button>
        </form>
    </div>

</body>
</html>

```

### Jalankan Di server
```
php artisan serve
```

### upload ke GitHub
```
git init
git add .
git commit -m "Initial commit"
git remote add origin https://github.com/username/laravel-crud-app.git
git branch -M main
git push -u origin main
```
