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
                Form Beli Sparepart
            </div>
        </div>
        <div class="card-body">
            
            @include('layouts.partials.messages')
            <form action="{{route('locationSparepartBuyInsert')}}" method="post">
                @csrf


                <div class="mb-3 row">
                    <label for="name" class="col-md-3 col-form-label text-md-end text-start">Lokasi</label>
                    <div class="col-md-9">
                        
                        <select name="location_id" id="location_id" required class="form-control select2">
                            <option value="">Silahkan Pilih</option>
                            @foreach ($listOfLocations as $listOfLocation)
                                <option {{ ($locationId == $listOfLocation->id) ? "selected" : ""; }} value="{{ $listOfLocation->id }}">{{ $listOfLocation->name }}</option>
                            @endforeach
                        </select>
                        
                        @if ($errors->has('location_id'))
                        <span class="text-danger">{{ $errors->first('location_id') }}</span>
                        @endif
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="name" class="col-md-3 col-form-label text-md-end text-start">Sparepart</label>
                    <div class="col-md-9">
                        
                        <select name="sparepart_id" id="sparepart_id" required class="form-control select2">
                            <option value="">Silahkan Pilih</option>
                            @foreach ($listOfSpareparts as $listOfSparepart)
                                <option value="{{ $listOfSparepart->id }}"  mySatuan="{{ $listOfSparepart->satuan }}" mySatuan="{{ $listOfSparepart->satuan }}">{{ $listOfSparepart->name }} - {{ $listOfSparepart->part_number }}</option>
                            @endforeach
                        </select>
                        
                        @if ($errors->has('sparepart_id'))
                        <span class="text-danger">{{ $errors->first('sparepart_id') }}</span>
                        @endif
                    </div>
                </div>

                
                <div class="mb-3 row">
                    <label for="qty" class="col-md-3 col-form-label text-md-end text-start">Qty                     </label>
                    <div class="col-md-3">
                        <input type="number" class="form-control @error('qty') is-invalid @enderror" id="qty" name="qty" value="{{ old('qty') }}">

                        @if ($errors->has('qty'))
                        <span class="text-danger">{{ $errors->first('qty') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6" id="satuanText">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="entry_date" class="col-md-3 col-form-label text-md-end text-start">Tanggal Transaksi</label>
                    <div class="col-md-3">
                        <input type="date" class="form-control @error('entry_date') is-invalid @enderror" id="entry_date" name="entry_date" value="{{ date('Y-m-d') }}">

                        @if ($errors->has('entry_date'))
                        <span class="text-danger">{{ $errors->first('entry_date') }}</span>
                        @endif
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="description" class="col-md-3 col-form-label text-md-end text-start">Keterangan<br><sup>* jika diperlukan</sup></label>
                    <div class="col-md-9">
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>

                        @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                    </div>
                </div>


                <div class="mb-3 row">
                    <label for="permissions" class="col-md-3 col-form-label text-md-end text-start"></label>
                    <div class="col-md-6">
                        <a href="{{ route('locationSparepartBuy') }}" class="btn btn-warning btn-sm">Batal</a>
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

        
        <?php
        if($redirectLocation != '' ){
        ?>
            location.href = '?locationId='+<?php echo $redirectLocation;?>;
        <?php
        }
        ?>
    })

    $("#sparepart_id").change(function(){ 
        var element = $(this).find('option:selected'); 
        var mySatuan = element.attr("mySatuan"); 

        $('#satuanText').html(mySatuan);
        $('#qty').focus();
    });
</script>
@endsection