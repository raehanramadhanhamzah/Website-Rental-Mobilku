<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nama',
        'username',
        'email',
        'no_telp',
        'durasi_rental',
        'ktp_user',
        'sim_user',
        'id_mobil',
        'id_driver',
    ];
}
