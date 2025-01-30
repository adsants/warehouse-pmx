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
        'bukti_kepemilikan',
        'surat_ijin',
        'keterangan',
        'location_name'
    ];
}
