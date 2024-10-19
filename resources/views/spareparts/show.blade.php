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
                Detail Sparepart
            </div>
        </div>
        <div class="card-body">

            <div class="mb-3 row">
                <label for="name" class="col-md-3 col-form-label text-md-end text-start"><strong>Nama Saprepart</strong></label>
                <div class="col-md-6" style="line-height: 35px;">
                    {{ $rowData->name }}
                </div>
            </div>
            <div class="mb-3 row">
                <label for="name" class="col-md-3 col-form-label text-md-end text-start"><strong>Part Number</strong></label>
                <div class="col-md-6" style="line-height: 35px;">
                    {{ $rowData->part_number }}
                </div>
            </div>
            <div class="mb-3 row">
                <label for="name" class="col-md-3 col-form-label text-md-end text-start"><strong>Satuan</strong></label>
                <div class="col-md-6" style="line-height: 35px;">
                    {{ $rowData->satuan }}
                </div>
            </div>



            <div class="mb-3 row">
                <label for="permissions" class="col-md-3 col-form-label text-md-end text-start"></label>
                <div class="col-md-6">
                    <a href="{{ route('spareparts.index') }}" class="btn btn-warning btn-sm">Kembali</a>

                    <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add Unit
                    </button>
                </div>
            </div>


            <div class="mb-3 mt-3 row">
                <div class="col-md-12">
                    
                    @include('layouts.partials.messages')
                    <hr>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="bg-light text-capitalize">
                            <tr>
                                <th width="5%"></th>
                                <th width="35%">{{ __('Merk') }}</th>
                                <th width="20%">{{ __('Model') }}</th>
                                <th width="20%">{{ __('type') }}</th>
                                <th width="15%">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($AllUnitData as $row)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $row->merk }}</td>
                                <td>{{ $row->model }}</td>
                                <td>{{ $row->type }}</td>
                                <td>
                                    @can('edit-sparepart')
                                    <a class="btn btn-danger btn-sm text-white " href="javascript:void(0);"
                                        onclick="event.preventDefault(); if(confirm('Are you sure you want to delete?')) { document.getElementById('delete-form-detail-{{ $row->id }}').submit(); }">
                                        {{ __('Delete') }}
                                    </a>

                                    <form id="delete-form-detail-{{ $row->id }}" action="{{ route('sparepartsDeleteDetail', $row->id) }}" method="POST" style="display: none;">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                    @endcan

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <form action="{{ route('sparepartsCreateDetail')  }}" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Add Unit</h5>
                </div>

                <div class="modal-body">

                    @csrf
                    <input type="hidden" name="sparepart_id" value="{{$rowData->id}}">


                    <div class="mb-3 row">
                        <label for="name" class="col-md-3 col-form-label text-md-end text-start"><strong>Pilih Unit</strong></label>
                        <div class="col-md-9" style="line-height: 35px;">
                            <select name="merk_model" required id="merk_model" class="form-control ">

                                <option value="">Please Select</option>
                                @foreach ($listOfVehicle as $row2)
                                <option value="{{$row2->merk}}|-|{{$row2->model}}|-|{{$row2->type}}">{{$row2->type}} - {{$row2->merk}} - {{$row2->model}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>




                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">
                        Close
                    </button>

                    <button type="submit" class=" btn btn-success">
                        Save
                    </button>
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