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
            <h6 class="m-0 font-weight-bold text-primary">Data Stok All Sparepart</h6>
        </div>
        <div class="card-body">
            
            <div class="table-responsive mt-4">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th  width="5%" ></th>
                            <th width="20%">Lokasi</th>
                            <th width="10%">Part Number</th>
                            <th width="30%">Nama Sparepart</th>
                            <th width="10%">Stok</th>
                            <th width="10%">Satuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($listRows as $rowData)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $rowData->locationName }}</td>
                            <td>{{ $rowData->part_number }}</td>
                            <td>{{ $rowData->name }}</td>
                            <td>{{ $rowData->stock }}</td>
                            <td>{{ $rowData->satuan }}</td>
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