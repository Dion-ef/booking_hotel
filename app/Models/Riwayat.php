<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;
    protected $table ="riwayat_pemesanan";
    protected $guarded=[];
    //protected $fillable = [
      //  'users_id','tanggal','status','harga',
    //];

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
