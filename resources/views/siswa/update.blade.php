@extends('mylayouts.main')

@section('container')
<div class="card">
  <div class="card-body">
    <h4 class="card-title float-left">Update Data Siswa</h4>
    <form action="{{ route('users.siswa.index') }}" method="get">
      @include('mypartials.tahunajaran')
      <button class="btn btn-sm btn-danger float-right text-white" type="submit" style="border-radius: 5px;font-weight: 500;">Kembali</button>
    </form>
    <form class="mt-5" action="{{ route('users.siswa.update', [$siswa->id]) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('patch')
      @include('mypartials.tahunajaran')
      <div class="mb-3">
        <label for="profil" class="form-label">Profil</label>
        <input class="form-control form-control-lg @error('profil') is-invalid @enderror" id="profil" type="file" name="profil" style=" font-size: 15px; height: 6.5vh;">
        @error('profil')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="nama" class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan Nama" name="name" id="nama" value="{{ $siswa->name, old('name') }}" style=" font-size: 15px; height: 6.5vh;">
        @error('name')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="nisn" class="form-label">NISN</label>
        <input type="number" class="form-control @error('nisn') is-invalid @enderror" placeholder="Masukan NISN" name="nisn" id="nisn" value="{{ $siswa->nisn, old('nisn') }}" style=" font-size: 15px; height: 6.5vh;">
        @error('nisn')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="nipd" class="form-label">NIPD</label>
        <input type="number" class="form-control @error('nipd') is-invalid @enderror" placeholder="Masukan NIPD" name="nipd" id="nipd" value="{{ $siswa->nipd, old('nipd') }}" style=" font-size: 15px; height: 6.5vh;">
        @error('nipd')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="nik" class="form-label">NIK</label>
        <input type="number" class="form-control @error('nik') is-invalid @enderror" placeholder="Masukan NIK" name="nik" id="nik" value="{{ $siswa->nik, old('nik') }}" style=" font-size: 15px; height: 6.5vh;">
        @error('nik')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="example@gmail.com" name="email" id="email" value="{{ $siswa->email, old('email')}}" style=" font-size: 15px; height: 6.5vh;" required>
        @error('email')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
        <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" placeholder="Masukan Tempat Lahir" name="tempat_lahir" id="tempat_lahir"
          value="{{ $siswa->tempat_lahir, old('tempat_lahir') }}" style=" font-size: 15px; height: 6.5vh;">
          @error('tempat_lahir')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
      </div>
      <div class="mb-3">
        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" placeholder="Masukan Tanggal Lahir" name="tanggal_lahir" id="tanggal_lahir"
          value="{{ $siswa->tanggal_lahir, old('tanggal_lahir') }}" style=" font-size: 15px; height: 6.5vh;">
          @error('tanggal_lahir')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
      </div>
      <div class="mb-3">
        <label for="agama_id" class="form-label">Agama</label>
        <select class="form-select @error('agama_id') is-invalid @enderror" id="agama_id" name="ref_agama_id" style=" font-size: 15px; height: 6.5vh;" required>
          <option value="">Pilih Agama</option>
          @foreach ($agamas as $agama)
          <option value="{{ $agama->id }}" selected {{ $siswa->agama_id, old('agama_id') == $agama->id ? 'selected' : '' }}>{{ $agama->nama }}</option>
          @endforeach
        </select>
        @error('agama_id')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="jk" class="form-label">Jenis Kelamin</label>
        <select class="form-select @error('jk') is-invalid @enderror" aria-label="Default select example" name="jk" id="jk" style=" font-size: 15px; height: 6.5vh;"> 
          <option value="L" {{ ($siswa->jk == 'L') ? 'selected' : ''}}>Laki-laki</option>
          <option value="P" {{ ($siswa->jk == 'P') ? 'selected' : ''}}>Perempuan</option>
        </select>
        @error('jk')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3 mt-4">
        <label for="kelas_id" class="form-label">Kelas</label>
        <select class="form-select @error('kelas_id') is-invalid @enderror" name="kelas_id" id="kelas_id" style=" font-size: 15px; height: 6.5vh;">
          @foreach ($classes as $kelas)
          @if ($kelas->id == $siswa->kelas_id)
          <option value="{{ $kelas->id }}" selected>{{ $kelas->nama }}</option>
          @else
          <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
          @endif
          @endforeach
        </select>
        @error('kelas_id')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      @if ( Auth::user()->sekolah->tingkat == 'smk' )
      <div class="mb-3 mt-4">
        <label for="kompetensi_id" class="form-label">Jurusan</label>
        <select class="form-select @error('kompetensi_id') is-invalid @enderror" name="kompetensi_id" id="kompetensi_id" style=" font-size: 15px; height: 6.5vh;">
          @foreach ($kompetensis as $kompetensi)
          @if ($kompetensi->id == $siswa->kompetensi_id)
          <option value="{{ $kompetensi->id }}" selected>{{ $kompetensi->kompetensi }}</option>
          @else
          <option value="{{ $kompetensi->id }}">{{ $kompetensi->kompetensi }}</option>
          @endif
          @endforeach
        </select>
        @error('kompetensi_id')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      @endif
      <div class="mb-3">
        <label for="jalan" class="form-label">Jalan</label>
        <input type="text" class="form-control @error('jalan') is-invalid @enderror" placeholder="Masukan Jalan" name="jalan" id="jalan" value="{{ $siswa->jalan, old('jalan') }}" style=" font-size: 15px; height: 6.5vh;">
        @error('jalan')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="kelurahan" class="form-label">Kelurahan</label>
        <input type="text" class="form-control @error('kelurahan') is-invalid @enderror" placeholder="Masukan Kelurahan" name="kelurahan" id="kelurahan" value="{{ $siswa->kelurahan, old('kelurahan') }}" style=" font-size: 15px; height: 6.5vh;">
        @error('kelurahan')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="kecamatan" class="form-label">Kecamatan</label>
        <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" placeholder="Masukan Kecamatan" name="kecamatan" id="kecamatan" value="{{ $siswa->kecamatan, old('kecamatan') }}" style=" font-size: 15px; height: 6.5vh;">
        @error('kecamatan')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="kota_kab" class="form-label">Kota/Kabupaten</label>
        <input type="text" class="form-control @error('kota_kab') is-invalid @enderror" placeholder="Masukan kota_kab" name="kota_kab" id="kota_kab" value="{{ $siswa->kota_kab, old('kota_kab') }}" style=" font-size: 15px; height: 6.5vh;">
        @error('kota_kab')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="provinsi" class="form-label">Provinsi</label>
        <input type="text" class="form-control @error('provinsi') is-invalid @enderror" placeholder="Masukan provinsi" name="provinsi" id="provinsi" value="{{ $siswa->provinsi, old('provinsi') }}" style=" font-size: 15px; height: 6.5vh;">
        @error('provinsi')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="">
        <label for="" class="form-label">Status Rfid</label>
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
        <label for="rfid_number" class="form-label">Rfid</label>
        <input type="hidden" name="id_rfid" value="{{ ($siswa->rfid != null) ? $siswa->rfid->id : '' }}">
        <input type="text" class="form-control" placeholder="Masukan Rfid" name="rfid_number" id="rfid_number" value="{{ ($siswa->rfid != null) ? $siswa->rfid->rfid_number : '' }}" style=" font-size: 15px; height: 6.5vh;">
      </div>
      <button type="submit" class="btn text-white" style="background-color: #3bae9c">Simpan</button>
    </form>
  </div>
</div>
@endsection