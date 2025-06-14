<x-layout>
    <x-slot:title>Tabel Sebaran Kasus Hepatitis A</x-slot>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded shadow">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="px-4 py-2 border">ID</th>
                    <th class="px-4 py-2 border">Kecamatan</th>
                    <th class="px-4 py-2 border">Jumlah Kasus</th>
                    <th class="px-4 py-2 border">Tahun</th>
                    <th class="px-4 py-2 border">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataKasus as $row)
                    <tr class="text-sm border-t hover:bg-gray-100">
                        <td class="px-4 py-2 border">{{ $row->gid }}</td>
                        <td class="px-4 py-2 border">{{ $row->kecamatan }}</td>
                        <td class="px-4 py-2 border">{{ $row->jumlah_kasus }}</td>
                        <td class="px-4 py-2 border">{{ $row->tahun }}</td>
                        <td class="px-4 py-2 border">
                            @php
                                if ($row->jumlah_kasus >= 10) {
                                    $status = 'Zona Merah';
                                    $color = 'bg-red-500';
                                } elseif ($row->jumlah_kasus >= 5) {
                                    $status = 'Zona Kuning';
                                    $color = 'bg-yellow-400 text-black';
                                } else {
                                    $status = 'Zona Hijau';
                                    $color = 'bg-green-500';
                                }
                            @endphp
                            <span class="text-white px-2 py-1 rounded text-xs {{ $color }}">
                                {{ $status }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br>
    <div class=" flex justify-end mb-4">
        <a href="{{ route('kasus.export') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Download Data (CSV)
        </a>
    </div>
</x-layout>
