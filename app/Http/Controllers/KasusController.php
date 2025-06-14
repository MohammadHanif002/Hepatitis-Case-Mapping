<?php

namespace App\Http\Controllers;

use App\Models\Kasus;
use Illuminate\Http\Request;
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
        $data = \App\Models\Kasus::select('kecamatan')
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
        // Ambil semua data dari tabel Kasus
        $dataKasus = Kasus::all();

        // Hitung total kasus
        $totalKasus = $dataKasus->sum('jumlah_kasus');

        // Kecamatan yang masuk zona kuning/merah (>=5 kasus)
        $jumlahKecamatan = $dataKasus
            ->where('jumlah_kasus', '>=', 5)
            ->groupBy('kecamatan')
            ->count();

        // Hitung jumlah zona
        $zonaMerah = $dataKasus->where('jumlah_kasus', '>=', 10)->count();
        $zonaKuning = $dataKasus->whereBetween('jumlah_kasus', [5, 9])->count();
        $zonaHijau = $dataKasus->where('jumlah_kasus', '<', 5)->count();

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
        $results = DB::table('jember')
            ->where('kecamatan', 'LIKE', '%' . $query . '%')
            ->get();

        // Kirm hasil pencraian ke view hasilSearch
        return view('hasilSearch', compact('results', 'query'));
    }

    public function exportCSV()
    {
        $kasus = \App\Models\Kasus::all();

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
