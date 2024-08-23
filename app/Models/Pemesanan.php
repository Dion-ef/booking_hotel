<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pemesanan extends Model
{
    use HasFactory;
    protected $table = "pemesanan";
    protected $guarded = [];
    protected $fillable = [
        'nama', 'email', 'phone', 'jumlah_orang', 'in', 'out', 'tgl_pemesanan', 'harga', 'total', 'kamar_id', 'status',
    ];

    public function kamar()
    {
        return $this->belongsTo('App\Models\Kamar');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function kategori()
    {
        return $this->belongsTo('App\Models\Kategori');
    }
    public function payment()
    {
        return $this->belongsTo('App\Models\Payment');
    }
    // public static function generateKodePemesanan()
    // {
    //     // Merge tabel pemesanan dan tabel riwayat kemudian diambil kodenya untuk diambil numeriknya
    //     $kodeAkhir = DB::table('pemesanan')
    //         ->select('kode')
    //         ->union(DB::table('riwayat_pemesanan')->select('kode'))
    //         ->orderBy('kode', 'desc')
    //         ->first();

        
    //     $nomorAkhir = 0;
    //     if ($kodeAkhir && !empty($kodeAkhir->kode)) {
    //         $nomorAkhir = (int) substr($kodeAkhir->kode, 3); // Mengambil hanya numerik dari kode
    //     }

    //     // Generate kode baru
    //     $nomorBaru = $nomorAkhir + 1;
    //     $kodePesanan = 'BKG' . str_pad($nomorBaru, 4, '0', STR_PAD_LEFT);

    //     return $kodePesanan;
    // }

    public static function generateKodePemesanan()
    {
        $latestPemesanan = self::latest('id')->first();
        $kode = 'BKG' . str_pad(optional($latestPemesanan)->id + 1, 4, '0', STR_PAD_LEFT);
        return $kode;
    }
}
