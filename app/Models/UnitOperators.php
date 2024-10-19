<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitOperators extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_id',
        'operator_name'
    ];
}
