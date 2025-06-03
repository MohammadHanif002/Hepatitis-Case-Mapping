<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


Route::get('/api/cases', function () {
    $data = DB::select("
        SELECT id, lokasi, jumlah_kasus, waktu, ST_AsGeoJSON(geom) AS geometry 
        FROM hepatitis_cases
        WHERE geom IS NOT NULL
    ");

    $features = array_map(function ($row) {
        return [
            'type' => 'Feature',
            'geometry' => json_decode($row->geometry),
            'properties' => [
                'id' => $row->id,
                'lokasi' => $row->lokasi,
                'jumlah_kasus' => $row->jumlah_kasus,
                'waktu' => $row->waktu
            ]
        ];
    }, $data);

    return response()->json([
        'type' => 'FeatureCollection',
        'features' => $features
    ]);
});
