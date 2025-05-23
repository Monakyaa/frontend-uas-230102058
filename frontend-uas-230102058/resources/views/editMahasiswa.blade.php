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