<?php

// use DB_global;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\SparepartStock;


class HelperGlobal
{
    public static function updateQtySparepartIn($sparepartId = null, $locationId = null, $qty = null, $userId = null)
    {
        $dataSparepartStock = SparepartStock::select('id')
        ->where('sparepart_id','=', $sparepartId)
        ->where('location_id','=', $locationId)
        ->get();

        if(count($dataSparepartStock)){
            DB::select("update sparepart_stocks set stock = (stock + $qty ) where sparepart_id = ? and location_id = ? ", [$sparepartId,$locationId]);
        }
        else{

            $dataInsert = [
                'sparepart_id'  => $sparepartId,
                'location_id'   => $locationId ,
                'stock'         => $qty
            ];
            SparepartStock::create($dataInsert);
        }
        
    }
    public static function updateQtySparepartOut($sparepartId = null, $locationId = null, $qty = null, $userId = null)
    {
        
        DB::select("update sparepart_stocks set stock = (stock - $qty) where sparepart_id = ? and location_id = ? ", [$sparepartId,$locationId]);      
    }
}
