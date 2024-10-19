@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <div class="float-start">
                Tambah Data User
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('users.store') }}" method="post">
                @csrf

                <div class="mb-3 row">
                    <label for="name" class="col-md-3 col-form-label text-md-end text-start">Name</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                        @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="email" class="col-md-3 col-form-label text-md-end text-start">Email Address</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="password" class="col-md-3 col-form-label text-md-end text-start">Password</label>
                    <div class="col-md-6">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                        @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="password_confirmation" class="col-md-3 col-form-label text-md-end text-start">Confirm Password</label>
                    <div class="col-md-6">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="roles" class="col-md-3 col-form-label text-md-end text-start">Kategori User</label>
                    <div class="col-md-9">
                        
                        <select class="form-select form-control @error('roles') is-invalid @enderror"  aria-label="Roles" id="roles" name="roles[]">
                            @forelse ($roles as $role)

                            @if ($role!='Super Admin')
                            <option value="{{ $role }}" {{ in_array($role, old('roles') ?? []) ? 'selected' : '' }}>
                                {{ $role }}
                            </option>
                            @else
                            @if (Auth::user()->hasRole('Super Admin'))
                            <option value="{{ $role }}" {{ in_array($role, old('roles') ?? []) ? 'selected' : '' }}>
                                {{ $role }}
                            </option>
                            @endif
                            @endif

                            @empty

                            @endforelse
                        </select>
                        @if ($errors->has('roles'))
                        <span class="text-danger">{{ $errors->first('roles') }}</span>
                        @endif
                    </div>
                </div>

                
                <div class="mb-3 row">
                    <label for="roles" class="col-md-3 col-form-label text-md-end text-start">Lokasi</label>
                    <div class="col-md-9">
                        <select class="form-select form-control @error('roles') is-invalid @enderror" multiple aria-label="Roles" id="location_id" name="location_id[]">
                            @forelse ($locations as $location)

                            <option value="{{ $location->id }}" {{ in_array($role, old('location_id') ?? []) ? 'selected' : '' }}>
                                {{ $location->name }}
                            </option>

                            @empty

                            @endforelse
                        </select>
                        @if ($errors->has('location_id'))
                        <span class="text-danger">{{ $errors->first('location_id') }}</span>
                        @endif
                    </div>
                </div>


                <div class="mb-3 row">
                    <label for="permissions" class="col-md-3 col-form-label text-md-end text-start"></label>
                    <div class="col-md-6">
                        <a href="{{ route('users.index') }}" class="btn btn-warning btn-sm">Kembali</a>
                        <input type="submit" class="btn btn-primary btn-sm" value="Simpan">

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection