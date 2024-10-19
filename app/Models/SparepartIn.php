<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparepartIn extends Model
{
    use HasFactory;

    protected $fillable = [
        'sparepart_out_id',
        'sparepart_id',
        'location_id',
        'entry_date',
        'qty',
        'description'
    ];
}
