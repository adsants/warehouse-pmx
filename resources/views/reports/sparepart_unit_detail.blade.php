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
        <div class="card-header d-flex">
            <h6>Data Transaksi Sparepart di Unit</h6>
        </div>
        <div class="card-body">
            
            <dl class="row">

                <dd class="col-sm-3">Hull Number</dd>
                <dt class="col-sm-9">{{$dataUnit->hull_number}}</dt>

                <dd class="col-sm-3">Part Number</dd>
                <dt class="col-sm-9">{{$dataUnit->type}} - {{$dataUnit->merk}} - {{$dataUnit->model}}</dt>

                <dd class="col-sm-3"></dd>
                <dt class="col-sm-9">
                    <br>
                    <a href="{{ route('reportSparepartUnit')}}" class="btn btn-warning btn-sm">Kembali</a>
                    <br>
                    <br>
                </dt>
            </dl>

            <div class="table-responsive mt-4">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th  width="2%" ></th>
                            <th width="10%">Tanggal</th>
                            <th width="25%">Sparepart</th>
                            <th width="5%">Qty</th>
                            <th width="10%">Satuan</th>
                            <th width="10%">Working Hour</th>
                            <th width="20%">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($listRows as $rowData)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $rowData->entry_date }}</td>
                            <td>{{ $rowData->part_number }} - {{ $rowData->sparepartName }}  </td>
                            <td>{{ $rowData->qty }}</td>
                            <td>{{ $rowData->satuan }}</td>
                            <td>{{ $rowData->working_hour }}</td>
                            <td>{{ $rowData->description }}</td>
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