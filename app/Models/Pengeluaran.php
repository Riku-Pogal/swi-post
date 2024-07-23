<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;
    
    
    protected $fillable = [
        'tgl_1',
        'nama_pemilik',
        'nama_toko',
        'harga',
    ];
}
