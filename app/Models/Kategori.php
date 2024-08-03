<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Kategori extends Model
{
    use HasFactory;

    protected $table="kategori";
    protected $guarded=[];
    protected $fillable = [
        'nama',
        'harga',
        'deskripsi',
    ];

    public function kamars()
    {
        return $this->hasMany(Kamar::class);
    }
    public function gambar()
    {
        return $this->hasMany(Gambar::class);
    }
    public function fasilitas()
    {
        return $this->belongsToMany(Fasilitas::class, 'fasilitas_kamar');
    }

}
