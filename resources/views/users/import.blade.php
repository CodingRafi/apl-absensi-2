@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 style="display: inline">Import</h4>
        <form action="/users/{{ $role }}" method="get" style="display: inline">
            @include('mypartials.tahunajaran')
            <button
                class="nav-link {{ Request::is('dashboard') ? 'active' : '' }} btn btn-sm btn-danger float-right text-white font-weight-bold"
                style="display: inline">Kembali</button>
        </form>
        @if (count($jedas) > 0)   
        <form action="/import/users/{{ $role }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('mypartials.tahunajaran')
            <div class="mb-3 mt-4">
                <label for="formFile" class="form-label">Pilih File</label>
                <input class="form-control" type="file" id="formFile" style="height: 37px" name="file" required>
            </div>
            <div class="mb-3 mt-4">
                <label for="formFile" class="form-label">Sesi</label>
                <select class="form-select @error('jeda_presensi_id') is-invalid @enderror" name="jeda_presensi_id" value="{{ old('jeda_presensi_id') }}" required>
                  @foreach ($jedas as $jeda)
                  <option value="{{ $jeda->id }}">{{ $jeda->nama }} ({{ explode(':', $jeda->jam_masuk)[0] }}:{{ explode(':', $jeda->jam_masuk)[1] }} sd {{ explode(':', $jeda->jam_pulang)[0] }}:{{ explode(':', $jeda->jam_pulang)[1] }})</option>
                  @endforeach
                </select>
                @error('jeda_presensi_id')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
            </div>
            <button class="btn btn-sm text-white font-weight-bold px-3" style="background-color: #3bae9c" type="submit">Import</button>
        </form>
        @else
        <div class="alert alert-warning d-flex align-items-center mt-4" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
          <div>
            Maaf jeda waktu belum di buat.
          </div>
        </div>  
        @endif
    </div>
</div>
@endsection