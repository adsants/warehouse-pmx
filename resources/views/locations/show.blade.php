@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <div class="float-start">
                Detail Lokasi
            </div>
        </div>
        <div class="card-body">

            <div class="mb-3 row">
                <label for="name" class="col-md-3 col-form-label text-md-end text-start"><strong>Lokasi</strong></label>
                <div class="col-md-6" style="line-height: 35px;">
                    {{ $rowData->name }}
                </div>
            </div>
            <div class="mb-3 row">
                <label for="name" class="col-md-3 col-form-label text-md-end text-start"><strong>Keteranga</strong></label>
                <div class="col-md-6" style="line-height: 35px;">
                    {{ $rowData->description }}
                </div>
            </div>
            <div class="mb-3 row">
                <label for="name" class="col-md-3 col-form-label text-md-end text-start"><strong>Tipe Lokasi</strong></label>
                <div class="col-md-6" style="line-height: 35px;">
                    {{ $rowData->location_type }}
                </div>
            </div>
            <div class="mb-3 row">
                <label for="name" class="col-md-3 col-form-label text-md-end text-start"><strong>Status Aktif</strong></label>
                <div class="col-md-6" style="line-height: 35px;">
                    {{ $rowData->status_active }}
                </div>
            </div>
            
            <div class="mb-3 row">
                    <label for="permissions" class="col-md-3 col-form-label text-md-end text-start"></label>
                    <div class="col-md-6">
                        <a href="{{ route('locations.index') }}" class="btn btn-warning btn-sm">Kembali</a>

                    </div>
                </div>
        </div>
    </div>
</div>
@endsection