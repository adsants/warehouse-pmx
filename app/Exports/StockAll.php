<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

class StockAll implements FromView
{
    public function view(): View
    {
       $listRows = DB::select("
       select 
            distinct(sparepart_stocks.sparepart_id), 
            spareparts.part_number, spareparts.name, spareparts.satuan,  
            ( select COALESCE(sum(SS.stock),0) from sparepart_stocks SS where SS.sparepart_id = spareparts.id) as stok

       from 
            sparepart_stocks,
            spareparts
        where 
            sparepart_stocks.sparepart_id = spareparts.id 

       ");
        return view('exports.stock_all', [
            'listRows'      =>   $listRows
        ]);
    }
}