<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah Data Kasus</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-6">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-xl font-bold mb-4">Tambah Data Kasus Hepatitis A</h1>
        <form action="{{ route('admin.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block mb-1">Kecamatan</label>
                <input type="text" name="kecamatan" class="w-full px-3 py-2 border rounded" required
                    value="{{ old('kecamatan') }}">
                @error('kecamatan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block mb-1">Jumlah Kasus</label>
                <input type="integer" name="jumlah_kasus" class="w-full px-3 py-2 border rounded" required
                    value="{{ old('jumlah_kasus') }}">
                @error('kecamatan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block mb-1">Tahun</label>
                <input type="date" name="tahun" class="w-full px-3 py-2 border rounded" required
                    value="{{ old('tahun') }}">
            </div>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Simpan</button>
            <a href="{{ route('admin.dashboard') }}" class="ml-2 text-gray-600 hover:text-black">Batal</a>
        </form>
    </div>
</body>

</html>
