<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;
    protected $table ="pemesanan";
    protected $guarded=[];
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
    public static function generateKodePemesanan()
    {
        $latestPemesanan = self::latest('id')->first();
        $kode = 'BKG' . str_pad(optional($latestPemesanan)->id + 1, 4, '0', STR_PAD_LEFT);
        return $kode;
    }
}
