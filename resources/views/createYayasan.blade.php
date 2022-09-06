@extends('mylayouts.main')

@section('container')
    <div class="card">
        <div class="card-body">
            <div class="title" style="display: flex; justify-content: space-between">
                <h4 style="color: #3bae9c">Create Yayasan</h4>
                <form action="/" method="GET">
                    @include('mypartials.tahunajaran')
                    <button class="btn btn-sm btn-danger font-weight-bold" style="min-width: 5rem;">Kembali</button>
                </form>
            </div>
            <form action="/create-yayasan" method="post">
                @csrf
                <div class="mb-3 mt-3">
                    <label for="">Nama Yayasan</label>
                    <input type="text" class="form-control" name="name" id="nama" placeholder="Masukan nama yayasan">
                </div>
                <div class="mb-3">
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Masukan email yayasan">
                </div>
                <div class="mb-3">
                    <label for="">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                </div>
                <div class="mb-3">
                    <label for="">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                </div>
                <button class="btn text-white" style="background-color: #3bae9c">Simpan</button>
            </form>
        </div>
    </div>


@endsection