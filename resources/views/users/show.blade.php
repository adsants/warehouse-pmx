@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="card">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Detail User
                </div>
            </div>
            <div class="card-body">

                <div class="mb-3 row">
                    <label for="name" class="col-md-3 col-form-label text-md-end text-start"><strong>Name:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $user->name }}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="email" class="col-md-3 col-form-label text-md-end text-start"><strong>Email Address:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $user->email }}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="roles" class="col-md-3 col-form-label text-md-end text-start"><strong>Roles:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        @forelse ($user->getRoleNames() as $role)
                        <span class="badge bg-primary">{{ $role }}</span>
                        @empty
                        @endforelse
                    </div>
                </div>

                
                <div class="mb-3 row">
                    <label for="permissions" class="col-md-3 col-form-label text-md-end text-start"></label>
                    <div class="col-md-6">
                        <a href="{{ route('users.index') }}" class="btn btn-warning btn-sm">Kembali</a>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection