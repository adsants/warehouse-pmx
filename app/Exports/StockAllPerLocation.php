<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

class StockAllPerLocation implements FromView
{

    
    public function view(): View
    {
        $listRows = DB::table('sparepart_stocks')
        ->select('spareparts.id as sparepartId', 'spareparts.part_number', 'spareparts.name', 'spareparts.satuan', 'sparepart_stocks.stock', 'sparepart_stocks.id as stockId','sparepart_stocks.location_id','locations.name as locationName')
        ->join('spareparts','spareparts.id','=','sparepart_stocks.sparepart_id')
        ->join('locations','locations.id','=','sparepart_stocks.location_id')
        ->orderBy('spareparts.name','asc')
        ->orderBy('locations.name','asc')
        ->get();


        return view('exports.stock_all_per_location', [
            'listRows'      =>   $listRows

        ]);
    }
}