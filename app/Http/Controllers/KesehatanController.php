<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KesehatanController extends Controller
{
    public function lokasiFaskes()
    {
        $faskes = DB::table('data_rs_jember')
            ->select(DB::raw('"nama rs" as nama_rs'), DB::raw('ST_Y(geom) as latitude'), DB::raw('ST_X(geom) as longitude'))
            ->get();

        return response()->json($faskes);
    }
}
