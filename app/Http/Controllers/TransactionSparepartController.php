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

use App\Exports\StockPerLocation;
use Maatwebsite\Excel\Facades\Excel;

class TransactionSparepartController extends Controller
{
    /**
     * Instantiate a new LocationController instance.
     */
    public function __construct()
    {
       $this->middleware('auth');
    }
    
    public function warehouseSparepartStock(Request $request): View
    {

        if($request->query('sparepartId')){

            $listRows = DB::select("
            select 
                sparepart_outs.sparepart_id,
                sparepart_outs.to_location_id,
                sparepart_outs.entry_date,
                sparepart_outs.qty,
                spareparts.name as sparepartName,
                spareparts.part_number,
                spareparts.satuan,
                sparepart_outs.description,
                sparepart_outs.kategori as kategoriPakai,
                locations.name as locationName,
                'Out' as kategoriInOut
            from 
                sparepart_outs,
                spareparts,
                locations
            where 
                sparepart_outs.sparepart_id = spareparts.id 
                and locations.id = sparepart_outs.to_location_id
                and sparepart_outs.from_location_id = '".$request->query('locationId')."'  
                and sparepart_outs.sparepart_id = '".$request->query('sparepartId')."' 
            union
            select 
                sparepart_ins.sparepart_id,
                '-',
                sparepart_ins.entry_date,
                sparepart_ins.qty,
                spareparts.name as sparepartName,
                spareparts.part_number,
                spareparts.satuan,
                sparepart_ins.description,
                '-',
                '-',
                'In'
            from 
                sparepart_ins,
                spareparts
            where 
                sparepart_ins.sparepart_id = spareparts.id 
                and sparepart_ins.location_id = '".$request->query('locationId')."' 
                and sparepart_ins.sparepart_id =  '".$request->query('sparepartId')."' 
                
            order by 
                entry_date desc
            
            ");

            //dd($listRows);
    
            $dataSparepartAndLocation = DB::table('sparepart_stocks')
            ->select('locations.id as locationId', 'locations.name as locationName', 'locations.location_type', 'spareparts.name as sparepartName','spareparts.part_number','sparepart_stocks.stock','spareparts.satuan')
            ->join('locations','locations.id','=','sparepart_stocks.location_id')
            ->join('spareparts','spareparts.id','=','sparepart_stocks.sparepart_id')
            ->orderBy('locations.name','asc')
            ->where('sparepart_stocks.location_id','=',$request->query('locationId'))
            ->where('sparepart_stocks.sparepart_id','=',$request->query('sparepartId'))
            ->first();
            
            return view('spareparts.warehouse_sparepart_list', [
                'listRows'      =>  $listRows ,                     
                'dataSparepartAndLocation' =>  $dataSparepartAndLocation ,            
                'locationId'    =>  $request->query('locationId') ,            
            ]);
        }
        else{

            $listRows = DB::table('sparepart_stocks')
            ->select('spareparts.id as sparepartId', 'spareparts.part_number', 'spareparts.name', 'spareparts.satuan', 'sparepart_stocks.stock', 'sparepart_stocks.id as stockId','sparepart_stocks.location_id')
            ->join('spareparts','spareparts.id','=','sparepart_stocks.sparepart_id')
            ->orderBy('spareparts.name','asc')
            ->where('sparepart_stocks.location_id','=',$request->query('locationId'))
            ->get();
            //dd($listRows);
    
            $listOfLocations = DB::table('user_locations')
            ->select('locations.id', 'locations.name', 'locations.location_type')
            ->join('locations','locations.id','=','user_locations.location_id')
            ->orderBy('locations.name','asc')
            ->where('user_locations.user_id','=', auth()->user()->id)
            ->where('locations.location_type','=', 'Warehouse')
            ->get();
            
            return view('spareparts.warehouse_sparepart_stock', [
                'listRows' =>  $listRows ,                     
                'listOfLocations' =>  $listOfLocations ,            
                'locationId' =>  $request->query('locationId') ,            
            ]);
        }
    }
    
    public function stockPerLocation(Request $request) 
    {

        $dataLocation = DB::table('locations')
        ->select('locations.id as locationId', 'locations.name as locationName')
        ->where('id','=',$request->query('locationId'))
        ->first();

        return Excel::download(new StockPerLocation($request->query('locationId') ,$dataLocation->locationName ), 'Stock Sparepart di '.$dataLocation->locationName.' - '.now().'.xlsx');
    }


    public function warehouseSparepartIn(): View
    {
        $listOfUnits = DB::table('units')
        ->select('type','merk','model')
        ->groupBy('type','merk','model')
        ->orderBy('type','asc')
        ->orderBy('merk','asc')
        ->orderBy('model','asc')
        ->get();
        
        $listOfSpareparts = DB::table('spareparts')
        ->orderBy('name','asc')
        ->orderBy('part_number','asc')
        ->get();

        
        $listOfLocations = DB::table('user_locations')
        ->select('locations.id', 'locations.name', 'locations.location_type')
        ->join('locations','locations.id','=','user_locations.location_id')
        ->orderBy('locations.name','asc')
        ->where('user_locations.user_id','=', auth()->user()->id)
        ->where('locations.location_type','=', 'Warehouse')
        ->get();

        return view('spareparts.warehouse_sparepart_in', [
            'listOfUnits' =>  $listOfUnits ,            
            'listOfSpareparts' =>  $listOfSpareparts ,            
            'listOfLocations' =>  $listOfLocations ,            
       
        ]);
    }

    
    public function warehouseSparepartInInsert(StoreTransactionWarehouseInRequest $request): RedirectResponse
    {
        SparepartIn::create($request->all());

        HelperGlobal::updateQtySparepartIn($request->sparepart_id, $request->location_id, $request->qty);

        return redirect()->route('warehouseSparepartIn')
                ->withSuccess('Sparepart masuk berhasil disimpan..');
    }


    
    public function warehouseSparepartOut(): View
    {
        $listOfUnits = DB::table('units')
        ->select('type','merk','model')
        ->groupBy('type','merk','model')
        ->orderBy('type','asc')
        ->orderBy('merk','asc')
        ->orderBy('model','asc')
        ->get();
        
        $listOfSpareparts = DB::table('spareparts')
        ->orderBy('name','asc')
        ->orderBy('part_number','asc')
        ->get();
        

        
        $listOfLocations = DB::table('user_locations')
        ->select('locations.id', 'locations.name', 'locations.location_type')
        ->join('locations','locations.id','=','user_locations.location_id')
        ->orderBy('locations.name','asc')
        ->where('user_locations.user_id','=', auth()->user()->id)
        ->where('locations.location_type','=', 'Warehouse')
        ->where('locations.status_active','=', 'Active')
        ->get();
        
        $listOfAllLocations = DB::table('locations')
        ->select('locations.id', 'locations.name', 'locations.location_type')
        ->orderBy('locations.name','asc')
        ->where('locations.status_active','=', 'Active')
        ->get();

        return view('spareparts.warehouse_sparepart_out', [
            'listOfUnits' =>  $listOfUnits ,            
            'listOfSpareparts' =>  $listOfSpareparts ,            
            'listOfLocations' =>  $listOfLocations ,                  
            'listOfAllLocations' =>  $listOfAllLocations ,                  
        ]);
    }

    
    public function warehouseSparepartOutInsert(StoreTransactionWarehouseOutRequest $request): RedirectResponse
    {

        //dd($request->from_location_id);

        $dataSparepartStock = SparepartStock::select('id','sparepart_id','location_id','stock')
        ->where('sparepart_id','=', $request->sparepart_id)
        ->where('location_id','=',  $request->from_location_id)
        ->first();

        if( $dataSparepartStock){
            
            if($request->qty > $dataSparepartStock->stock ){
                return redirect()->route('warehouseSparepartOut')
                ->withError('Stok sparepart adalah '.$dataSparepartStock->stock.', silahkan input jumlah qty kurang dari '.$dataSparepartStock->stock.'.'); 
            }
            else{               

                $insertOut = array(
                    'sparepart_id'      =>  $request->sparepart_id ,            
                    'from_location_id'  =>  $request->from_location_id ,            
                    'to_location_id'    =>  $request->to_location_id ,                  
                    'entry_date'        =>  $request->entry_date ,
                    'qty'               =>  $request->qty ,
                    'description'       =>  $request->description ,
                    'kategori'          =>  $request->kategori 
                );
                SparepartOut::create($insertOut);

                HelperGlobal::updateQtySparepartOut($request->sparepart_id, $request->from_location_id, $request->qty);
        
                return redirect()->route('warehouseSparepartOut')->withSuccess('Sparepart masuk berhasil disimpan..');
            }

            
        }
        else{
            return redirect()->route('warehouseSparepartOut')
            ->withError('Sparepart tidak ditemukan..');
        }

    }


    //////////////////////////////

    
    public function locationSparepartStock(Request $request): View
    {

        if($request->query('sparepartId')){

            $listRows = DB::select("
            select 
                sparepart_outs.sparepart_id,
                sparepart_outs.to_location_id,
                sparepart_outs.entry_date,
                sparepart_outs.qty,
                spareparts.name as sparepartName,
                spareparts.part_number,
                spareparts.satuan,
                sparepart_outs.description,
                sparepart_outs.kategori as kategoriPakai,
                locations.name as locationName,
                'Out' as kategoriInOut,
                units.hull_number,
                units.type,
                units.model,
                units.merk,
                units.sn
            from 
                sparepart_outs
                left join spareparts on  sparepart_outs.sparepart_id = spareparts.id 
                left join  locations on  locations.id = sparepart_outs.to_location_id
                left join  units on  units.id = sparepart_outs.unit_id
            where 
                sparepart_outs.from_location_id = '".$request->query('locationId')."'  
                and sparepart_outs.sparepart_id = '".$request->query('sparepartId')."' 

            union

            select 
                sparepart_outs.sparepart_id,
                sparepart_outs.to_location_id,
                sparepart_outs.entry_date,
                sparepart_outs.qty,
                spareparts.name as sparepartName,
                spareparts.part_number,
                spareparts.satuan,
                sparepart_outs.description,
                sparepart_outs.kategori as kategoriPakai,
                locations.name as locationName,
                'In' as kategoriInOut,
                units.hull_number,
                units.type,
                units.model,
                units.merk,
                units.sn
            from 
                sparepart_outs
                left join spareparts on  sparepart_outs.sparepart_id = spareparts.id 
                left join  locations on  locations.id = sparepart_outs.to_location_id
                left join  units on  units.id = sparepart_outs.unit_id
            where 
                sparepart_outs.from_location_id != '".$request->query('locationId')."'  
                and sparepart_outs.to_location_id = '".$request->query('locationId')."'  
                and sparepart_outs.sparepart_id = '".$request->query('sparepartId')."' 
                
            union

            select 
                sparepart_ins.sparepart_id,
                '-',
                sparepart_ins.entry_date,
                sparepart_ins.qty,
                spareparts.name as sparepartName,
                spareparts.part_number,
                spareparts.satuan,
                sparepart_ins.description,
                '-',
                '-',
                'In',
                '',
                '',
                '',
                '',
                ''
            from 
                sparepart_ins,
                spareparts
            where 
                sparepart_ins.sparepart_id = spareparts.id 
                and sparepart_ins.location_id = '".$request->query('locationId')."' 
                and sparepart_ins.sparepart_id =  '".$request->query('sparepartId')."' 
                
            order by 
                entry_date desc
            
            ");

            //dd($listRows);
    
            $dataSparepartAndLocation = DB::table('sparepart_stocks')
            ->select('locations.id as locationId', 'locations.name as locationName', 'locations.location_type', 'spareparts.name as sparepartName','spareparts.part_number','sparepart_stocks.stock','spareparts.satuan')
            ->join('locations','locations.id','=','sparepart_stocks.location_id')
            ->join('spareparts','spareparts.id','=','sparepart_stocks.sparepart_id')
            ->orderBy('locations.name','asc')
            ->where('sparepart_stocks.location_id','=',$request->query('locationId'))
            ->where('sparepart_stocks.sparepart_id','=',$request->query('sparepartId'))
            ->first();
            
            return view('spareparts.location_sparepart_list', [
                'listRows'      =>  $listRows ,                     
                'dataSparepartAndLocation' =>  $dataSparepartAndLocation ,            
                'locationId'    =>  $request->query('locationId') ,            
            ]);
        }
        else{

            $listRows = DB::table('sparepart_stocks')
            ->select('spareparts.id as sparepartId', 'spareparts.part_number', 'spareparts.name', 'spareparts.satuan', 'sparepart_stocks.stock', 'sparepart_stocks.id as stockId','sparepart_stocks.location_id')
            ->join('spareparts','spareparts.id','=','sparepart_stocks.sparepart_id')
            ->orderBy('spareparts.name','asc')
            ->where('sparepart_stocks.location_id','=',$request->query('locationId'))
            ->get();
            //dd($listRows);
    
            $listOfLocations = DB::table('user_locations')
            ->select('locations.id', 'locations.name', 'locations.location_type')
            ->join('locations','locations.id','=','user_locations.location_id')
            ->orderBy('locations.name','asc')
            ->where('user_locations.user_id','=', auth()->user()->id)
            ->where('locations.location_type','=', 'Work Location')
            ->get();
            
            return view('spareparts.location_sparepart_stock', [
                'listRows' =>  $listRows ,                     
                'listOfLocations' =>  $listOfLocations ,            
                'locationId' =>  $request->query('locationId') ,            
            ]);
        }
    }

    public function locationSparepartIn(Request $request): View
    {
        
        $dataSparepartIn = DB::table('sparepart_outs')
        ->select('sparepart_outs.id','locations.id as locationId', 'locations.name as locationName', 'sparepart_outs.qty','locations.location_type','spareparts.id as sparepartId', 'spareparts.name as sparepartName','spareparts.part_number','spareparts.satuan')

        ->join('locations','locations.id','=','sparepart_outs.from_location_id')
        ->join('spareparts','spareparts.id','=','sparepart_outs.sparepart_id')
        ->orderBy('locations.name','asc')
        ->where('sparepart_outs.to_location_id','=',$request->query('locationId'))
        ->where('sparepart_outs.from_location_id','!=',$request->query('locationId'))
        ->whereNull('sparepart_outs.received_at')
        ->get();


        $listOfLocations = DB::table('user_locations')
        ->select('locations.id', 'locations.name', 'locations.location_type')
        ->join('locations','locations.id','=','user_locations.location_id')
        ->orderBy('locations.name','asc')
        ->where('user_locations.user_id','=', auth()->user()->id)
        ->where('locations.location_type','=', 'Work Location')
        ->get();

        return view('spareparts.location_sparepart_in', [           
            'listOfLocations' =>  $listOfLocations ,            
            'dataSparepartIns' =>  $dataSparepartIn ,            
            'locationId' =>  $request->query('locationId') ,   
       
        ]);
    }

    
    public function locationSparepartInInInsert(Request $request): RedirectResponse
    {
        $dataSparepartOut = SparepartOut::select('id','sparepart_id','from_location_id','to_location_id','qty')
        ->where('id','=', $request->id)
        ->whereNull('received_at')
        ->first();

        if($dataSparepartOut){
            
            $sparepartOut = SparepartOut::find($request->id);

            $sparepartOut->received_at  =   date('Y-m-d H:i:s');       
            $sparepartOut->received_by  =   auth()->user()->id;
            
            $sparepartOut->update();

            HelperGlobal::updateQtySparepartIn($dataSparepartOut->sparepart_id, $dataSparepartOut->to_location_id, $dataSparepartOut->qty);

            return redirect()->to('/location-sparepart-in?locationId='.$dataSparepartOut->to_location_id)
            ->withSuccess('Sparepart masuk berhasil disimpan..');
            
        }
        else{

            return redirect()->to('/location-sparepart-in')
            ->withSuccess('Sparepart tidak tersedia.');
        }

    }

    
    public function locationSparepartBuy(): View
    {
        $listOfUnits = DB::table('units')
        ->select('type','merk','model')
        ->groupBy('type','merk','model')
        ->orderBy('type','asc')
        ->orderBy('merk','asc')
        ->orderBy('model','asc')
        ->get();
        
        $listOfSpareparts = DB::table('spareparts')
        ->orderBy('name','asc')
        ->orderBy('part_number','asc')
        ->get();

        
        $listOfLocations = DB::table('user_locations')
        ->select('locations.id', 'locations.name', 'locations.location_type')
        ->join('locations','locations.id','=','user_locations.location_id')
        ->orderBy('locations.name','asc')
        ->where('user_locations.user_id','=', auth()->user()->id)
        ->where('locations.location_type','=', 'Work Location')
        ->get();

        return view('spareparts.location_sparepart_buy', [
            'listOfUnits' =>  $listOfUnits ,            
            'listOfSpareparts' =>  $listOfSpareparts ,            
            'listOfLocations' =>  $listOfLocations ,            
       
        ]);
    }

    
    public function locationSparepartBuyInsert(StoreTransactionWarehouseInRequest $request): RedirectResponse
    {
        SparepartIn::create($request->all());

        HelperGlobal::updateQtySparepartIn($request->sparepart_id, $request->location_id, $request->qty);



        return redirect()->route('locationSparepartBuy')
                ->withSuccess('Sparepart masuk berhasil disimpan.');
    }

    
    
    public function locationSparepartOut(): View
    {
        $listOfUnits = DB::table('units')
        ->select('type','merk','model')
        ->groupBy('type','merk','model')
        ->orderBy('type','asc')
        ->orderBy('merk','asc')
        ->orderBy('model','asc')
        ->get();
        
        $listOfSpareparts = DB::table('spareparts')
        ->orderBy('name','asc')
        ->orderBy('part_number','asc')
        ->get();
        

        
        $listOfLocations = DB::table('user_locations')
        ->select('locations.id', 'locations.name', 'locations.location_type')
        ->join('locations','locations.id','=','user_locations.location_id')
        ->orderBy('locations.name','asc')
        ->where('user_locations.user_id','=', auth()->user()->id)
        ->where('locations.location_type','=', 'Work Location')
        ->where('locations.status_active','=', 'Active')
        ->get();
        
        $listOfAllLocations = DB::table('locations')
        ->select('locations.id', 'locations.name', 'locations.location_type')
        ->orderBy('locations.name','asc')
        ->where('locations.status_active','=', 'Active')
        ->get();

        
        $listOfAllUnits = DB::table('units')
        ->select('*')
        ->orderBy('units.hull_number','asc')
        ->get();

        return view('spareparts.location_sparepart_out', [
            'listOfUnits' =>  $listOfUnits ,            
            'listOfSpareparts' =>  $listOfSpareparts ,            
            'listOfLocations' =>  $listOfLocations ,                  
            'listOfAllLocations' =>  $listOfAllLocations ,                  
            'listOfAllUnits' =>  $listOfAllUnits ,                  
        ]);
    }

    

    public function locationSparepartOutInsert(StoreTransactionWarehouseOutRequest $request): RedirectResponse
    {
        $dataSparepartStock = SparepartStock::select('id','sparepart_id','location_id','stock')
        ->where('sparepart_id','=', $request->sparepart_id)
        ->where('location_id','=',  $request->from_location_id)
        ->first();

        if( $dataSparepartStock){
            
            if($request->qty > $dataSparepartStock->stock ){
                return redirect()->route('locationSparepartOut')
                ->withError('Stok sparepart adalah '.$dataSparepartStock->stock.', silahkan input jumlah qty kurang dari '.$dataSparepartStock->stock.'.');               
            }
            else{               

                $insertOut = array(
                    'sparepart_id'      =>  $request->sparepart_id ,            
                    'from_location_id'  =>  $request->from_location_id ,            
                    'to_location_id'    =>  $request->to_location_id ,                  
                    'unit_id'           =>  $request->unit_id ,                  
                    'working_hour'           =>  $request->working_hour ,                  
                    'entry_date'        =>  $request->entry_date ,
                    'qty'               =>  $request->qty ,
                    'description'       =>  $request->description ,
                    'kategori'          =>  $request->kategori 
                );
                //dd($insertOut);
                SparepartOut::create($insertOut);

                HelperGlobal::updateQtySparepartOut($request->sparepart_id, $request->from_location_id, $request->qty);
        
                return redirect()->route('locationSparepartOut')->withSuccess('Data sparepart keluar berhasil disimpan.');
            }

            
        }
        else{
            return redirect()->route('locationSparepartOut')
            ->withError('Sparepart tidak ditemukan..');
        }

    }

}