@extends('mylayouts.main')

@section('container')
<div class="card">
  <div class="card-body">
    <h4 class="card-title float-left">Create Data Siswa</h4>
    <form action="{{ route('users.siswa.index') }}" method="get">
      @include('mypartials.tahunajaran')
      <button class="btn btn-sm btn-danger float-right text-white" type="submit" style="border-radius: 5px;font-weight: 500;">Kembali</button>
    </form>
    <form class="mt-5" action="{{ route('users.siswa.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      @include('mypartials.tahunajaran')
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">NISN</label>
        <input type="number" class="form-control @error('nisn') is-invalid @enderror" placeholder="Masukan NISN"
          name="nisn" value="{{old('nisn')}}" style=" font-size: 15px; height: 6.5vh;" required>
        @error('nisn')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">NIPD</label>
        <input type="number" class="form-control @error('nipd') is-invalid @enderror" placeholder="Masukan NIPD"
          name="nipd" value="{{ old('nipd') }}" style=" font-size: 15px; height: 6.5vh;" required>
        @error('nipd')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">NIK</label>
        <input type="number" class="form-control @error('nik') is-invalid @enderror" placeholder="Masukan NIK"
          name="nik" value="{{ old('nik') }}" style=" font-size: 15px; height: 6.5vh;" required>
        @error('nik')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan Nama"
          name="name" value="{{ old('name') }}" style=" font-size: 15px; height: 6.5vh;" required>
        @error('name')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Tanggal Lahir</label>
        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
          placeholder="Masukan Tanggal Lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
          style=" font-size: 15px; height: 6.5vh;" required>
        @error('tanggal_lahir')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="agama_id" class="form-label">Agama</label>
        <select class="form-control @error('agama_id') is-invalid @enderror" id="agama_id" name="ref_agama_id" style=" font-size: 15px; height: 6.5vh;" required>
          <option value="">Pilih Agama</option>
          @foreach ($agamas as $agama)
          @if (old('ref_agama_id') == $agama->id)
          <option value="{{ $agama->id }}" selected>{{ $agama->nama }}</option>
          @else
          <option value="{{ $agama->id }}">{{ $agama->nama }}</option>
          @endif
          @endforeach
        </select>
        @error('agama_id')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Jenis Kelamin</label>
        <select class="form-control @error('jk') is-invalid @enderror" aria-label="Default select example" name="jk" style=" font-size: 15px; height: 6.5vh;" required>
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
        <select class="form-select @error('kelas_id') is-invalid @enderror" name="kelas_id"
          value="{{ old('kelas_id') }}" style=" font-size: 15px; height: 6.5vh;" required>
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
      @if (Auth::user()->sekolah->tingkat == 'smk' || Auth::user()->sekolah->tingkat == 'sma')
      <div class="mb-3 mt-4">
        <label for="formFile" class="form-label">Jurusan</label>
        <select class="form-select @error('kompetensi_id') is-invalid @enderror" name="kompetensi_id"
          value="{{ old('kompetensi_id') }}" style=" font-size: 15px; height: 6.5vh;" required>
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
      @endif
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Jalan</label>
        <input type="text" class="form-control @error('jalan') is-invalid @enderror" placeholder="Masukan Jalan"
          name="jalan" value="{{ old('jalan') }}" style=" font-size: 15px; height: 6.5vh;" required>
        @error('jalan')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Kelurahan</label>
        <input type="text" class="form-control @error('kelurahan') is-invalid @enderror" placeholder="Masukan Kelurahan"
          name="kelurahan" value="{{ old('kelurahan') }}" style=" font-size: 15px; height: 6.5vh;" required>
        @error('kelurahan')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Kecamatan</label>
        <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" placeholder="Masukan Kecamatan"
          name="kecamatan" value="{{ old('kecamatan') }}" style=" font-size: 15px; height: 6.5vh;" required>
        @error('kecamatan')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="example@gmail.com"
          name="email" value="{{old('email')}}" style=" font-size: 15px; height: 6.5vh;" required>
        @error('email')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Password</label>
        <input type="text" class="form-control" value="*123456*" style=" font-size: 15px; height: 6.5vh;" disabled>
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Tempat Lahir</label>
        <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
          placeholder="Masukan Tempat Lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}"
          style=" font-size: 15px; height: 6.5vh;" required>
        @error('tempat_lahir')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="profil" class="form-label">Profil</label>
        <input class="form-control form-control-lg @error('profil') is-invalid @enderror" id="formFileLg" type="file"
          name="profil" style=" font-size: 15px; height: 6.5vh;">
        @error('profil')
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
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Rfid</label>
        <input type="text" class="form-control @error('rfid_number') is-invalid @enderror" placeholder="Masukan Rfid"
          name="rfid_number" value="{{ old('rfid_number') }}" style=" font-size: 15px; height: 6.5vh;">
        @error('rfid_number')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <button type="submit" class="btn text-white mt-3" style="background-color: #3bae9c">Simpan</button>
    </form>
  </div>
</div>
@endsection