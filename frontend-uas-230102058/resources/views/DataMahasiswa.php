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
