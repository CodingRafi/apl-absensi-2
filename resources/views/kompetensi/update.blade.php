@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Update Kompetensi</h4>
        <form action="{{ route('kompetensi.update', [$kompetensi->id]) }}" method="POST">
            @csrf
            @method('patch')
            @include('mypartials.tahunajaran')
            <div class="mb-3">
                <label for="kompetensi" class="form-label">Kompetensi Keahlian</label>
                <input type="text" class="form-control" id="kompetensi" name="kompetensi" value="{{ $kompetensi->kompetensi }}" style=" font-size: 15px; height: 6.5vh;">
            </div>
            <div class="mb-3">
                <label for="program" class="form-label">Program Keahlian</label>
                <input type="text" class="form-control" id="program" name="program" value="{{ $kompetensi->program }}" style=" font-size: 15px; height: 6.5vh;">
            </div>
            <div class="mb-3">
                <label for="bidang" class="form-label">Bidang Keahlian</label>
                <input type="text" class="form-control" id="bidang" name="bidang" value="{{ $kompetensi->bidang }}" style=" font-size: 15px; height: 6.5vh;">
            </div>
            <button type="submit" class="btn text-white" style="background-color: #3bae9c">Simpan</button>
        </form>
    </div>
</div>
@endsection