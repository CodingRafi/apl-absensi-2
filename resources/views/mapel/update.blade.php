@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Update Mata Pelajaran</h4>
        <form action="/mapel/{{ $mapel->id }}" method="POST">
            @csrf
            @method('patch')
            @include('mypartials.tahunajaran')
            <div class="mb-3">
                <label for="nama" class="form-label">Mata Pelajaran</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $mapel->nama }}">
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>
@endsection