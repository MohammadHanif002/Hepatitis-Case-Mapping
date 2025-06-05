<?php

namespace App\Http\Controllers;

use App\Models\Kasus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KasusController extends Controller
{
    public function index()
    {
        $dataKasus = Kasus::all();

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

        return view('grafikKasus', [
            'labels' => $labels,
            'values' => $values
        ]);
    }

    public function home()
    {
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
        $query = $request->input('q');

        $results = DB::table('jember')
            ->where('kecamatan', 'LIKE', '%' . $query . '%')
            ->get();

        return view('hasilSearch', compact('results', 'query'));
    }



}
