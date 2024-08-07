<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesanUser extends Model
{
    use HasFactory;

    protected $table = 'kontak';
    protected $fillable = [
        'nama','phone','email','pesan'
    ];
}
