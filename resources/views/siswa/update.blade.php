@extends('mylayouts.main')

@section('container')
<div class="card">
  <div class="card-body">
    <h4 class="card-title float-left">Update Data Siswa</h4>
    <form action="/siswa" method="get">
      @include('mypartials.tahunajaran')
      <button class="btn btn-sm btn-danger font-weight-bold float-right text-white" type="submit">Kembali</button>
    </form>
    <form class="mt-5" action="/siswa/{{ $siswa->id }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('patch')
      @include('mypartials.tahunajaran')
      <div class="mb-3">
        <label for="profil" class="form-label">Profil</label>
        <input type="file" class="form-control @error('profil') is-invalid @enderror" name="profil">
        @error('profil')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control" placeholder="Masukan Nama" name="name" value="{{ $siswa->name }}">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">NISN</label>
        <input type="number" class="form-control" placeholder="Masukan NISN" name="nisn" value="{{ $siswa->nisn }}">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">NIPD</label>
        <input type="number" class="form-control" placeholder="Masukan NIPD" name="nipd" value="{{ $siswa->nipd }}">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">NIK</label>
        <input type="number" class="form-control" placeholder="Masukan NIK" name="nik" value="{{ $siswa->nik }}">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Tempat Lahir</label>
        <input type="text" class="form-control" placeholder="Masukan Tempat Lahir" name="tempat_lahir"
          value="{{ $siswa->tempat_lahir }}">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Tanggal Lahir</label>
        <input type="date" class="form-control" placeholder="Masukan Tanggal Lahir" name="tanggal_lahir"
          value="{{ $siswa->tanggal_lahir }}">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Agama</label>
        <input type="text" class="form-control" placeholder="Masukan Agama" name="agama" value="{{ $siswa->agama }}">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Jenis Kelamin</label>
        <select class="form-control" aria-label="Default select example" name="jk">
          <option value="L" {{ ($siswa->jk == 'L') ? 'selected' : ''}}>Laki-laki</option>
          <option value="P" {{ ($siswa->jk == 'P') ? 'selected' : ''}}>Perempuan</option>
        </select>
      </div>
      <div class="mb-3 mt-4">
        <label for="formFile" class="form-label">Kelas</label>
        <select class="form-select" name="kelas_id">
          @foreach ($classes as $kelas)
          @if ($kelas->id == $siswa->kelas_id)
          <option value="{{ $kelas->id }}" selected>{{ $kelas->nama }}</option>
          @else
          <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
          @endif
          @endforeach
        </select>
      </div>
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
      @if ( Auth::user()->sekolah->tingkat == 'smk' )
      <div class="mb-3 mt-4">
        <label for="formFile" class="form-label">Jurusan</label>
        <select class="form-select" name="kompetensi_id">
          @foreach ($kompetensis as $kompetensi)
          @if ($kompetensi->id == $siswa->kompetensi_id)
          <option value="{{ $kompetensi->id }}" selected>{{ $kompetensi->kompetensi }}</option>
          @else
          <option value="{{ $kompetensi->id }}">{{ $kompetensi->kompetensi }}</option>
          @endif
          @endforeach
        </select>
      </div>
      @endif
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Jalan</label>
        <input type="text" class="form-control" placeholder="Masukan Jalan" name="jalan" value="{{ $siswa->jalan }}">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Kelurahan</label>
        <input type="text" class="form-control" placeholder="Masukan Kelurahan" name="kelurahan" value="{{ $siswa->kelurahan }}">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Kecamatan</label>
        <input type="text" class="form-control" placeholder="Masukan Kecamatan" name="kecamatan" value="{{ $siswa->kecamatan }}">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Rfid</label>
        <input type="hidden" name="id_rfid" value="{{ ($siswa->rfid != null) ? $siswa->rfid->id : '' }}">
        <input type="text" class="form-control" placeholder="Masukan Rfid" name="rfid" value="{{ ($siswa->rfid != null) ? $siswa->rfid->rfid_number : '' }}">
      </div>
      <div class="">
        <label for="exampleInputEmail1" class="form-label">Status Rfid</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status_rfid" id="aktif" {{ ($siswa->rfid != null) ? ($siswa->rfid->status == 'aktif') ? 'checked' : '' : '' }} value="on">
        <label class="form-check-label" for="aktif">
          Aktif
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status_rfid" id="tidak" {{ ($siswa->rfid != null) ? ($siswa->rfid->status == 'tidak') ? 'checked' : '' : '' }} value="tidak">
        <label class="form-check-label" for="tidak">
          Tidak
        </label>
      </div>
      <button type="submit" class="btn text-white font-weight-bold" style="background-color: #3bae9c">Simpan</button>
    </form>
  </div>
</div>
@endsection