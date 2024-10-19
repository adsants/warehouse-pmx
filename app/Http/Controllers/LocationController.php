<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Support\Renderable;

class LocationController extends Controller
{
    /**
     * Instantiate a new LocationController instance.
     */
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('permission:create-location|edit-location|delete-location', ['only' => ['index','show']]);
       $this->middleware('permission:create-location', ['only' => ['create','store']]);
       $this->middleware('permission:edit-location', ['only' => ['edit','update']]);
       $this->middleware('permission:delete-location', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('locations.index', [
            'rowDatas' => Location::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('locations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocationRequest $request): RedirectResponse
    {
        Location::create($request->all());
        return redirect()->route('locations.index')->withSuccess('Tambah Data Lokasi telah berhasil.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location): Renderable
    {
        return view('locations.show', [
            'rowData' => $location
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): Renderable
    {
        
        return view('locations.edit', [
            'rowData' => Location::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocationRequest $request, Location $location): RedirectResponse
    {
        $location->update($request->all());
        return redirect()->route('locations.index')->withSuccess('Ubah Data Lokasi telah berhasil.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location): RedirectResponse
    {
        $location->delete();
        return redirect()->route('locations.index')->withSuccess('Hapus Data Lokasi telah berhasil.');
    }
}