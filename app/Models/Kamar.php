<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Kamar extends Model
{
    use HasFactory;
    protected $table = "kamar";
    protected $guarded =[];
    protected $fillable = [
        'kategori_id',
        'nama',
        'status',
        'fasilitas',
        'kapasitas',
    ];

    public function kategori()
    {
        return $this->belongsTo('App\Models\Kategori');
    }

}
