@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Update Kelas</h4>
        <form action="{{ route('kelas.update', [$kelas->id]) }}}}" method="POST">
            @csrf
            @method('patch')
            @include('mypartials.tahunajaran')
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Kelas</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $kelas->nama }}" style=" font-size: 15px; height: 6.5vh;">
            </div>
            <button type="submit" class="btn text-white" style="background-color: #3bae9c">Simpan</button>
        </form>
    </div>
</div>
@endsection