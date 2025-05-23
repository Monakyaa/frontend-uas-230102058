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