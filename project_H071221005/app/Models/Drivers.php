<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drivers extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nama',
        'gender',
        'no_telp',
        'pengalaman_kerja',
        'license_picture',
        'status',
    ];
}
