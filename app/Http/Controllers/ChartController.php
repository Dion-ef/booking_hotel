<?php

namespace App\Http\Controllers;

use App\Models\Riwayat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function chartRiwayat()
    {
        $riwayatData = Riwayat::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('count(*) as count')
        )->groupBy('date')->get();

        return response()->json($riwayatData);
    }
    public function chartUserAktive()
{
    $userActivities = User::select(
        DB::raw('DATE(created_at) as date'),
        DB::raw('count(*) as count')
    )->groupBy('date')->get();

    return response()->json($userActivities);
}
}
