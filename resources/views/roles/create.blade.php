@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <div class="float-start">
                Tambah Data Kategori User
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('roles.store') }}" method="post">
                @csrf

                <div class="mb-3 row">
                    <label for="name" class="col-md-3 col-form-label text-md-end text-start">Nama Kategori User</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                        @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="permissions" class="col-md-3 col-form-label text-md-end text-start">Permissions</label>
                    <div class="col-md-8">
                        <select class="form-select form-control @error('permissions') is-invalid @enderror" multiple aria-label="Permissions" id="permissions" name="permissions[]" style="height: 210px;">
                            @forelse ($permissions as $permission)
                            <option value="{{ $permission->id }}" {{ in_array($permission->id, old('permissions') ?? []) ? 'selected' : '' }}>
                                {{ $permission->name }}
                            </option>
                            @empty

                            @endforelse
                        </select>
                        @if ($errors->has('permissions'))
                        <span class="text-danger">{{ $errors->first('permissions') }}</span>
                        @endif
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="permissions" class="col-md-3 col-form-label text-md-end text-start"></label>
                    <div class="col-md-6">
                        <a href="{{ route('roles.index') }}" class="btn btn-warning btn-sm">Kembali</a>
                        <input type="submit" class="btn btn-primary btn-sm" value="Simpan">

                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection