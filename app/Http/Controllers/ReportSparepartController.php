<?php

namespace App\Http\Controllers;

use HelperGlobal;
use App\Models\SparepartIn;
use App\Models\SparepartStock;
use App\Models\SparepartOut;
use App\Models\SparepartUnits;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Http\Requests\StoreTransactionWarehouseInRequest;
use App\Http\Requests\StoreTransactionWarehouseOutRequest;

use App\Exports\StockAll;
use App\Exports\StockAllPerLocation;
use App\Exports\UnitSparepart;
use Maatwebsite\Excel\Facades\Excel;

class ReportSparepartController extends Controller
{
    /**
     * Instantiate a new LocationController instance.
     */
    public function __construct()
    {
       $this->middleware('auth');
    }

    
    public function reportStockSparepart(Request $request): View
    {

        $listRows = DB::table('sparepart_stocks')
        
        ->select('spareparts.id as sparepartId', 'spareparts.part_number', 'spareparts.name', 'spareparts.satuan', 'sparepart_stocks.stock', 'sparepart_stocks.id as stockId','sparepart_stocks.location_id','locations.name as locationName')

        ->join('spareparts','spareparts.id','=','sparepart_stocks.sparepart_id')
        ->join('locations','locations.id','=','sparepart_stocks.location_id')

        ->orderBy('spareparts.part_number','asc')
        ->orderBy('locations.name','asc')

        ->get();

        return view('reports.sparepart_stock', [
            'listRows' =>  $listRows ,                               
        ]);
        
    }
    
    
    public function reportAllSparepart(Request $request): View
    {

        $listRows = DB::table('sparepart_stocks')
        ->select('spareparts.id as sparepartId', 'spareparts.part_number', 'spareparts.name', 'spareparts.satuan', 'sparepart_stocks.stock', 'sparepart_stocks.id as stockId','sparepart_stocks.location_id','locations.name as locationName')
        ->join('spareparts','spareparts.id','=','sparepart_stocks.sparepart_id')
        ->join('locations','locations.id','=','sparepart_stocks.location_id')
        ->orderBy('spareparts.name','asc')
        ->orderBy('locations.name','asc')
        ->get();

        return view('reports.all_sparepart_stock', [
            'listRows' =>  $listRows ,                               
        ]);
        
    }
    

    public function stockAll(Request $request) 
    {
        return Excel::download(new StockAll() , 'All Stock Sparepart per Location - '.now().'.xlsx');
    }

    public function stockAllPerLocation(Request $request) 
    {
        return Excel::download(new StockAllPerLocation() , 'All Stock Sparepart - '.now().'.xlsx');
    }



    
    public function reportSparepartUnit(Request $request): View
    {

        if($request->query('unitId')){

            $dataUnit = DB::table('units')
            ->select('id','hull_number','type','merk','model')
            ->where('id','=', $request->query('unitId'))
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
                and sparepart_outs.unit_id = '".$request->query('unitId')."'  
            ");
            return view('reports.sparepart_unit_detail', [
                'listRows' =>  $listRows ,                                  
                'dataUnit' =>  $dataUnit ,                                  
            ]);
        }
        else{
            $listOfUnits = DB::table('units')
            ->select('id','hull_number','type','merk','model')
            ->orderBy('type','asc')
            ->orderBy('merk','asc')
            ->orderBy('model','asc')
            ->get();
            
            return view('reports.sparepart_unit', [
                'listRows' =>  $listOfUnits ,                                  
            ]);
        }
    }


    public function sparepartUnit(Request $request) 
    {

        $dataUnit = DB::table('units')
        ->select('id','hull_number','type','merk','model')
        ->where('id','=', $request->query('unitId'))
        ->first();

       

        return Excel::download(new UnitSparepart($request->query('unitId')) , 'Riwayat Sparepart di Unit '.$dataUnit->hull_number.' - '.now().'.xlsx');

    }

}