<?php

namespace App\Listeners;

use App\Events\NotifikasiBooking;
use App\Models\Notifikasi;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class HandleNotifikasiBooking
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\NotifikasiBooking  $event
     * @return void
     */
    public function handle(NotifikasiBooking $event)
    {
        // $cacheKey = "notification_{$event->bookingData['nama']}_{$event->bookingData['kamar']}_{$event->bookingData['checkin']}_{$event->bookingData['checkout']}";

        // if (!Cache::has($cacheKey)) {
        //     Notifikasi::create([
        //         'nama' => $event->bookingData['nama'],
        //         'kamar' => $event->bookingData['kamar'],
        //         'checkin' => $event->bookingData['checkin'],
        //         'checkout' => $event->bookingData['checkout'],
        //     ]);
    
        //     Cache::put($cacheKey, true, 3600); // Simpan dalam cache selama 1 jam
        // }
    
        // broadcast(new NotifikasiBooking($event->bookingData));
    }
}
