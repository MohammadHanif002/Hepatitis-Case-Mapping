<?php

namespace App\Http\Controllers;

use App\Models\Kasus;
use Illuminate\Http\Request;
use App\Entities\KasusEntity;
use Illuminate\Support\Facades\DB;

class KasusController extends Controller
{
    public function index()
    {
        // Menampilkan seluruh data kasus dari database 
        $dataKasus = Kasus::all();

        // Mengirim data ke view dataKasus.blade.php
        return view('dataKasus', [
            'title' => 'Data Kasus Hepatitis A Jember',
            'dataKasus' => $dataKasus
        ]);
    }

    public function grafik()
    {
        // Ambil data jumlah kasus per kecamatan
        $data = Kasus::select('kecamatan')
            ->selectRaw('SUM(jumlah_kasus) as total_kasus')
            ->groupBy('kecamatan')
            ->orderBy('kecamatan')
            ->get();

        // Siapkan array label dan data untuk grafik
        $labels = $data->pluck('kecamatan');
        $values = $data->pluck('total_kasus');

        // Kirim ke view untuk ditampilkan dalam bentuk grafik 
        return view('grafikKasus', [
            'labels' => $labels,
            'values' => $values
        ]);
    }

    public function home()
    {
        $kasusRaw = Kasus::all();

        $dataKasus = [];

        foreach ($kasusRaw as $row) {
            $dataKasus[] = new KasusEntity(
                $row->kecamatan ?? 'Tidak diketahui',
                (int) ($row->jumlah_kasus ?? 0),
                (int) ($row->tahun ?? date('Y')) // default ke tahun sekarang kalau null
            );
        }

        // Hitung total kasus
        $totalKasus = array_reduce($dataKasus, fn($carry, $item) => $carry + $item->getJumlahKasus(), 0);

        // Jumlah kecamatan dengan kasus >= 5
        $jumlahKecamatan = count(array_unique(array_map(
            fn($item) => $item->getKecamatan(),
            array_filter($dataKasus, fn($item) => $item->getJumlahKasus() >= 5)
        )));

        // Zona klasifikasi
        $zonaMerah = count(array_filter($dataKasus, fn($k) => $k->getZona() === 'Merah'));
        $zonaKuning = count(array_filter($dataKasus, fn($k) => $k->getZona() === 'Kuning'));
        $zonaHijau = count(array_filter($dataKasus, fn($k) => $k->getZona() === 'Hijau'));

        // Kirim ke view home untuk ditampilkan berdasarkan klasifikasi 
        return view('home', compact(
            'totalKasus',
            'jumlahKecamatan',
            'zonaMerah',
            'zonaKuning',
            'zonaHijau'
        ));
    }

    public function searchKasus(Request $request)
    {
        // Mencari data berdasarkan nama kecamatan 
        $query = $request->input('q');

        // Akses tabel jember langsung dan cari kecamatan yang mengandung kata dari Input (Like %query%)
        $results = DB::table('wilayah')
            ->where('kecamatan', 'LIKE', '%' . $query . '%')
            ->get();

        // Kirm hasil pencraian ke view hasilSearch
        return view('hasilSearch', compact('results', 'query'));
    }

    public function exportCSV()
    {
        $kasus = Kasus::all();

        $filename = 'data_kasus_jember.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$filename",
        ];

        $callback = function () use ($kasus) {
            $file = fopen('php://output', 'w');
            // Baris header
            fputcsv($file, ['ID', 'Kecamatan', 'Jumlah Kasus', 'Tahun']);

            // Baris data
            foreach ($kasus as $row) {
                fputcsv($file, [
                    $row->gid,
                    $row->kecamatan,
                    $row->jumlah_kasus,
                    $row->tahun
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

}
