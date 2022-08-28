@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Create Kelas</h4>
        <form action="/kelas" method="POST">
            @csrf
            @include('mypartials.tahunajaran')
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Kelas</label>
                <input type="text" class="form-control" id="nama" name="nama">
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>
@endsection