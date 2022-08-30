@extends('mylayouts.main')

@section('container')
<div class="card">
  <div class="card-body">
    <h4 class="card-title float-left">Update {{ $role }}</h4>
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
    <form class="mt-5" action="/users/{{ $user->id }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('patch')
      <input type="hidden" name="role" value="{{ $role }}">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control" placeholder="Masukan Nama" name="name" value="{{ $user->name }}">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">NIP</label>
        <input type="number" class="form-control" placeholder="Masukan NIP" name="nip" value="{{ $user->nip }}">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Tempat Lahir</label>
        <input type="text" class="form-control" placeholder="Masukan Tempat Lahir" name="tempat_lahir"
          value="{{ $user->tempat_lahir }}">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Tanggal Lahir</label>
        <input type="date" class="form-control" placeholder="Masukan Tanggal Lahir" name="tanggal_lahir"
          value="{{ $user->tanggal_lahir }}">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Agama</label>
        <input type="text" class="form-control" placeholder="Masukan Agama" name="agama" value="{{ $user->agama }}">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Jenis Kelamin</label>
        <select class="form-control" aria-label="Default select example" name="jk">
          <option value="L" {{ ($user->jk == 'L') ? 'selected' : '' }}>Laki-laki</option>
          <option value="P" {{ ($user->jk == 'P') ? 'selected' : '' }}>Perempuan</option>
        </select>
      </div>
      @if ($role == 'guru')
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Mapel</label>
        <select class="form-control" aria-label="Default select example" name="mapel[]" multiple required>
          @foreach ($mapels as $mapel)
          @if (count($user->mapel) > 0)
          @foreach ($user->mapel as $mapel_pilih)
          @if ($mapel->id == $mapel_pilih->id)
          <option value="{{ $mapel->id }}" selected>{{ $mapel->nama }}</option>
          @else
          <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
          @endif
          @endforeach
          @else
          <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
          @endif
          @endforeach
        </select>
      </div>
      @endif
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Jalan</label>
        <input type="text" class="form-control" placeholder="Masukan Jalan" name="jalan" value="{{ $user->jalan }}">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Kelurahan</label>
        <input type="text" class="form-control" placeholder="Masukan Kelurahan" name="kelurahan"
          value="{{ $user->kelurahan }}">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Kecamatan</label>
        <input type="text" class="form-control" placeholder="Masukan Kecamatan" name="kecamatan"
          value="{{ $user->kecamatan }}">
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Rfid</label>
        <input type="hidden" name="id_rfid" value="{{ ($user->rfid) ? $user->rfid->id : '' }}">
        <input type="text" class="form-control" placeholder="Masukan Rfid" name="rfid"
          value="{{ ($user->rfid) ? $user->rfid->rfid_number : '' }}">
      </div>
      <div class="">
        <label for="exampleInputEmail1" class="form-label">Status Rfid</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status_rfid" id="aktif" {{ ($user->rfid) ?
        ($user->rfid->status == 'aktif') ? 'checked' : '' : '' }} value="on">
        <label class="form-check-label" for="aktif">
          Aktif
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status_rfid" id="tidak" {{ ($user->rfid) ?
        ($user->rfid->status == 'tidak') ? 'checked' : '' : '' }} value="tidak">
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