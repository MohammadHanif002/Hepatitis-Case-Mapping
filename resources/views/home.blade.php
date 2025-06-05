<x-layout>
    <x-slot:title>Dashboard Hepatitis A - Kabupaten Jember</x-slot>
    <x-slot name="slot_full_width">
        {{-- HERO SECTION --}}
        <section class="text-white py-32 hero-overlay"
            style="background-image: url('{{ asset('img/hepatitis2.jpg') }}'); background-size: cover; background-position: center; background-attachment: fixed;">

            <div class="max-w-4xl mx-auto text-center px-4">
                <h1 class="text-5xl font-bold leading-tight mb-4">Sebaran Kasus Hepatitis A di Kabupaten Jember</h1>
                <p class="text-lg mb-6">Sistem Informasi Geospasial interaktif untuk memantau dan memahami penyebaran
                    Hepatitis A sepanjang tahun 2023.</p>
                <a href="/petaSebaran"
                    class="bg-indigo-600 hover:bg-indigo-700 px-6 py-3 rounded-full text-white font-semibold transition">Lihat
                    Peta Interaktif</a>
            </div>
        </section>

        {{-- INFO SINGKAT --}}
        <section class="bg-white py-16">
            <div class="max-w-6xl mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                    <div class="shadow rounded-lg p-6 bg-gray-50">
                        <h3 class="text-3xl font-bold text-red-600">{{ $totalKasus }}</h3>
                        <p class="text-gray-700 mt-2">Kasus Terkonfirmasi</p>

                    </div>
                    <div class="shadow rounded-lg p-6 bg-gray-50">
                        <h3 class="text-3xl font-bold text-yellow-600">{{ $jumlahKecamatan }}</h3>
                        <p class="text-gray-700 mt-2">Kecamatan Terdampak</p>
                    </div>
                    <div class="shadow rounded-lg p-6 bg-gray-50">
                        <h3 class="text-3xl font-bold text-green-600">2019 - 2025</h3>
                        <p class="text-gray-700 mt-2">Tahun Kejadian</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- PENJELASAN --}}
        <section class="bg-gray-100 py-16">
            <div class="max-w-4xl mx-auto px-4 text-center">
                <h2 class="text-2xl font-bold text-indigo-700 mb-4">Apa yang Terjadi?</h2>
                <p class="text-gray-700 leading-relaxed">
                    Pada akhir 2019, Kabupaten Jember mengalami lonjakan kasus Hepatitis A yang cukup signifikan,
                    khususnya
                    di Kecamatan Patrang, Kaliwates, dan Sumbersari.
                    Mayoritas kasus ditemukan pada pelajar dan mahasiswa, yang diduga akibat sanitasi makanan dan
                    minuman
                    yang kurang baik. Pemerintah telah melakukan
                    berbagai langkah seperti penyuluhan kesehatan dan pemeriksaan massal.
                </p>
            </div>
        </section>

        {{-- NAVIGASI FITUR --}}
        <section class="bg-white py-16">
            <div class="max-w-6xl mx-auto px-4">
                <h2 class="text-2xl font-bold text-center text-indigo-700 mb-10">📌 Fitur Sistem</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <a href="/dataKasus" class="bg-white border hover:shadow-xl rounded-xl p-6 transition">
                        <h3 class="text-xl font-semibold text-indigo-800 mb-2">📋 Data Kasus</h3>
                        <p class="text-gray-600 text-sm">Tabel detail kasus berdasarkan kecamatan & kelompok usia.</p>
                    </a>
                    <a href="/grafikKasus" class="bg-white border hover:shadow-xl rounded-xl p-6 transition">
                        <h3 class="text-xl font-semibold text-indigo-800 mb-2">📊 Grafik Statistik</h3>
                        <p class="text-gray-600 text-sm">Visualisasi jumlah kasus per wilayah dan tren waktu.</p>
                    </a>
                    <a href="/petaSebaran" class="bg-white border hover:shadow-xl rounded-xl p-6 transition">
                        <h3 class="text-xl font-semibold text-indigo-800 mb-2">🗺️ Peta Sebaran</h3>
                        <p class="text-gray-600 text-sm">Distribusi spasial kasus Hepatitis A di Jember.</p>
                    </a>
                </div>
            </div>
        </section>

        {{-- RINGKASAN ZONA --}}
        <section class="bg-gray-50 py-16">
            <div class="max-w-4xl mx-auto px-4">
                <h2 class="text-xl font-bold text-indigo-800 text-center mb-6">📈 Ringkasan Zona Risiko</h2>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-center">
                    <div class="bg-white shadow rounded-lg p-6">
                        <div class="text-3xl font-bold text-red-600">{{ $zonaMerah }}</div>
                        <p class="text-gray-600 mt-2">Zona Merah</p>
                    </div>
                    <div class="bg-white shadow rounded-lg p-6">
                        <div class="text-3xl font-bold text-yellow-500">{{ $zonaKuning }}</div>
                        <p class="text-gray-600 mt-2">Zona Kuning</p>
                    </div>
                    <div class="bg-white shadow rounded-lg p-6">
                        <div class="text-3xl font-bold text-green-600">{{ $zonaHijau }}</div>
                        <p class="text-gray-600 mt-2">Zona Hijau</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- FOOTER --}}
        <footer class="bg-indigo-800 text-white text-center py-6">
            <p class="text-sm">&copy; {{ date('Y') }} Sistem Informasi Hepatitis A - Kabupaten Jember | Universitas
                Jember
            </p>
        </footer>
    </x-slot>
</x-layout>
