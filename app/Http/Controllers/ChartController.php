<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Riwayat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    // public function chartRiwayat()
    // {
    //     $riwayatData = Pemesanan::select(
    //         DB::raw('DATE(created_at) as date'),
    //         DB::raw('count(*) as count')
    //     )->groupBy('date')->get();

    //     return response()->json($riwayatData);
    // }
    public function kamarFavorit()
    {
        $data = Pemesanan::select(DB::raw('kamar_id, COUNT(*) as total_bookings'))
            ->groupBy('kamar_id')
            ->with('kamar:id,nama') 
            ->get();
        
        return response()->json($data);
    }
    public function totalBooking(){
        $bookings = Pemesanan::select(
            DB::raw('DATE_TRUNC(\'month\', created_at) as month'),
            DB::raw('count(*) as count')
        )->groupBy(DB::raw('DATE_TRUNC(\'month\', created_at)'))->get();
    
        // Menyusun data dalam format yang sesuai untuk chart
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $bookingsData = array_fill(0, 12, 0);
    
        foreach ($bookings as $booking) {
            $monthIndex = (int) date('n', strtotime($booking->month));
            $bookingsData[$monthIndex - 1] = $booking->count;
        }
    
        // Mengembalikan data dalam format JSON
        return response()->json([
            'months' => $months,
            'bookingsData' => $bookingsData
        ]);
    }
}
