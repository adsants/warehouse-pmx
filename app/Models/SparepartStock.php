<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparepartStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'sparepart_id',
        'location_id',
        'stock'
    ];
}
