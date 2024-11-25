<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Location;
use App\Models\UnitLocations;
use App\Models\UnitOperators;
use App\Models\User;
use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\UpdateUnitRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UnitController extends Controller
{
    /**
     * Instantiate a new ProductController instance.
     */
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('permission:create-unit|edit-unit|delete-unit', ['only' => ['index','show']]);
       $this->middleware('permission:create-unit', ['only' => ['create','store']]);
       $this->middleware('permission:edit-unit', ['only' => ['edit','update']]);
       $this->middleware('permission:delete-unit', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('units.index', [
            'rowDatas' => Unit::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $locations = Location::where('status_active','Active')->orderBy('name')->get();
        $operators = User::orderBy('name')->get();
        return view('units.create', compact('locations','operators'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUnitRequest $request): RedirectResponse
    {
        $newId =  Unit::create($request->all())->id;
        
        $unitLocations                  = new UnitLocations();
        $unitLocations->unit_id         = $newId;
        $unitLocations->location_name   = $request->location_name;
        $unitLocations->save();
        
        $unitOperators                = new UnitOperators();
        $unitOperators->unit_id         = $newId;
        $unitOperators->operator_name   = $request->operator_name;
        $unitOperators->save();

        return redirect()->route('units.index')->withSuccess('Tambah Data Unit telah berhasil.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit): View
    {
        return view('units.show', [
            'rowData' => $unit
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit): View
    {
        $locations = Location::where('status_active','Active')->orderBy('name')->get();
        $operators = User::orderBy('name')->get();
        return view('units.edit', [
            'rowData' => $unit
        ], compact('locations','operators'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUnitRequest $request, Unit $unit): RedirectResponse
    {

        if($unit->location_name != $request->location_name){
            $unitLocations                  = new UnitLocations();
            $unitLocations->unit_id         = $unit->id;
            $unitLocations->location_name   = $request->location_name;
            $unitLocations->save();
        }

        if($unit->operator_name != $request->operator_name){
            $unitOperators                  = new UnitOperators();
            $unitOperators->unit_id         = $unit->id;
            $unitOperators->operator_name   = $request->operator_name;
            $unitOperators->save();    
        }

        
        $unit->update($request->all());

        return redirect()->back()->withSuccess('Ubah Data Unit telah berhasil.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit): RedirectResponse
    {
        $unit->delete();
        return redirect()->route('units.index')->withSuccess('Hapus data Unit telah berhasil.');
    }
}