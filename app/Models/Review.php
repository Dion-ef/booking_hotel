<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    protected $fillable = [
        'kamar_id',
        'users_id',
        'review',
        'rating',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function kamar()
    {
        return $this->belongsTo('App\Models\Kamar');
    }
}
