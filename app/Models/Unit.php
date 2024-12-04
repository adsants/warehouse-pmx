<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'hull_number',
        'type',
        'model',
        'merk',
        'sn',
        'engine_sn',
        'year_build',
        'buying_date',
        'operator_name',
        'keterangan',
        'location_name'
    ];
}
