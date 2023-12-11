<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;
    

    protected $fillable = [
    'id',
    'nama',
    'email',
    'amount',
    'status payment',
    'payment_date',
    ];
}
