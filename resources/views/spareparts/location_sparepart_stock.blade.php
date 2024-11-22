@extends('layouts.app')

@section('title')
{{ __('Warehouse App') }}
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('content')

<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Data Stok Sparepart</h6>
        </div>
        <div class="card-body">
            
            
            <div class="mb-3 row">
                <label for="name" class="col-md-3 col-form-label text-md-end text-start">Location</label>
                <div class="col-md-7">
                    
                    <select name="location_id" id="location_id" required class="form-control select2">
                        <option value="">Silahkan Pilih</option>
                        @foreach ($listOfLocations as $listOfAllLocation)
                            <option {{$locationId == $listOfAllLocation->id ? "selected" : "";}} value="{{ $listOfAllLocation->id }}">{{ $listOfAllLocation->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <br>
            
            @if($locationId>0)
            <a href="/stock-location-spareparts/export-excel?locationId={{$locationId}}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Export Excel</a>
            @endif


            <div class="table-responsive mt-4">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th  width="2%" ></th>
                            <th width="20%">Part Number</th>
                            <th width="30%">Nama Sparepart</th>
                            <th width="20%">Stok</th>
                            <th width="20%">Satuan</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($listRows as $rowData)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $rowData->part_number }}</td>
                            <td>{{ $rowData->name }}</td>
                            <td>{{ $rowData->stock }}</td>
                            <td>{{ $rowData->satuan }}</td>
                            <td align="center">

                                    <a href="{{ route('locationSparepartStock')}}?locationId={{$locationId}}&sparepartId={{$rowData->sparepartId}}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Detail</a>

                                    
                            </td>
                        </tr>
                        @empty
                        <td colspan="10">
                            <span class="text-danger">
                                <strong>Tidak ada Data !</strong>
                            </span>
                        </td>
                        @endforelse
                    </tbody>
                </table>


            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')



<script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>

<script>

<?php
    if($redirectLocation != '' ){
    ?>
        location.href = '?locationId='+<?php echo $redirectLocation;?>;
    <?php
    }
    ?>
$("#location_id").change(function(){ 
    var locationId = $('#location_id').val();
    location.href = '?locationId='+locationId;
});
</script>
@endsection