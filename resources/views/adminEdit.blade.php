<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Data Kasus</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-6">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-xl font-bold mb-4">Edit Data Kasus Hepatitis A</h1>
        <form action="{{ route('admin.update', $row->gid) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block mb-1">Kecamatan</label>
                <input type="varchar" name="kecamatan" value="{{ $row->kecamatan }}"
                    class="w-full px-3 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label class="block mb-1">Jumlah Kasus</label>
                <input type="integer" name="jumlah_kasus" value="{{ $row->jumlah_kasus }}"
                    class="w-full px-3 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label class="block mb-1">Tahun</label>
                <input type="date" name="tahun" value="{{ $row->tahun }}" class="w-full px-3 py-2 border rounded"
                    required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
            <a href="{{ route('admin.dashboard') }}" class="ml-2 text-gray-600 hover:text-black">Batal</a>
        </form>
    </div>
</body>

</html>
