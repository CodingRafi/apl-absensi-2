@extends('mylayouts.main')

@section('container')
<div class="card">
  <div class="card-body">
    <h4 class="card-title float-left">Create Data Siswa</h4>
    <form action="/siswa" method="get">
      @include('mypartials.tahunajaran')
      <button class="btn btn-sm btn-danger font-weight-bold float-right text-white" type="submit">Kembali</button>
    </form>
    <form class="mt-5" action="/siswa" method="POST">
      @csrf
      @include('mypartials.tahunajaran')
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control" placeholder="Masukan Nama" name="name">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">NISN</label>
        <input type="number" class="form-control" placeholder="Masukan NISN" name="nisn">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">NIPD</label>
        <input type="number" class="form-control" placeholder="Masukan NIPD" name="nipd">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">NIK</label>
        <input type="number" class="form-control" placeholder="Masukan NIK" name="nik">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Tempat Lahir</label>
        <input type="text" class="form-control" placeholder="Masukan Tempat Lahir" name="tempat_lahir">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Tanggal Lahir</label>
        <input type="date" class="form-control" placeholder="Masukan Tanggal Lahir" name="tanggal_lahir">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Agama</label>
        <input type="text" class="form-control" placeholder="Masukan Agama" name="agama">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Jenis Kelamin</label>
        <select class="form-control" aria-label="Default select example" name="jk">
          <option value="L">Laki-laki</option>
          <option value="P">Perempuan</option>
        </select>
      </div>
      <div class="mb-3 mt-4">
        <label for="formFile" class="form-label">Kelas</label>
        <select class="form-select" name="kelas_id">
          @foreach ($classes as $kelas)
          <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-3 mt-4">
        <label for="formFile" class="form-label">Jurusan</label>
        <select class="form-select" name="kompetensi_id">
          @foreach ($kompetensis as $kompetensi)
          <option value="{{ $kompetensi->id }}">{{ $kompetensi->kompetensi }}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Jalan</label>
        <input type="text" class="form-control" placeholder="Masukan Jalan" name="jalan">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Kelurahan</label>
        <input type="text" class="form-control" placeholder="Masukan Kelurahan" name="kelurahan">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Kecamatan</label>
        <input type="text" class="form-control" placeholder="Masukan Kecamatan" name="kecamatan">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Rfid</label>
        <input type="text" class="form-control" placeholder="Masukan Rfid" name="rfid">
      </div>
      <div class="">
        <label for="exampleInputEmail1" class="form-label">Status Rfid</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status_rfid" id="aktif" value="on">
        <label class="form-check-label" for="aktif">
          Aktif
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status_rfid" id="tidak" value="tidak">
        <label class="form-check-label" for="tidak">
          Tidak
        </label>
      </div>
      <button type="submit" class="btn text-white font-weight-bold" style="background-color: #3bae9c">Simpan</button>
    </form>
  </div>
</div>
@endsection