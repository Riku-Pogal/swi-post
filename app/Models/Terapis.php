<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terapis extends Model
{
    use HasFactory;

    protected $fillable = [
        'tkode',
        'nama_terapis',
        'alamat',
        'phone',
        'underwear',
    ];
}
