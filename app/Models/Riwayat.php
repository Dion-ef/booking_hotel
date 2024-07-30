<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;
    protected $table ="riwayat_pemesanan";
    protected $guarded=[];
    protected $fillable = [
        'nama_kamar', 'kode', 'jenis_kamar', 'tanggal_pemesanan', 'tanggal_checkin', 'tanggal_checkout', 
        'nama', 'email', 'phone', 'jumlah_orang', 'status', 'total', 'created_at', 'updated_at',
    ];

    public function kamar()
    {
        return $this->belongsTo('App\Models\Kamar');
    }
    public function kategori()
    {
        return $this->belongsTo('App\Models\Kategori');
    }
    public function pemesanan()
    {
        return $this->belongsTo('App\Models\Pemesanan');
    }
}
