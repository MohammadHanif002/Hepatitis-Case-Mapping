<x-layout :title="'Hasil Pencarian Kasus Hepatitis A'">
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Hasil Pencarian</h2>

        @if ($results->isEmpty())
            <p class="text-gray-600">Tidak ada hasil yang ditemukan untuk pencarian Anda.</p>
        @else
            <table class="min-w-full table-auto border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-2 text-left">No</th>
                        <th class="border px-4 py-2 text-left">Kecamatan</th>
                        <th class="border px-4 py-2 text-left">Jumlah Kasus</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $index => $item)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2">{{ $index + 1 }}</td>
                            <td class="border px-4 py-2">{{ $item->kecamatan }}</td>
                            <td class="border px-4 py-2">{{ $item->jumlah_kasus }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-layout>
