<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'plat',
        'merk',
        'model',
        'tahun',
        'transmisi',
        'harga_per_hari',
        'gambar_path',
    ];

    
}
