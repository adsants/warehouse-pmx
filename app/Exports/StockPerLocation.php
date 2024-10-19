<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

class StockPerLocation implements FromView
{

    
    protected $locationId;
    protected $locationName;

    function __construct( $locationId, $locationName) {
        $this->locationId = $locationId;
        $this->locationName = $locationName;
    }

    public function view(): View
    {
        $listRows = DB::table('sparepart_stocks')
        ->select('spareparts.id as sparepartId', 'spareparts.part_number', 'spareparts.name', 'spareparts.satuan', 'sparepart_stocks.stock', 'sparepart_stocks.id as stockId','sparepart_stocks.location_id')
        ->join('spareparts','spareparts.id','=','sparepart_stocks.sparepart_id')
        ->orderBy('spareparts.name','asc')
        ->where('sparepart_stocks.location_id','=', $this->locationId)
        ->get();

        return view('exports.stock', [
            'listRows'      =>   $listRows,
            'locationName'  =>   $this->locationName

        ]);
    }
}