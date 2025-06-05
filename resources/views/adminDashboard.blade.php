<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-6">
    <!-- Navbar / Header -->
    <div class="flex justify-between items-center max-w-6xl mx-auto mb-4">
        <h1 class="text-2xl font-bold">Dashboard Admin - Data Kasus Hepatitis A di Jember</h1>

        <!-- Logout Button -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                Logout
            </button>
        </form>
    </div>

    <div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md">

        <!-- Tabel Data -->
        <table class="min-w-full table-auto border border-gray-300">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="px-4 py-2 border">ID</th>
                    <th class="px-4 py-2 border">Kecamatan</th>
                    <th class="px-4 py-2 border">Jumlah Kasus</th>
                    <th class="px-4 py-2 border">Tahun</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                    <tr class="border-t">
                        <td class="px-4 py-2 border">{{ $row->gid }}</td>
                        <td class="px-4 py-2 border">{{ $row->kecamatan }}</td>
                        <td class="px-4 py-2 border">{{ $row->jumlah_kasus }}</td>
                        <td class="px-4 py-2 border">{{ $row->tahun }}</td>
                        <td class="px-4 py-2 border space-x-2">
                            <!-- Edit -->
                            <a href="{{ route('admin.edit', $row->gid) }}"
                                class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Edit</a>

                            <!-- Delete -->
                            <form action="{{ route('admin.delete', $row->gid) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin ingin menghapus data ini?')"
                                    class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Tombol Tambah -->
        <div class="mt-6">
            <a href="{{ route('admin.create') }}"
                class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Tambah Data</a>
        </div>
    </div>
</body>

</html>
