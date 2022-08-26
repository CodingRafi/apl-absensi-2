@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Create Kelas</h4>
        <form action="/kelas" method="POST">
            @csrf
            @if (request('tahun_awal'))
                <input type="hidden" name="tahun_awal" value="{{ request('tahun_awal') }}">
            @endif
            @if (request('tahun_akhir'))
                <input type="hidden" name="tahun_akhir" value="{{ request('tahun_akhir') }}">
            @endif
            @if (request('semester'))
                <input type="hidden" name="semester" value="{{ request('semester') }}">
            @endif
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Kelas</label>
                <input type="text" class="form-control" id="nama" name="nama">
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>
@endsection