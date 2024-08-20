<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    protected $table= "notif_booking";
    protected $fillable = ['nama', 'kamar', 'checkin', 'checkout','status'];
}
