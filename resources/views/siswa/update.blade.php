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
        <input class="form-control form-control-lg @error('profil') is-invalid @enderror" id="formFileLg" type="file" name="profile" style=" font-size: 15px; height: 6.5vh;">
        @error('profil')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control" placeholder="Masukan Nama" name="name" value="{{ $siswa->name }}" style=" font-size: 15px; height: 6.5vh;">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">NISN</label>
        <input type="number" class="form-control" placeholder="Masukan NISN" name="nisn" value="{{ $siswa->nisn }}" style=" font-size: 15px; height: 6.5vh;">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">NIPD</label>
        <input type="number" class="form-control" placeholder="Masukan NIPD" name="nipd" value="{{ $siswa->nipd }}" style=" font-size: 15px; height: 6.5vh;">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">NIK</label>
        <input type="number" class="form-control" placeholder="Masukan NIK" name="nik" value="{{ $siswa->nik }}" style=" font-size: 15px; height: 6.5vh;">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="example@gmail.com" name="email" value="{{ $siswa->email, old('email')}}" style=" font-size: 15px; height: 6.5vh;" required>
        @error('email')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Tempat Lahir</label>
        <input type="text" class="form-control" placeholder="Masukan Tempat Lahir" name="tempat_lahir"
          value="{{ $siswa->tempat_lahir }}" style=" font-size: 15px; height: 6.5vh;">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Tanggal Lahir</label>
        <input type="date" class="form-control" placeholder="Masukan Tanggal Lahir" name="tanggal_lahir"
          value="{{ $siswa->tanggal_lahir }}" style=" font-size: 15px; height: 6.5vh;">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Agama</label>
        <input type="text" class="form-control" placeholder="Masukan Agama" name="agama" value="{{ $siswa->agama }}" style=" font-size: 15px; height: 6.5vh;">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Jenis Kelamin</label>
        <select class="form-control" aria-label="Default select example" name="jk" style=" font-size: 15px; height: 6.5vh;"> 
          <option value="L" {{ ($siswa->jk == 'L') ? 'selected' : ''}}>Laki-laki</option>
          <option value="P" {{ ($siswa->jk == 'P') ? 'selected' : ''}}>Perempuan</option>
        </select>
      </div>
      <div class="mb-3 mt-4">
        <label for="formFile" class="form-label">Kelas</label>
        <select class="form-select" name="kelas_id" style=" font-size: 15px; height: 6.5vh;">
          @foreach ($classes as $kelas)
          @if ($kelas->id == $siswa->kelas_id)
          <option value="{{ $kelas->id }}" selected>{{ $kelas->nama }}</option>
          @else
          <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
          @endif
          @endforeach
        </select>
      </div>
      @if ( Auth::user()->sekolah->tingkat == 'smk' )
      <div class="mb-3 mt-4">
        <label for="formFile" class="form-label">Jurusan</label>
        <select class="form-select" name="kompetensi_id" style=" font-size: 15px; height: 6.5vh;">
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
        <input type="text" class="form-control" placeholder="Masukan Jalan" name="jalan" value="{{ $siswa->jalan }}" style=" font-size: 15px; height: 6.5vh;">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Kelurahan</label>
        <input type="text" class="form-control" placeholder="Masukan Kelurahan" name="kelurahan" value="{{ $siswa->kelurahan }}" style=" font-size: 15px; height: 6.5vh;">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Kecamatan</label>
        <input type="text" class="form-control" placeholder="Masukan Kecamatan" name="kecamatan" value="{{ $siswa->kecamatan }}" style=" font-size: 15px; height: 6.5vh;">
      </div>
      <div class="">
        <label for="exampleInputEmail1" class="form-label">Status Rfid</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status_rfid" id="aktif" {{ ($siswa->rfid != null) ? ($siswa->rfid->status == 'aktif') ? 'checked' : '' : '' }} value="on">
        <label class="form-check-label" for="aktif" style="margin-left: 0.1rem">
          Aktif
        </label>
      </div>
      <div class="form-check mb-3">
        <input class="form-check-input" type="radio" name="status_rfid" id="tidak" {{ ($siswa->rfid != null) ? ($siswa->rfid->status == 'tidak') ? 'checked' : '' : '' }} value="tidak">
        <label class="form-check-label" for="tidak" style="margin-left: 0.1rem;">
          Tidak
        </label>
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Rfid</label>
        <input type="hidden" name="id_rfid" value="{{ ($siswa->rfid != null) ? $siswa->rfid->id : '' }}">
        <input type="text" class="form-control" placeholder="Masukan Rfid" name="rfid_number" value="{{ ($siswa->rfid != null) ? $siswa->rfid->rfid_number : '' }}" style=" font-size: 15px; height: 6.5vh;">
      </div>
      <button type="submit" class="btn text-white" style="background-color: #3bae9c">Simpan</button>
    </form>
  </div>
</div>
@endsection