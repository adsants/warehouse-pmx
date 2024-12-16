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
            <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
        </div>
        <div class="card-body">
        @include('layouts.partials.messages')

            @can('create-user')
            <a href="{{ route('users.create') }}" class="btn btn-success btn-sm my-2 mb-4"><i class="bi bi-plus-circle"></i> Tambah Data</a>
            &nbsp;
            &nbsp;
            
            <a href="/export-user" class="btn btn-primary btn-sm my-2 mb-4"><i class="bi bi-print"></i> Export Excel</a>
            @endcan
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Nama</th>
                            <th scope="col">Username</th>
                            <th scope="col">Kategori User</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @forelse ($user->getRoleNames() as $role)
                                <span class="badge bg-primary">{{ $role }}</span>
                                @empty
                                @endforelse
                            </td>
                            <td align="center">
                                <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Detail</a>

                                    @if (in_array('Super Admin', $user->getRoleNames()->toArray() ?? []) )
                                    @if (Auth::user()->hasRole('Super Admin'))
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Ubah</a>
                                    @endif
                                    @else
                                    @can('edit-user')
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Ubah</a>
                                    @endcan

                                    @can('delete-user')
                                    @if (Auth::user()->id!=$user->id)
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this user?');"><i class="bi bi-trash"></i> Hapus</button>
                                    @endif
                                    @endcan
                                    @endif

                                </form>
                            </td>
                        </tr>
                        @empty
                        <td colspan="5">
                            <span class="text-danger">
                                <strong>No User Found!</strong>
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