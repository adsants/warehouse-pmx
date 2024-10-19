@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <div class="float-start">
                Tambah Data Lokasi
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('locations.store') }}" method="post">
                @csrf

                <div class="mb-3 row">
                    <label for="name" class="col-md-3 col-form-label text-md-end text-start">Nama Lokasi</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">

                        @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="description" class="col-md-3 col-form-label text-md-end text-start">Keterangan</label>
                    <div class="col-md-9">
                        <textarea type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>

                        @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                    </div>
                </div>


                <div class="mb-3 row">
                    <label for="name" class="col-md-3 col-form-label text-md-end text-start">Tipe</label>
                    <div class="col-md-5">

                        <select name="location_type" required id="location_type" class="form-control ">
                            <option value="">Please Select</option>
                            <option value="Warehouse">Warehouse</option>
                            <option value="Work Location">Work Location</option>
                        </select>
                        @if ($errors->has('location_type'))
                        <span class="text-danger">{{ $errors->first('location_type') }}</span>
                        @endif
                    </div>
                </div>


                <div class="mb-3 row">
                    <label for="name" class="col-md-3 col-form-label text-md-end text-start">Status</label>
                    <div class="col-md-5">

                        <select name="status_active" required id="status_active" class="form-control ">
                            <option value="">Please Select</option>
                            <option value="Active">Active</option>
                            <option value="Non Active">Non Active</option>
                        </select>
                        @if ($errors->has('status_active'))
                        <span class="text-danger">{{ $errors->first('status_active') }}</span>
                        @endif
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="permissions" class="col-md-3 col-form-label text-md-end text-start"></label>
                    <div class="col-md-6">
                        <a href="{{ route('locations.index') }}" class="btn btn-warning btn-sm">Kembali</a>
                        <input type="submit" class="btn btn-primary btn-sm" value="Simpan">

                    </div>
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