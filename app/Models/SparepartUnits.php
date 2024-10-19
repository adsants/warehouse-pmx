<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparepartUnits extends Model
{
    use HasFactory;

    protected $fillable = [
        'sparepart_id',
        'merk',
        'type',
        'model'
    ];
}
