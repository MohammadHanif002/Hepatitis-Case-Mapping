<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    public function geojson()
    {
        // Ambil data dari PostgreSQL, konversi kolom geom menjadi GeoJSON
        $features = DB::table('jember')
            ->selectRaw("
                gid,
                kecamatan,
                jumlah_kasus,
                tahun,
                ST_AsGeoJSON(geom) AS geometry
            ")
            ->get();

        // Mengambil data spasial dari database PostgreSQL (dengan ST_AsGeoJSON).
        $geojson = [
            'type' => 'FeatureCollection',
            'features' => []
        ];

        foreach ($features as $feature) {
            $geojson['features'][] = [
                'type' => 'Feature',
                'geometry' => json_decode($feature->geometry),
                'properties' => [
                    'id' => $feature->gid,
                    'kecamatan' => strtoupper(trim($feature->kecamatan)),
                    'jumlah_kasus' => $feature->jumlah_kasus,
                    'tahun' => $feature->tahun,
                ]
            ];
        }
        
        // 3. Mengirimkan kembali sebagai respons JSON
        return response()->json($geojson, 200, [
            'Content-Type' => 'application/json'
        ], JSON_PRETTY_PRINT);
    }
}
