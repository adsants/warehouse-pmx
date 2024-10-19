@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <div class="float-start">
                Ubah Data Lokasi
            </div>
        </div>
        <div class="card-body">
        @include('layouts.partials.messages')
            <form action="{{ route('locations.update', $rowData->id) }}" method="post">
                @csrf
                @method("PUT")

                <div class="mb-3 row">
                    <label for="name" class="col-md-3 col-form-label text-md-end text-start">Nama Lokasi</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $rowData->name }}">

                        @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="description" class="col-md-3 col-form-label text-md-end text-start">Keterangan</label>
                    <div class="col-md-9">
                        <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ $rowData->description }}</textarea>

                        @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                    </div>
                </div>


                <div class="mb-3 row">
                    <label for="name" class="col-md-3 col-form-label text-md-end text-start">Tipe</label>
                    <div class="col-md-5">

                        <select name="location_type" required id="location_type" class="form-control ">
                            <option value="">Please Select</option>
                            <option {{ $rowData->location_type == 'Warehouse'  ? 'selected' : '' }} value="Warehouse">Warehouse</option>
                            <option {{ $rowData->location_type == 'Work Location'  ? 'selected' : '' }} value="Work Location">Work Location</option>
                        </select>
                        @if ($errors->has('location_type'))
                        <span class="text-danger">{{ $errors->first('location_type') }}</span>
                        @endif
                    </div>
                </div>


                <div class="mb-3 row">
                    <label for="name" class="col-md-3 col-form-label text-md-end text-start">Status</label>
                    <div class="col-md-5">

                        <select name="status_active" required id="status_active" class="form-control ">
                            <option value="">Please Select</option>
                            <option {{ $rowData->status_active == 'Active'  ? 'selected' : '' }}  value="Active">Active</option>
                            <option {{ $rowData->status_active == 'Non Active'  ? 'selected' : '' }}  value="Non Active">Non Active</option>
                        </select>
                        @if ($errors->has('status_active'))
                        <span class="text-danger">{{ $errors->first('status_active') }}</span>
                        @endif
                    </div>
                </div>





                <div class="mb-3 row">
                    <label for="permissions" class="col-md-3 col-form-label text-md-end text-start"></label>
                    <div class="col-md-6">
                        <a href="{{ route('locations.index') }}" class="btn btn-warning btn-sm">Kembali</a>
                        <input type="submit" class="btn btn-primary btn-sm" value="Simpan">

                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection