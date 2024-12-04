<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;
use App\Models\SparepartUnits;
use App\Http\Requests\StoreSparepartRequest;
use App\Http\Requests\UpdateSparepartRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;

class SparepartController extends Controller
{
    /**
     * Instantiate a new LocationController instance.
     */
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('permission:create-sparepart|edit-sparepart|delete-sparepart', ['only' => ['index','show']]);
       $this->middleware('permission:create-sparepart', ['only' => ['create','store']]);
       $this->middleware('permission:edit-sparepart', ['only' => ['edit','update']]);
       $this->middleware('permission:delete-sparepart', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //echo Auth::user()->roles;
        return view('spareparts.index', [
            'rowDatas' => Sparepart::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('spareparts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSparepartRequest $request): RedirectResponse
    {
        Sparepart::create($request->all());
        return redirect()->route('spareparts.index')->withSuccess('Tambah Data Spareapart telah berhasil.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sparepart $sparepart): Renderable
    {
        
        $listOfVehicle = DB::table('units')
        ->select('type','merk','model')
        ->groupBy('type','merk','model')
        ->orderBy('type','asc')
        ->orderBy('merk','asc')
        ->orderBy('model','asc')
        ->get();

        return view('spareparts.show', [
            'rowData' => $sparepart,
            'listOfVehicle' =>  $listOfVehicle ,            
            'AllUnitData'   => SparepartUnits::select('sparepart_units.id', 'sparepart_units.type','sparepart_units.merk','sparepart_units.model')->join('spareparts', 'spareparts.id', '=', 'sparepart_units.sparepart_id')->where('sparepart_id','=', $sparepart->id)->get()
       
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): Renderable
    {
        
        return view('spareparts.edit', [
            'rowData' => Sparepart::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSparepartRequest $request, Sparepart $sparepart): RedirectResponse
    {
        $sparepart->update($request->all());
        return redirect()->route('spareparts.index')->withSuccess('Ubah Data Spareapart telah berhasil.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sparepart $sparepart): RedirectResponse
    {
        $sparepart->delete();
        return redirect()->route('spareparts.index')->withSuccess('Hapus data Sparepart telah berhasil.');
    }


    
    public function addDetail(Request $request): RedirectResponse
    {
        $request->validate([
            'merk_model'          => 'required|max:250'
        ]);

        $merkModel  = (explode("|-|",$request->merk_model));

        $checkReady = DB::table('sparepart_units')
        ->where('sparepart_id',$request->sparepart_id)
        ->where('merk'  ,$merkModel[0])
        ->where('model' ,$merkModel[1])
        ->where('type'  ,$merkModel[2])
        ->first();

        //dd($checkReady);

        if($checkReady){
            session()->flash('error', 'Unit telah ada, silahkan ganti denganUnityang Lain.');
            return back();
        }
        else{

            $dataPost               = new SparepartUnits();
            $dataPost->sparepart_id = $request->sparepart_id;
            $dataPost->merk         = $merkModel[0];
            $dataPost->model        = $merkModel[1];
            $dataPost->type         = $merkModel[2];
            $dataPost->save();

            session()->flash('success', __('Sparepart Unit telah ditambahkan.'));
            return redirect()->route('spareparts.show', $request->sparepart_id);
        }

    }

    
    public function deleteDetail(int $id)
    {
        

        $dataOld = SparepartUnits::find($id);
        if (!$dataOld) {
            session()->flash('error', 'Sparepart Unit not found.');
            return back();
        }

        $dataOld->delete();
        session()->flash('success', 'Sparepart Unit has been deleted.');
        return back();
    }
}