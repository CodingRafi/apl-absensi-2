@extends('mylayouts.main')

@section('container')
<div class="card">
  <div class="card-body">
    <h4 class="card-title float-left">Create {{ $role }}</h4>
    <form action="/users/{{ $role }}" method="get">
      @if (request('tahun_awal'))
      <input type="hidden" name="tahun_awal" value="{{ request('tahun_awal') }}">
      @endif
      @if (request('tahun_akhir'))
      <input type="hidden" name="tahun_akhir" value="{{ request('tahun_akhir') }}">
      @endif
      @if (request('semester'))
      <input type="hidden" name="semester" value="{{ request('semester') }}">
      @endif
      <button class="btn btn-sm btn-danger font-weight-bold float-right text-white" type="submit">Kembali</button>
    </form>
    <form class="mt-5" action="/users" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="role" value="{{ $role }}">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control" placeholder="Masukan Nama" name="name">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">NIP</label>
        <input type="number" class="form-control" placeholder="Masukan NIP" name="nip">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input type="email" class="form-control" placeholder="Masukan Email" name="email">
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
      @if ($role == 'guru')
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Mapel</label>
        <select class="form-control" aria-label="Default select example" name="mapel[]" multiple required>
          @foreach ($mapels as $mapel)
          <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
          @endforeach
        </select>
      </div>
      @endif
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
        <label for="exampleInputEmail1" class="form-label">Password</label>
        <input type="password" class="form-control" placeholder="Password" name="password">
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
      {{-- <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Profil</label>
        <input type="file" class="form-control" name="profil">
      </div> --}}
      <button type="submit" class="btn text-white font-weight-bold" style="background-color: #3bae9c">Simpan</button>
    </form>
  </div>
</div>
@endsection