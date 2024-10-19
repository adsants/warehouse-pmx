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
            <h6 class="m-0 font-weight-bold text-primary">Data Unit Sparepart</h6>
        </div>
        <div class="card-body">
            
            <div class="table-responsive mt-4">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th  width="5%" ></th>
                            <th width="20%">Hull Number</th>
                            <th width="30%">Type</th>
                            <th width="10%">Model</th>
                            <th width="10%">Merk</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($listRows as $rowData)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $rowData->hull_number }}</td>
                            <td>{{ $rowData->type }}</td>
                            <td>{{ $rowData->model }}</td>
                            <td>{{ $rowData->merk }}</td>
                            <td align="center">

                                    <a href="{{ route('reportSparepartUnit')}}?unitId={{$rowData->id}}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Detail</a>

                                    
                            </td>
                        </tr>
                        @empty
                        <td colspan="10" align="center">
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