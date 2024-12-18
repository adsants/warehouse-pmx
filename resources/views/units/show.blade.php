@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="card">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Detail Unit
                </div>
            </div>
            <div class="card-body">

                <div class="mb-3 row">
                    <label for="name" class="col-md-3 col-form-label text-md-end text-start"><strong>Hull Number :</strong></label>
                    <div class="col-md-3" style="line-height: 35px;">
                        {{ $rowData->hull_number }}
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-md-3 col-form-label text-md-end text-start"><strong>Model :</strong></label>
                    <div class="col-md-3" style="line-height: 35px;">
                        {{ $rowData->model }}
                    </div>
                    <label for="email" class="col-md-3 col-form-label text-md-end text-start"><strong>Type :</strong></label>
                    <div class="col-md-3" style="line-height: 35px;">
                        {{ $rowData->type }}
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-md-3 col-form-label text-md-end text-start"><strong>Merk :</strong></label>
                    <div class="col-md-3" style="line-height: 35px;">
                        {{ $rowData->merk }}
                    </div>
                    <label for="email" class="col-md-3 col-form-label text-md-end text-start"><strong>SN :</strong></label>
                    <div class="col-md-3" style="line-height: 35px;">
                        {{ $rowData->sn }}
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-md-3 col-form-label text-md-end text-start"><strong>Engine Sn :</strong></label>
                    <div class="col-md-3" style="line-height: 35px;">
                        {{ $rowData->engine_sn }}
                    </div>
                    <label for="email" class="col-md-3 col-form-label text-md-end text-start"><strong>Year Build :</strong></label>
                    <div class="col-md-3" style="line-height: 35px;">
                        {{ $rowData->year_build }}
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-md-3 col-form-label text-md-end text-start"><strong>Buying Date :</strong></label>
                    <div class="col-md-3" style="line-height: 35px;">
                        {{ $rowData->buying_date }}
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-md-3 col-form-label text-md-end text-start"><strong>Operator :</strong></label>
                    <div class="col-md-3" style="line-height: 35px;">
                        {{ $rowData->operator_name }}
                    </div>
                    <label for="email" class="col-md-3 col-form-label text-md-end text-start"><strong>Lokasi :</strong></label>
                    <div class="col-md-3" style="line-height: 35px;">
                        {{ $rowData->location_name }}
                    </div>
                </div>

                
                <div class="mb-3 row">
                    <label for="permissions" class="col-md-3 col-form-label text-md-end text-start"></label>
                    <div class="col-md-6">
                        <a href="{{ route('units.index') }}" class="btn btn-warning btn-sm">Kembali</a>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection