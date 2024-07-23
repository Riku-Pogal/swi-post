<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_doc',
        'tgl_doc',
        'nama_terapis',
        'nama',
        'grandtot',
    ];
}
