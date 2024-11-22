@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <div class="float-start">
                Ubah Data Sparepart
            </div>
        </div>
        <div class="card-body">
            @include('layouts.partials.messages')
            <form action="{{ route('spareparts.update', $rowData->id) }}" method="post">
                @csrf
                @method("PUT")

                <div class="mb-3 row">
                    <label for="name" class="col-md-3 col-form-label text-md-end text-start">Nama Sparepart</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $rowData->name }}">

                        @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>
                
                <div class="mb-3 row">
                    <label for="part_number" class="col-md-3 col-form-label text-md-end text-start">Part Number</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="part_number" name="part_number" value="{{ $rowData->part_number }}">

                        @if ($errors->has('part_number'))
                        <span class="text-danger">{{ $errors->first('part_number') }}</span>
                        @endif
                    </div>
                </div>
                
                <div class="mb-3 row">
                    <label for="satuan" class="col-md-3 col-form-label text-md-end text-start">Satuan</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control @error('satuan') is-invalid @enderror" id="satuan" name="satuan" value="{{ $rowData->satuan }}">

                        @if ($errors->has('satuan'))
                        <span class="text-danger">{{ $errors->first('satuan') }}</span>
                        @endif
                    </div>
                </div>
                
                <div class="mb-3 row">
                    <label for="permissions" class="col-md-3 col-form-label text-md-end text-start"></label>
                    <div class="col-md-6">
                        <a href="{{ route('spareparts.index') }}" class="btn btn-warning btn-sm">Kembali</a>
                        <input type="submit" class="btn btn-primary btn-sm" value="Simpan">

                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection