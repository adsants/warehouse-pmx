@extends('layouts.app')
@section('styles')
<link href="{{ asset('assets/css/select2.css') }}" rel="stylesheet" />

<style>
    .form-check-label {
        text-transform: capitalize;
    }
</style>
@endsection
@section('content')

<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <div class="float-start">
                Tambah Data Unit
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('units.store') }}" method="post">
                @csrf

                <div class="mb-3 row">
                    <label for="name" class="col-md-3 col-form-label text-md-end text-start">Hull Number</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control @error('hull_number') is-invalid @enderror" id="hull_number" name="hull_number" value="{{ old('hull_number') }}" required>
                        
                        @if ($errors->has('hull_number'))
                        <span class="text-danger">{{ $errors->first('hull_number') }}</span>
                        @endif
                    </div>
                </div>
                
                <div class="mb-3 row">
                    <label for="name" class="col-md-3 col-form-label text-md-end text-start">Tipe</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control @error('type') is-invalid @enderror" id="type" name="type" value="{{ old('type') }}"  required>
                        <sup>Contoh : EXCAVATOR, BULLDOZER</sup>
                        
                        @if ($errors->has('type'))
                        <span class="text-danger">{{ $errors->first('type') }}</span>
                        @endif
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="name" class="col-md-3 col-form-label text-md-end text-start">Model</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control @error('model') is-invalid @enderror" id="model" name="model" value="{{ old('model') }}" required>
                        <sup>Contoh : CA250D, BW211D-40</sup>
                        
                        @if ($errors->has('model'))
                        <span class="text-danger">{{ $errors->first('model') }}</span>
                        @endif
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="name" class="col-md-3 col-form-label text-md-end text-start">Merk</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control @error('merk') is-invalid @enderror" id="merk" name="merk" value="{{ old('merk') }}" required>
                        <sup>Contoh : CATERPILLAR, KOMATSU</sup>
                        
                        @if ($errors->has('merk'))
                        <span class="text-danger">{{ $errors->first('merk') }}</span>
                        @endif
                    </div>
                </div>

                
                <div class="mb-3 row">
                    <label for="name" class="col-md-3 col-form-label text-md-end text-start">Serial Number S/N</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control @error('sn') is-invalid @enderror" id="sn" name="sn" value="{{ old('sn') }}" >
                        
                        @if ($errors->has('sn'))
                        <span class="text-danger">{{ $errors->first('sn') }}</span>
                        @endif
                    </div>
                    
                    <label for="name" class="col-md-3 col-form-label text-md-end text-start">Engine Serial Number S/N</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control @error('engine_sn') is-invalid @enderror" id="engine_sn" name="engine_sn" value="{{ old('engine_sn') }}" >
                        
                        @if ($errors->has('engine_sn'))
                        <span class="text-danger">{{ $errors->first('engine_sn') }}</span>
                        @endif
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="name" class="col-md-3 col-form-label text-md-end text-start">Year Build</label>
                    <div class="col-md-3">
                        <input type="number" class="form-control @error('year_build') is-invalid @enderror" id="year_build" name="year_build" value="{{ old('year_build') }}" >
                        
                        @if ($errors->has('year_build'))
                        <span class="text-danger">{{ $errors->first('year_build') }}</span>
                        @endif
                    </div>
                    
                    <label for="name" class="col-md-3 col-form-label text-md-end text-start">Buying Date</label>
                    <div class="col-md-3">
                        <input type="date" class="form-control @error('buying_date') is-invalid @enderror" id="buying_date" name="buying_date" value="{{ old('buying_date') }}" >
                        
                        @if ($errors->has('buying_date'))
                        <span class="text-danger">{{ $errors->first('buying_date') }}</span>
                        @endif
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="name" class="col-md-3 col-form-label text-md-end text-start">Lokasi</label>
                    <div class="col-md-9">
                        
                        <select name="location_name" id="location_name" required class="form-control select2">
                            <option value="">Silahkan Pilih</option>
                            @foreach ($locations as $location)
                                <option value="{{ $location->name }}">{{ $location->name }}</option>
                            @endforeach
                        </select>
                        
                        @if ($errors->has('location'))
                        <span class="text-danger">{{ $errors->first('location') }}</span>
                        @endif
                    </div>
                </div>

                
                <div class="mb-3 row">
                    <label for="name" class="col-md-3 col-form-label text-md-end text-start">Operator</label>
                    <div class="col-md-9">
                        <select name="operator_name" id="operator_name" required class="form-control select2">
                        <option value="">Silahkan Pilih</option>
                            @foreach ($operators as $operator)
                                <option value="{{ $operator->name }}">{{ $operator->name }}</option>
                            @endforeach
                        </select>
                        
                    </div>
                </div>


                <div class="mb-3 row">
                    <label for="keterangan" class="col-md-3 col-form-label text-md-end text-start">Keterangan</label>
                    <div class="col-md-9">
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" rows="8" name="keterangan">{{ old('keterangan') }}</textarea>

                        @if ($errors->has('keterangan'))
                        <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                        @endif
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="permissions" class="col-md-3 col-form-label text-md-end text-start"></label>
                    <div class="col-md-6">
                        <a href="{{ route('units.index') }}" class="btn btn-warning btn-sm">Kembali</a>
                        <input type="submit" class="btn btn-primary btn-sm" value="Simpan">

                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection



@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    })
</script>
@endsection