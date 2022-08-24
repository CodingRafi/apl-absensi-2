@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Create Kompetensi</h4>
        <form action="/kompetensi" method="POST">
            @csrf
            <div class="mb-3">
                <label for="kompetensi" class="form-label">Kompetensi Keahlian</label>
                <input type="text" class="form-control" id="kompetensi" name="kompetensi">
            </div>
            <div class="mb-3">
                <label for="program" class="form-label">Program Keahlian</label>
                <input type="text" class="form-control" id="program" name="program">
            </div>
            <div class="mb-3">
                <label for="bidang" class="form-label">Bidang Keahlian</label>
                <input type="text" class="form-control" id="bidang" name="bidang">
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>
@endsection