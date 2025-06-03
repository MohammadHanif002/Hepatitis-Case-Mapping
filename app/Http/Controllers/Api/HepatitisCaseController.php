<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HepatitisCaseController extends Controller
{
    public function index()
    {
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
    }
}
