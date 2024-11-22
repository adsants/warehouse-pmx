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
                Form Sparepart Keluar
            </div>
        </div>
        <div class="card-body">
            
            @include('layouts.partials.messages')
            <form action="{{ route('locationSparepartOutInsert') }}" method="post">
                @csrf


                <div class="mb-3 row">
                    <label for="name" class="col-md-3 col-form-label text-md-end text-start">Dari Lokasi</label>
                    <div class="col-md-9">
                        
                        <select name="from_location_id" id="from_location_id" required class="form-control select2">
                            <option value="">Silahkan Pilih</option>
                            @foreach ($listOfLocations as $listOfLocation)
                                <option {{ ($locationId == $listOfLocation->id) ? "selected" : ""; }} value="{{ $listOfLocation->id }}">{{ $listOfLocation->name }}</option>
                            @endforeach
                        </select>
                        
                        @if ($errors->has('from_location_id'))
                        <span class="text-danger">{{ $errors->first('from_location_id') }}</span>
                        @endif
                    </div>
                </div>

                <?php
                if($locationId){
                ?>

                <div class="mb-3 row">
                    <label for="name" class="col-md-3 col-form-label text-md-end text-start">Sparepart</label>
                    <div class="col-md-9">
                        
                        <select name="sparepart_id" id="sparepart_id" required class="form-control select2">
                            <option value="">Silahkan Pilih</option>
                            @foreach ($listOfSpareparts as $listOfSparepart)
                                <option value="{{ $listOfSparepart->id }}"  mySatuan="{{ $listOfSparepart->satuan }}" myQty="{{ $listOfSparepart->stock }}">{{ $listOfSparepart->name }} - {{ $listOfSparepart->part_number }}</option>
                            @endforeach
                        </select>
                        
                        @if ($errors->has('sparepart_id'))
                        <span class="text-danger">{{ $errors->first('sparepart_id') }}</span>
                        @endif
                    </div>
                </div>


                <div class="mb-3 row">
                    <label for="name" class="col-md-3 col-form-label text-md-end text-start">Tujuan Lokasi</label>
                    <div class="col-md-9">
                        
                        <select name="to_location_id" id="to_location_id" required class="form-control select2">
                            <option value="">Silahkan Pilih</option>
                            @foreach ($listOfAllLocations as $listOfAllLocation)
                                <option value="{{ $listOfAllLocation->id }}">{{ $listOfAllLocation->name }}</option>
                            @endforeach
                        </select>
                        
                        @if ($errors->has('to_location_id'))
                        <span class="text-danger">{{ $errors->first('to_location_id') }}</span>
                        @endif
                    </div>
                </div>

                
                <div class="mb-3 row" style="display:none">
                    <label for="name" class="col-md-3 col-form-label text-md-end text-start" readonly>Tujuan Sparepart</label>
                    <div class="col-md-9">
                        
                        <select name="kategori" id="kategori" required class="form-control">
                            <option value="">Silahkan Pilih</option>
                            <option value="Dipakai">Dipakai</option>
                            <option selected value="Dikirim Ke Lokasi">Dikirim Ke Lokasi</option>
                        </select>
                        
                        @if ($errors->has('kategori'))
                        <span class="text-danger">{{ $errors->first('kategori') }}</span>
                        @endif
                    </div>
                </div>
                
                
                <span  id="spanUnits" style="display:none">
                <div class="mb-3 row">
                    <label for="name" class="col-md-3 col-form-label text-md-end text-start">Unit</label>
                    <div class="col-md-9">
                        
                        <select name="unit_id" id="unit_id" required class="form-control select2s">
                            <option value="">Silahkan Pilih </option>
                            @foreach ($listOfUnits as $listOfUnit)
                                <option value="{{ $listOfUnit->id }}">{{ $listOfUnit->hull_number }} - {{ $listOfUnit->type }} - {{ $listOfUnit->model }}</option>
                            @endforeach
                        </select>
                        
                        @if ($errors->has('unit_id'))
                        <span class="text-danger">{{ $errors->first('unit_id') }}</span>
                        @endif
                    </div>
                </div>
                
                <div class="mb-3 row">
                    <label for="working_hour" class="col-md-3 col-form-label text-md-end text-start">Hour Meter</label>
                    <div class="col-md-3">
                        <input type="number" class="form-control" id="working_hour" name="working_hour">

                        @if ($errors->has('working_hour'))
                        <span class="text-danger">{{ $errors->first('working_hour') }}</span>
                        @endif
                    </div>
                </div>
                </span>

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
                    <label for="description" class="col-md-3 col-form-label text-md-end text-start">Keterangan<br><sub>* jika diperlukan</sub></label>
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
                        <a href="{{ route('warehouseSparepartIn') }}" class="btn btn-warning btn-sm">Batal</a>
                        <input type="submit" class="btn btn-primary btn-sm" value="Simpan">

                    </div>
                </div>

                <?php
                }
                ?>

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
        var myStock = element.attr("myQty"); 

        var textStock = "Stok = "+myStock+" "+mySatuan;

        $('#satuanText').html(textStock);
        $('#qty').prop('max',myStock);
        $('#qty').focus();
    });

    $("#from_location_id").change(function(){         
        var locationId = $('#from_location_id').val();      
        location.href = '?locationId='+locationId;
    });

    $("#kategori").change(function(){  
        
        if($('#kategori').val() == 'Dipakai'){
            jikaDipakai();
        }
        else{
            jikaDikirim();
        }
    });

    function jikaDipakai(){
        $('#spanUnits').show();   
        $("#unit_id").attr("required", true);
        $("#working_hour").attr("required", true);
   
    }
    function jikaDikirim(){
        $('#spanUnits').hide();     
        $("#unit_id").val("");
        $("#unit_id").attr("required", false);
        $("#working_hour").attr("required", false);
        $("#working_hour").val("");

    }

    $("#to_location_id").change(function(){         
        var toLocationId    = $('#to_location_id').val();      
        var fromLocationId  = $('#from_location_id').val();      
        //alert(fromLocationId);
        if(toLocationId == fromLocationId){
            $('#kategori').val('Dipakai');
            jikaDipakai();
        }
        else{
            $('#kategori').val('Dikirim Ke Lokasi');
            jikaDikirim();
        }


    });

</script>
@endsection