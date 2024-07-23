<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking_ds extends Model
{
    use HasFactory;
    protected $fillable = [
        'idh',
        'nama_jasa',
        'hrg_jual',
        'nama_terapis',
        'nama',
        'qty'
    ];
}
