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

        .nama-koleksi {
            font-size: 16px;
        }
    </style>
@endsection

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
      <button class="btn btn-sm btn-danger float-right text-white" type="submit" style="border-radius: 5px;font-weight: 500;">Kembali</button>
    </form>

    @if ($role == 'guru')
      @if (count($mapels) > 0)
      <form class="mt-5" action="/users/{{ $user->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <input type="hidden" name="role" value="{{ $role }}">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan Nama" name="name" value="{{ $user->name }}" value="{{ old('name') }}" style=" font-size: 15px; height: 6.5vh;" required>
          @error('name')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">NIP</label>
          <input type="number" class="form-control @error('nip') is-invalid @enderror" placeholder="Masukan NIP" name="nip" value="{{ $user->nip }}" value="{{ old('nip') }}" style=" font-size: 15px; height: 6.5vh;" required>
          @error('nip')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email</label>
          <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="example@gmail.com" name="email" value="{{ $user->email, old('email') }}" style=" font-size: 15px; height: 6.5vh;" required> 
          @error('email')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Tempat Lahir</label>
          <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" placeholder="Masukan Tempat Lahir" name="tempat_lahir" value="{{ $user->tempat_lahir }}" value="{{ old('tempat_lahir') }}" style=" font-size: 15px; height: 6.5vh;" required>
            @error('tempat_lahir')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Tanggal Lahir</label>
          <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" placeholder="Masukan Tanggal Lahir" name="tanggal_lahir" value="{{ $user->tanggal_lahir }}" value="{{ old('tanggal_lahir') }}" style=" font-size: 15px; height: 6.5vh;" required>
            @error('tanggal_lahir')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="agama_id" class="form-label">Agama</label>
          <select class="form-control @error('agama_id') is-invalid @enderror" id="agama_id" name="ref_agama_id" value="{{ old('agama_id') }}" style=" font-size: 15px; height: 6.5vh;" required>
            <option value="">Pilih Agama</option>
            @foreach ($agamas as $agama)
            @if ($agama->id == $user->ref_agama_id)
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
          <select class="form-control" aria-label="Default select example" name="jk" style=" font-size: 15px; height: 6.5vh;" required>
            <option value="L" {{ ($user->jk == 'L') ? 'selected' : '' }}>Laki-laki</option>
            <option value="P" {{ ($user->jk == 'P') ? 'selected' : '' }}>Perempuan</option>
          </select>
        </div>
        @if ($role == 'guru')
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Mapel</label>
          <select class="fstdropdown-select" name="mapel[]" style=" font-size: 15px; height: 6.5vh;" required multiple>
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
          <input type="text" class="form-control @error('jalan') is-invalid @enderror" placeholder="Masukan Jalan" name="jalan" value="{{ $user->jalan }}" value="{{ old('jalan') }}" style=" font-size: 15px; height: 6.5vh;" required>
          @error('jalan')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Kelurahan</label>
          <input type="text" class="form-control @error('kelurahan') is-invalid @enderror" placeholder="Masukan Kelurahan" name="kelurahan" value="{{ $user->kelurahan }}" value="{{ old('kelurahan') }}" style=" font-size: 15px; height: 6.5vh;" required>
            @error('kelurahan')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Kecamatan</label>
          <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" placeholder="Masukan Kecamatan" name="kecamatan" value="{{ $user->kecamatan }}" value="{{ old('kecamatan') }}" style=" font-size: 15px; height: 6.5vh;" required>
            @error('kecamatan')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Profil</label>
          <input type="file" class="form-control form-control-lg" name="profil" style="height: 6vh; font-size: 15px;">
        </div>
        <div>
          <label for="exampleInputEmail1" class="form-label">Status Rfid</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="status_rfid" id="aktif" {{ ($user->rfid) ?
          ($user->rfid->status == 'aktif') ? 'checked' : '' : '' }} value="on">
          <label class="form-check-label" for="aktif" style="margin-left: 0.1rem">
            Aktif
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="status_rfid" id="tidak" {{ ($user->rfid) ?
          ($user->rfid->status == 'tidak') ? 'checked' : '' : '' }} value="tidak">
          <label class="form-check-label" for="tidak" style="margin-left: 0.1rem">
            Tidak
          </label>
        </div>
        <div class="mt-3 mb-3">
          <label for="exampleInputEmail1" class="form-label">Rfid</label>
          <input type="hidden" name="id_rfid" value="{{ ($user->rfid) ? $user->rfid->id : '' }}">
          <input type="text" class="form-control @error('rfid_number') is-invalid @enderror" placeholder="Masukan Rfid" name="rfid_number" value="{{ ($user->rfid) ? $user->rfid->rfid_number : '' }}" value="{{ old('rfid_number') }}" style=" font-size: 15px; height: 6.5vh;">
            @error('rfid_number')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        {{-- <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Profil</label>
          <input type="file" class="form-control" name="profil">
        </div> --}}
        <button type="submit" class="btn text-white" style="background-color: #3bae9c">Simpan</button>
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
    <form class="mt-5" action="/users/{{ $user->id }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('patch')
      <input type="hidden" name="role" value="{{ $role }}">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan Nama" name="name" value="{{ $user->name }}" value="{{ old('name') }}" style=" font-size: 15px; height: 6.5vh;" required>
        @error('name')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">NIP</label>
        <input type="number" class="form-control @error('nip') is-invalid @enderror" placeholder="Masukan NIP" name="nip" value="{{ $user->nip }}" value="{{ old('nip') }}" style=" font-size: 15px; height: 6.5vh;" required>
        @error('nip')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="example@gmail.com" name="email" value="{{ $user->email, old('email') }}" style=" font-size: 15px; height: 6.5vh;" required> 
        @error('email')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Tempat Lahir</label>
        <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" placeholder="Masukan Tempat Lahir" name="tempat_lahir" value="{{ $user->tempat_lahir }}" value="{{ old('tempat_lahir') }}" style=" font-size: 15px; height: 6.5vh;" required>
          @error('tempat_lahir')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Tanggal Lahir</label>
        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" placeholder="Masukan Tanggal Lahir" name="tanggal_lahir" value="{{ $user->tanggal_lahir }}" value="{{ old('tanggal_lahir') }}" style=" font-size: 15px; height: 6.5vh;" required>
          @error('tanggal_lahir')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Agama</label>
        <input type="text" class="form-control @error('agama') is-invalid @enderror" placeholder="Masukan Agama" name="agama" value="{{ $user->agama }}" value="{{ old('agama') }}" style=" font-size: 15px; height: 6.5vh;" required>
        @error('agama')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Jenis Kelamin</label>
        <select class="form-control" aria-label="Default select example" name="jk" style=" font-size: 15px; height: 6.5vh;" required>
          <option value="L" {{ ($user->jk == 'L') ? 'selected' : '' }}>Laki-laki</option>
          <option value="P" {{ ($user->jk == 'P') ? 'selected' : '' }}>Perempuan</option>
        </select>
      </div>
      @if ($role == 'guru')
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Mapel</label>
        <select class="fstdropdown-select" name="mapel[]" style=" font-size: 15px; height: 6.5vh;" required multiple>
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
        <input type="text" class="form-control @error('jalan') is-invalid @enderror" placeholder="Masukan Jalan" name="jalan" value="{{ $user->jalan }}" value="{{ old('jalan') }}" style=" font-size: 15px; height: 6.5vh;" required>
        @error('jalan')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Kelurahan</label>
        <input type="text" class="form-control @error('kelurahan') is-invalid @enderror" placeholder="Masukan Kelurahan" name="kelurahan" value="{{ $user->kelurahan }}" value="{{ old('kelurahan') }}" style=" font-size: 15px; height: 6.5vh;" required>
          @error('kelurahan')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Kecamatan</label>
        <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" placeholder="Masukan Kecamatan" name="kecamatan" value="{{ $user->kecamatan }}" value="{{ old('kecamatan') }}" style=" font-size: 15px; height: 6.5vh;" required>
          @error('kecamatan')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Profil</label>
        <input type="file" class="form-control form-control-lg" name="profil" style="height: 6vh; font-size: 15px;">
      </div>
      <div>
        <label for="exampleInputEmail1" class="form-label">Status Rfid</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status_rfid" id="aktif" {{ ($user->rfid) ?
        ($user->rfid->status == 'aktif') ? 'checked' : '' : '' }} value="on">
        <label class="form-check-label" for="aktif" style="margin-left: 0.1rem">
          Aktif
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status_rfid" id="tidak" {{ ($user->rfid) ?
        ($user->rfid->status == 'tidak') ? 'checked' : '' : '' }} value="tidak">
        <label class="form-check-label" for="tidak" style="margin-left: 0.1rem">
          Tidak
        </label>
      </div>
      <div class="mt-3 mb-3">
        <label for="exampleInputEmail1" class="form-label">Rfid</label>
        <input type="hidden" name="id_rfid" value="{{ ($user->rfid) ? $user->rfid->id : '' }}">
        <input type="text" class="form-control @error('rfid_number') is-invalid @enderror" placeholder="Masukan Rfid" name="rfid_number" value="{{ ($user->rfid) ? $user->rfid->rfid_number : '' }}" value="{{ old('rfid_number') }}" style=" font-size: 15px; height: 6.5vh;">
          @error('rfid_number')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      {{-- <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Profil</label>
        <input type="file" class="form-control" name="profil">
      </div> --}}
      <button type="submit" class="btn text-white" style="background-color: #3bae9c">Simpan</button>
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