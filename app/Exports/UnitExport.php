<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

class UnitExport implements FromView
{

    
    function __construct( ) {
    }

    public function view(): View
    {


        $listRows = DB::select("
        select 
           *
        from 
            units
        order by 
            hull_number 
        ");

        return view('exports.unit', [
            'listRows'      =>   $listRows,
        ]);
    }
}