@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Update Kelas</h4>
        <form action="/kelas/{{ $kelas->id }}" method="POST">
            @csrf
            @method('patch')
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Kelas</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $kelas->nama }}">
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>
@endsection