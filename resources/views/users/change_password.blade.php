@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Ubah Data Password
                </div>
            </div>
            <div class="card-body">
            @include('layouts.partials.messages')
                <form action="{{ route('updatePassword', $user->id) }}" method="post">
                    @csrf
                    @method("PUT")


                    
                    <div class="mb-3 row">
                        <label for="name" class="col-md-3 col-form-label text-md-end text-start">Name</label>
                        <div class="col-md-6">
                          <input type="text" disabled class="form-control @error('name') is-invalid @enderror" id="name" name="" value="{{ $user->name }}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>

                    <span id="userPass">
                    <div class="mb-3 row">
                        <label for="email" class="col-md-3 col-form-label text-md-end text-start">Username</label>
                        <div class="col-md-6">
                          <input type="text" disabled class="form-control @error('email') is-invalid @enderror" id="email" name="" value="{{ $user->email }}">
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
                    </span>
                    
                <div class="mb-3 row">
                    <label for="permissions" class="col-md-3 col-form-label text-md-end text-start"></label>
                    <div class="col-md-6">
                        <a href="{{ route('index') }}" class="btn btn-warning btn-sm">Kembali</a>
                        <input type="submit" class="btn btn-primary btn-sm" value="Simpan">

                    </div>

                    
                </div>

                    
                </form>
            </div>
        </div>
    
</div>    

@endsection
