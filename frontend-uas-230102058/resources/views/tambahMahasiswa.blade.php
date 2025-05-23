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