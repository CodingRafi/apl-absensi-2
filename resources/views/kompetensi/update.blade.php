@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Update Kompetensi</h4>
        <form action="/kompetensi/{{ $kompetensi->id }}" method="POST">
            @csrf
            @method('patch')
            @include('mypartials.tahunajaran')
            <div class="mb-3">
                <label for="kompetensi" class="form-label">Kompetensi Keahlian</label>
                <input type="text" class="form-control" id="kompetensi" name="kompetensi" value="{{ $kompetensi->kompetensi }}">
            </div>
            <div class="mb-3">
                <label for="program" class="form-label">Program Keahlian</label>
                <input type="text" class="form-control" id="program" name="program" value="{{ $kompetensi->program }}">
            </div>
            <div class="mb-3">
                <label for="bidang" class="form-label">Bidang Keahlian</label>
                <input type="text" class="form-control" id="bidang" name="bidang" value="{{ $kompetensi->bidang }}">
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>
@endsection