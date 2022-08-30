@extends('mylayouts.main')

@section('container')
<div class="card">
  <div class="card-body">
    <h4 class="card-title float-left">Create Data Siswa</h4>
    <form action="/siswa" method="get">
      @include('mypartials.tahunajaran')
      <button class="btn btn-sm btn-danger font-weight-bold float-right text-white" type="submit">Kembali</button>
    </form>
    @if (count($classes)>0 && count($kompetensis)>0)
    <form class="mt-5" action="/siswa" method="POST">
      @csrf
      @include('mypartials.tahunajaran')
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan Nama" name="name" value="{{ old('name') }}" required>
        @error('name')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">NISN</label>
        <input type="number" class="form-control @error('nisn') is-invalid @enderror" placeholder="Masukan NISN" name="nisn" value="{{old('nisn')}}" required>
        @error('nisn')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">NIPD</label>
        <input type="number" class="form-control @error('nipd') is-invalid @enderror" placeholder="Masukan NIPD" name="nipd" value="{{ old('nipd') }}" required>
        @error('nipd')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">NIK</label>
        <input type="number" class="form-control @error('nik') is-invalid @enderror" placeholder="Masukan NIK" name="nik" value="{{ old('nik') }}" required>
        @error('nik')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Tempat Lahir</label>
        <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" placeholder="Masukan Tempat Lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
        @error('tempat_lahir')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Tanggal Lahir</label>
        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" placeholder="Masukan Tanggal Lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
        @error('tanggal_lahir')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Agama</label>
        <input type="text" class="form-control @error('agama') is-invalid @enderror" placeholder="Masukan Agama" name="agama" value="{{ old('agama') }}" required>
        @error('agama')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Jenis Kelamin</label>
        <select class="form-control @error('jk') is-invalid @enderror" aria-label="Default select example" name="jk" value="{{ old('jk') }}" required>
          <option value="L">Laki-laki</option>
          <option value="P">Perempuan</option>
        </select>
        @error('jk')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3 mt-4">
        <label for="formFile" class="form-label">Kelas</label>
        <select class="form-select @error('kelas_id') is-invalid @enderror" name="kelas_id" value="{{ old('kelas_id') }}" required>
          @foreach ($classes as $kelas)
          <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
          @endforeach
        </select>
        @error('kelas_id')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3 mt-4">
        <label for="formFile" class="form-label">Jurusan</label>
        <select class="form-select @error('kompetensi_id') is-invalid @enderror" name="kompetensi_id" value="{{ old('kompetensi_id') }}" required>
          @foreach ($kompetensis as $kompetensi)
          <option value="{{ $kompetensi->id }}">{{ $kompetensi->kompetensi }}</option>
          @endforeach
        </select>
        @error('kompetensi_id')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Jalan</label>
        <input type="text" class="form-control @error('jalan') is-invalid @enderror" placeholder="Masukan Jalan" name="jalan" value="{{ old('jalan') }}" required>
        @error('jalan')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Kelurahan</label>
        <input type="text" class="form-control @error('kelurahan') is-invalid @enderror" placeholder="Masukan Kelurahan" name="kelurahan" value="{{ old('kelurahan') }}" required>
        @error('kelurahan')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Kecamatan</label>
        <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" placeholder="Masukan Kecamatan" name="kecamatan" value="{{ old('kecamatan') }}" required>
        @error('kecamatan')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Rfid</label>
        <input type="text" class="form-control @error('rfid') is-invalid @enderror" placeholder="Masukan Rfid" name="rfid" value="{{ old('rfid') }}" required>
        @error('rfid')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="">
        <label for="exampleInputEmail1" class="form-label">Status Rfid</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status_rfid" id="aktif" value="on">
        <label class="form-check-label" for="aktif" style="margin-left: -0.1rem">
          Aktif
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status_rfid" id="tidak" value="tidak">
        <label class="form-check-label" for="tidak" style="margin-left: -0.1rem">
          Tidak
        </label>
      </div>
      <button type="submit" class="btn text-white mt-3" style="background-color: #3bae9c">Simpan</button>
    </form>
    @else
    <div class="alert alert-success d-flex mt-5" role="alert">
      <div>
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/>
        </svg>
      </div>
      <div>Data kelas atau data kompetensi belum tersedia, silahkan input data kelas pada laman "Kelas". Dan silahkan input data kompetensi pada laman "kompetensi".</div>
  </div>
  @endif
  </div>
</div>
@endsection