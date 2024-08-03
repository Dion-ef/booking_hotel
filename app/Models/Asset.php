<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;
    protected $table ="asset";

    protected $fillable = [
        'nama_hotel','email','phone','alamat','deskripsi','headline','background_img','welcome_img'
    ];
}
