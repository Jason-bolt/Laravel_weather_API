<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country',
        'city',
        'temperature',
        'humidity',
        'wind_speed'
    ];
}
