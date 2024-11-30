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
            <h6 class="m-0 font-weight-bold text-primary">Data Lokasi</h6>
        </div>
        <div class="card-body">
        @include('layouts.partials.messages')

            @can('create-locations')
            <a href="{{ route('locations.create') }}" class="btn btn-success btn-sm my-2 mb-4"><i class="bi bi-plus-circle"></i> Tambah Data</a>
            @endcan
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th  width="2%" ></th>
                            <th width="30%">Nama Lokasi</th>
                            <th width="20%">Keterangan</th>
                            <th width="10%">Tipe</th>
                            <th width="10%">Status Active</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rowDatas as $rowData)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $rowData->name }}</td>
                            <td>{{ $rowData->description }}</td>
                            <td>{{ $rowData->location_type }}</td>
                            <td>{{ $rowData->status_active }}</td>
                            <td align="center">
                                <form action="{{ route('locations.destroy', $rowData->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route('locations.show', $rowData->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Detail</a>

                                    
                                    @can('edit-locations')
                                    <a href="{{ route('locations.edit', $rowData->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Ubah</a>
                                    @endcan

                                    @can('delete-locations')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin akan menghapus Data Lokasi {{ $rowData->name }} ?');"><i class="bi bi-trash"></i> Hapus</button>
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