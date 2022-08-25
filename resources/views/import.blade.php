@extends('mylayouts.main')

@section('container')
    <div class="card">
        <div class="card-body">
            <h4 style="display: inline">Import</h4>
            <form action="/" method="get" style="display: inline">
                @if (request('tahun_awal'))
                <input type="hidden" name="tahun_awal" value="{{ request('tahun_awal') }}">
                @endif
                @if (request('tahun_akhir'))
                <input type="hidden" name="tahun_akhir" value="{{ request('tahun_akhir') }}">
                @endif
                @if (request('semester'))
                <input type="hidden" name="semester" value="{{ request('semester') }}">
                @endif
                <button class="nav-link {{ Request::is('dashboard') ? 'active' : '' }} btn btn-sm btn-danger float-right text-white font-weight-bold" style="display: inline">Kembali</button>
            </form>
            <div class="mb-3 mt-4">
                <label for="formFile" class="form-label">Pilih File</label>
                <input class="form-control" type="file" id="formFile" style="height: 37px">
            </div>
            <button class="btn btn-sm text-white font-weight-bold px-3" style="background-color: #3bae9c">Import</button>
        </div>
    </div>
@endsection