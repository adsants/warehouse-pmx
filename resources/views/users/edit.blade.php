@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Ubah Data User
                </div>
            </div>
            <div class="card-body">
            @include('layouts.partials.messages')
                <form action="{{ route('users.update', $user->id) }}" method="post">
                    @csrf
                    @method("PUT")

                    <div class="mb-3 row">
                        <label for="roles" class="col-md-3 col-form-label text-md-end text-start">Kategori User</label>
                        <div class="col-md-9">        
                            
                       
                            <?php
                            //var_dump($userRoles);
                            ?>

                            <select class="form-select form-control @error('roles') is-invalid @enderror"  aria-label="Roles" id="roles" name="roles[]">
                                @forelse ($roles as $role)

                                    {{$role}}

                                    @if ($role!='Super Admin')
                                    <option value="{{ $role }}" {{ in_array($role, $userRoles ?? []) ? 'selected' : '' }}>
                                        {{ $role }}
                                    </option>
                                    @else
                                        @if (Auth::user()->hasRole('Super Admin'))   
                                        <option value="{{ $role }}" {{ in_array($role, $userRoles ?? []) ? 'selected' : '' }}>
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
                        <label for="name" class="col-md-3 col-form-label text-md-end text-start">Name</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $user->name }}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>

                    <span id="userPass">
                    <div class="mb-3 row">
                        <label for="email" class="col-md-3 col-form-label text-md-end text-start">Username</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $user->email }}">
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
                        <label for="location_id" class="col-md-3 col-form-label text-md-end text-start">Lokasi</label>
                        <div class="col-md-9">         
                            <select class="form-select form-control @error('location_id') is-invalid @enderror" multiple aria-label="location_id" id="location_id" name="location_id[]">
                                @forelse ($locations as $location)                                

                                    <option value="{{ $location->id }}" {{ in_array($location->id, $userLocations ?? []) ? 'selected' : '' }}>
                                        {{ $location->name }}
                                    </option>

                                @empty

                                @endforelse
                            </select>
                            @if ($errors->has('roles'))
                                <span class="text-danger">{{ $errors->first('roles') }}</span>
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

@section('scripts')
<script>
    
    $("#roles").change(function(){ 
        if($("#roles").val() == 'Operator'){
            operator();
        }
        else{
            notOperator();
        }
    });

    function operator(){
        $('#userPass').hide();

        $('#email').val(Date.now());
        $('#password').val('12345678');
        $('#password_confirmation').val('12345678');
    }

    function notOperator(){
        $('#userPass').show();
        $('#email').val('');
        $('#password').val('');
        $('#password_confirmation').val('');

    }


    <?php          
    $roleSaatIni = "";
    foreach($userRoles as $userRole){
        $roleSaatIni .=  $userRole;
    }
    if($roleSaatIni == 'Operator'){
        echo "operator();";
    }
    ?>

</script>
@endsection