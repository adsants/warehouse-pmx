<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

class UnitSparepart implements FromView
{

    
    protected $unitId;

    function __construct( $unitId, ) {
        $this->unitId = $unitId;
    }

    public function view(): View
    {

        
        $dataUnit = DB::table('units')
        ->select('id','hull_number','type','merk','model')
        ->where('id','=',  $this->unitId)
        ->first();


        $listRows = DB::select("
        select 
            sparepart_outs.sparepart_id,
            sparepart_outs.to_location_id,
            sparepart_outs.entry_date,
            sparepart_outs.qty,
            spareparts.name as sparepartName,
            spareparts.part_number,
            sparepart_outs.working_hour,
            spareparts.satuan,
            sparepart_outs.description,
            sparepart_outs.kategori as kategoriPakai,
            'Out' as kategoriInOut
        from 
            sparepart_outs,
            spareparts
        where 
            sparepart_outs.sparepart_id = spareparts.id 
            and sparepart_outs.unit_id = '".$this->unitId."'  
        ");

        return view('exports.sparepart_unit', [
            'listRows'      =>   $listRows,
            'hull_number'      =>   $dataUnit->hull_number,
            'type'      =>   $dataUnit->type,
            'model'      =>   $dataUnit->model,
        ]);
    }
}