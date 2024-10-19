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
            <h6 class="m-0 font-weight-bold text-primary">Terima Sparepart</h6>
        </div>
        <div class="card-body">
            
            
            <div class="mb-3 row">
                <label for="name" class="col-md-3 col-form-label text-md-end text-start">Lokasi Kerja</label>
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
            <div class="table-responsive mt-4">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th  width="5%" ></th>
                            <th width="20%">Part Number</th>
                            <th width="30%">Nama Sparepart</th>
                            <th width="10%">Qty</th>
                            <th width="20%">Satuan</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dataSparepartIns as $rowData)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $rowData->part_number }}</td>
                            <td>{{ $rowData->sparepartName }}</td>
                            <td>{{ $rowData->qty }}</td>
                            <td>{{ $rowData->satuan }}</td>
                            <td align="center">
                                <a href="{{ route('locationSparepartInInInsert')}}?id={{$rowData->id}}" class="btn btn-success btn-sm" onclick="return confirm('Anda yakin akan menerima Sparepart {{ $rowData->sparepartName }}  ?');">Terima</a>                                    
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

$("#location_id").change(function(){ 
    var locationId = $('#location_id').val();
    location.href = '?locationId='+locationId;
});
</script>
@endsection