<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gambar extends Model
{
    use HasFactory;
    protected $table ="gambar";
    protected $guarded=[];
    protected $fillable = [
        'kategori_id',
        'gambar'
    ];
    public function kategori()
    {
        return $this->belongsTo('App\Models\Kategori');
    }
}
