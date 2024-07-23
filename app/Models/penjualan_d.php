<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan_d extends Model
{
    use HasFactory;

    protected $fillable = [
        'idh',
        'nama_jasa',
        'quantity',
        'hrg_jual',
        'total',

    ];
}
