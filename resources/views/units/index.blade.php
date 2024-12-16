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
            <h6 class="m-0 font-weight-bold text-primary">Data Unit</h6>
        </div>
        <div class="card-body">
            @include('layouts.partials.messages')

            @can('create-unit')
            <a href="{{ route('units.create') }}" class="btn btn-success btn-sm my-2 mb-4"><i class="bi bi-plus-circle"></i> Tambah Data</a>
            &nbsp;
            &nbsp;
            
            <a href="/export-unit" class="btn btn-primary btn-sm my-2 mb-4"><i class="bi bi-print"></i> Export Excel</a>
            @endcan
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th width="10%">{{ __('Hull Number') }}</th>
                            <th width="5%">{{ __('Type') }}</th>
                            <th width="5%">{{ __('Model') }}</th>
                            <th width="10%">{{ __('Merk') }}</th>
                            <th width="10%">{{ __('S/N') }}</th>
                            <th width="10%">{{ __('Detail') }}</th>
                            <th width="20%">{{ __('Keterangan') }}</th>
                            <th width="20%"scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rowDatas as $rowData)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $rowData->hull_number }}</td>
                            <td>{{ $rowData->type }}</td>
                            <td>{{ $rowData->model }}</td>
                            <td>{{ $rowData->merk }}</td>
                            <td>{{ $rowData->sn }}</td> 
                            <td>
                                {{ $rowData->operator_name }}
                                <br>
                                {{ $rowData->location_name }}
                            </td> 
                            <td>{{ $rowData->keterangan }}</td> 
                            <td align="center">
                                <form action="{{ route('units.destroy', $rowData->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route('units.show', $rowData->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Detail</a>

                                    
                                    @can('edit-unit')
                                    <a href="{{ route('units.edit', $rowData->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Ubah</a>
                                    @endcan

                                    @can('delete-unit')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this unit?');"><i class="bi bi-trash"></i> Hapus</button>
                                  
                                    @endcan

                                </form>
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
@endsection