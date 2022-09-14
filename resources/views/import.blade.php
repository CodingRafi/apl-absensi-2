@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 style="display: inline">Import</h4>
        <form action="/siswa" method="get" style="display: inline">
            @if (request('tahun_awal'))
            <input type="hidden" name="tahun_awal" value="{{ request('tahun_awal') }}">
            @endif
            @if (request('tahun_akhir'))
            <input type="hidden" name="tahun_akhir" value="{{ request('tahun_akhir') }}">
            @endif
            @if (request('semester'))
            <input type="hidden" name="semester" value="{{ request('semester') }}">
            @endif
            <button
                class="nav-link {{ Request::is('dashboard') ? 'active' : '' }} btn btn-sm btn-danger float-right text-white font-weight-bold"
                style="display: inline">Kembali</button>
        </form>
        @if (count($classes) > 0 && count($kompetensis) > 0)
        <form action="/import" method="post" enctype="multipart/form-data">
            @csrf
            @include('mypartials.tahunajaran')
            <div class="mb-3 mt-4">
                <label for="formFile" class="form-label">Pilih File</label>
                <input class="form-control" type="file" id="formFile" style="height: 37px" name="file">
            </div>
            <div class="mb-3 mt-4">
              <label for="exampleInputEmail1" class="form-label">Password</label>
              <input type="text" class="form-control" name="password" value="*123456*" style="height: 37px;" disabled required>
            </div>
            <div class="mb-3 mt-4">
                <label for="formFile" class="form-label">Kelas</label>
                <select class="form-select" name="kelas_id">
                    @foreach ($classes as $kelas)
                        <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                    @endforeach
                </select>
            </div>
            @if ( Auth::user()->sekolah->tingkat == 'smk' )     
            <div class="mb-3 mt-4">
                <label for="formFile" class="form-label">Jurusan</label>
                <select class="form-select" name="kompetensi_id">
                    @foreach ($kompetensis as $kompetensi)
                        <option value="{{ $kompetensi->id }}">{{ $kompetensi->kompetensi }}</option>
                    @endforeach
                </select>
            </div>
            @endif
            <div class="mb-3 mt-4">
                <label for="formFile" class="form-label">Sesi</label>
                <select class="form-select @error('jeda_presensi_id') is-invalid @enderror" name="jeda_presensi_id" value="{{ old('jeda_presensi_id') }}" required>
                  @foreach ($jedas as $jeda)
                  <option value="{{ $jeda->id }}">{{ $jeda->nama }}</option>
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
              Maaf jurusan / kelas belum di buat.
            </div>
          </div>
        @endif
    </div>
</div>
@endsection