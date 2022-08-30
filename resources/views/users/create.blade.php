@extends('mylayouts.main')

@section('tambahcss')
    <link rel="stylesheet" href="/css/fstdropdown.css">

    <style>
        .nav-pills .show>.nav-link {
            background-color: transparent !important;
        }

        .dropdown-menu.show {
            top: .4rem !important;
            left: -8rem !important;
        }

        .fstdropdown>.fstlist {
            min-height: 10rem !important;
        }

        /* .fstAll {
            display: none !important;
        } */

        /* .fstsearch{
          border: 1px solid rgb(205, 205, 205);
          margin: 0.5rem;
          width: 54rem;
        } */

        .nama-koleksi {
            font-size: 16px;
        }
    </style>
@endsection

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
    @if ($role == 'guru')
      @if (count($mapels)>0)
      <form class="mt-5" action="/users" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="role" value="{{ $role }}">
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
          <label for="exampleInputEmail1" class="form-label">NIP</label>
          <input type="number" class="form-control @error('nip') is-invalid @enderror" placeholder="Masukan NIP" name="nip" value="{{ old('nip') }}" required>
          @error('nip')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email</label>
          <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukan Email" name="email" value="{{ old('email') }}" required>
          @error('email')
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
        @if ($role == 'guru')
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Mapel</label>
          <select class="fstdropdown-select @error('mapel[]') is-invalid @enderror" name="mapel[]" value="{{ old('mapel[]') }}" style="height: 5rem" required multiple>
            @foreach ($mapels as $mapel)
            <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
            @endforeach
          </select>
          @error('mapel[]')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        @endif
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
          <label for="exampleInputEmail1" class="form-label">Password</label>
          <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" value="{{ old('password') }}" required>
          @error('password')
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
        {{-- <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Profil</label>
          <input type="file" class="form-control" name="profil">
        </div> --}}
        <button type="submit" class="btn text-white mt-3" style="background-color: #3bae9c">Simpan</button>
      </form>
      @else
      <div class="alert alert-success d-flex mt-5" role="alert">
        <div>
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/>
          </svg>
        </div>
        <div>Data mapel belum tersedia, silahkan input data mapel pada laman "Mapel".</div>
    </div>
      @endif
      @else
      <form class="mt-5" action="/users" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="role" value="{{ $role }}">
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
          <label for="exampleInputEmail1" class="form-label">NIP</label>
          <input type="number" class="form-control @error('nip') is-invalid @enderror" placeholder="Masukan NIP" name="nip" value="{{ old('nip') }}" required>
          @error('nip')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email</label>
          <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukan Email" name="email" value="{{ old('email') }}" required>
          @error('email')
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
        @if ($role == 'guru')
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Mapel</label>
          <select class="fstdropdown-select @error('mapel[]') is-invalid @enderror" name="mapel[]" value="{{ old('mapel[]') }}" style="height: 5rem" required multiple>
            @foreach ($mapels as $mapel)
            <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
            @endforeach
          </select>
          @error('mapel[]')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        @endif
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
          <label for="exampleInputEmail1" class="form-label">Password</label>
          <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" value="{{ old('password') }}" required>
          @error('password')
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
        {{-- <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Profil</label>
          <input type="file" class="form-control" name="profil">
        </div> --}}
        <button type="submit" class="btn text-white mt-3" style="background-color: #3bae9c">Simpan</button>
      </form>
    @endif
  </div>
</div>
@endsection

@section('tambahjs')
<script src="/js/fstdropdown.js"></script>
    <script>
        setFstDropdown();
    </script>
@endsection