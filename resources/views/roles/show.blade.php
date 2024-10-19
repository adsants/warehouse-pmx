@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <div class="float-start">
                Detail Kategori User
            </div>
        </div>
        <div class="card-body">

            <div class="mb-3 row">
                <label for="name" class="col-md-3 col-form-label text-md-end text-start"><strong>Nama Kategori User</strong></label>
                <div class="col-md-6" style="line-height: 35px;">
                    {{ $role->name }}
                </div>
            </div>

            <div class="mb-3 row">
                <label for="roles" class="col-md-3 col-form-label text-md-end text-start"><strong>Permissions:</strong></label>
                <div class="col-md-6" style="line-height: 35px;">
                    @if ($role->name=='Super Admin')
                    <span class="badge bg-primary">All</span>
                    @else
                    @forelse ($rolePermissions as $permission)
                    <span class="badge bg-primary">{{ $permission->name }}</span>
                    @empty
                    @endforelse
                    @endif
                </div>
            </div>
            
            <div class="mb-3 row">
                    <label for="permissions" class="col-md-3 col-form-label text-md-end text-start"></label>
                    <div class="col-md-6">
                        <a href="{{ route('roles.index') }}" class="btn btn-warning btn-sm">Kembali</a>

                    </div>
                </div>
        </div>
    </div>
</div>
@endsection