<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparepartOut extends Model
{
    use HasFactory;

    protected $fillable = [
        'sparepart_id',
        'from_location_id',
        'unit_id',
        'to_location_id',
        'entry_date',
        'qty',
        'description',
        'working_hour',
        'kategori',
        'received_at',
        'received_by'
    ];
}
