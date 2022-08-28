@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 style="display: inline">Import</h4>
        <form action="/users/{{ $role }}" method="get" style="display: inline">
            @include('mypartials.tahunajaran')
            <button
                class="nav-link {{ Request::is('dashboard') ? 'active' : '' }} btn btn-sm btn-danger float-right text-white font-weight-bold"
                style="display: inline">Kembali</button>
        </form>
        <form action="/import/users/{{ $role }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('mypartials.tahunajaran')
            <div class="mb-3 mt-4">
                <label for="formFile" class="form-label">Pilih File</label>
                <input class="form-control" type="file" id="formFile" style="height: 37px" name="file" required>
            </div>
            <button class="btn btn-sm text-white font-weight-bold px-3" style="background-color: #3bae9c" type="submit">Import</button>
        </form>
    </div>
</div>
@endsection