<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;
    protected $table ="pemesanan";
    protected $guarded=[];
    //protected $fillable = [
      //  'users_id','tanggal','status','harga',
    //];

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
