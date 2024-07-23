<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jasa extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'kode_jasa',
        'nama_jasa',
        'hrg_jual',
        'detail',
    ];
}
