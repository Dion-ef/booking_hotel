<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = "payment";
    protected $fillable = ['pemesanan_id', 'checkout_link', 'external_id', 'status'];

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class);
    }
}
