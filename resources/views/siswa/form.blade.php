<form class="mt-5" action="{{ (isset($data)) ? route('users.edit', ['id' => $data->id, 'role' => 'siswa']) : route('users.siswa.store', ['siswa']) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('mypartials.tahunajaran')
    <div class="mb-3">
      <label for="nisn" class="form-label">NISN</label>
      <input type="number" class="form-control @error('nisn') is-invalid @enderror" placeholder="Masukan NISN"
        name="nisn" id="nisn" value="{{ isset($data) ? $data->nisn : old('nisn') }}" style=" font-size: 15px; height: 6.5vh;" required>
      @error('nisn')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="nipd" class="form-label">NIPD</label>
      <input type="number" class="form-control @error('nipd') is-invalid @enderror" placeholder="Masukan NIPD"
        name="nipd" id="nipd" value="{{ isset($data) ? $data->nipd : old('nipd') }}" style=" font-size: 15px; height: 6.5vh;" required>
      @error('nipd')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="nik" class="form-label">NIK</label>
      <input type="number" class="form-control @error('nik') is-invalid @enderror" placeholder="Masukan NIK"
        name="nik" id="nik" value="{{ isset($data) ? $data->nik : old('nik') }}" style=" font-size: 15px; height: 6.5vh;" required>
      @error('nik')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="name" class="form-label">Nama Lengkap</label>
      <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan Nama"
        name="name" id="name" value="{{ isset($data) ? $data->name : old('name') }}" style=" font-size: 15px; height: 6.5vh;" required>
      @error('name')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
      <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
        placeholder="Masukan Tanggal Lahir" name="tanggal_lahir" id="tanggal_lahir" value="{{ isset($data) ? $data->tanggal_lahir : old('tanggal_lahir') }}"
        style=" font-size: 15px; height: 6.5vh;" required>
      @error('tanggal_lahir')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="agama_id" class="form-label">Agama</label>
      <select class="form-select @error('agama_id') is-invalid @enderror" id="agama_id" name="ref_agama_id"
        style=" font-size: 15px; height: 6.5vh;" required>
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
      <label for="jk" class="form-label">Jenis Kelamin</label>
      <select class="form-select @error('jk') is-invalid @enderror" aria-label="Default select example" name="jk"
        id="jk" style=" font-size: 15px; height: 6.5vh;" required>
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
      <label for="kelas_id" class="form-label">Kelas</label>
      <select class="form-select @error('kelas_id') is-invalid @enderror" name="kelas_id" id="kelas_id"
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
      <label for="kompetensi_id" class="form-label">Jurusan</label>
      <select class="form-select @error('kompetensi_id') is-invalid @enderror" name="kompetensi_id" id="kompetensi_id"
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
      <label for="jalan" class="form-label">Jalan</label>
      <input type="text" class="form-control @error('jalan') is-invalid @enderror" placeholder="Masukan Jalan"
        name="jalan" id="jalan" value="{{ isset($data) ? $data->jalan : old('jalan') }}" style=" font-size: 15px; height: 6.5vh;" required>
      @error('jalan')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="kelurahan" class="form-label">Kelurahan</label>
      <input type="text" class="form-control @error('kelurahan') is-invalid @enderror" placeholder="Masukan Kelurahan"
        name="kelurahan" id="kelurahan" value="{{ isset($data) ? $data->kelurahan : old('kelurahan') }}" style=" font-size: 15px; height: 6.5vh;"
        required>
      @error('kelurahan')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="kecamatan" class="form-label">Kecamatan</label>
      <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" placeholder="Masukan Kecamatan"
        name="kecamatan" id="kecamatan" value="{{ isset($data) ? $data->kecamatan : old('kecamatan') }}" style=" font-size: 15px; height: 6.5vh;"
        required>
      @error('kecamatan')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="kota_kab" class="form-label">Kota/Kabupaten</label>
      <input type="text" class="form-control @error('kota_kab') is-invalid @enderror" placeholder="Masukan Kota/Kabupaten"
        name="kota_kab" id="kota_kab" value="{{ isset($data) ? $data->kota_kab : old('kota_kab') }}" style=" font-size: 15px; height: 6.5vh;"
        required>
      @error('kota_kab')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="provinsi" class="form-label">Provinsi</label>
      <input type="text" class="form-control @error('provinsi') is-invalid @enderror" placeholder="Masukan provinsi"
        name="provinsi" id="provinsi" value="{{ isset($data) ? $data->provinsi : old('provinsi') }}" style=" font-size: 15px; height: 6.5vh;"
        required>
      @error('provinsi')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="example@gmail.com"
        name="email" id="email" value="{{ isset($data) ? $data->email : old('email') }}" style=" font-size: 15px; height: 6.5vh;" required>
      @error('email')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="text" class="form-control" value="*123456*" name="password" id="password"
        style=" font-size: 15px; height: 6.5vh;" disabled>
    </div>
    <div class="mb-3">
      <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
      <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
        placeholder="Masukan Tempat Lahir" name="tempat_lahir" id="tempat_lahir" value="{{ isset($data) ? $data->tempat_lahir : old('tempat_lahir') }}"
        style=" font-size: 15px; height: 6.5vh;" required>
      @error('tempat_lahir')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="profil" class="form-label">Profil</label>
      <input class="form-control form-control-lg @error('profil') is-invalid @enderror" id="profil" type="file"
        name="profil" style=" font-size: 15px; height: 6.5vh;">
      @error('profil')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="">
      <label for="" class="form-label">Status Rfid</label>
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
      <label for="rfid_number" class="form-label">Rfid</label>
      <input type="text" class="form-control @error('rfid_number') is-invalid @enderror" placeholder="Masukan Rfid"
        name="rfid_number" id="rfid_number" value="{{ isset($data) ? $data->rfid_number : old('rfid_number') }}" style=" font-size: 15px; height: 6.5vh;">
      @error('rfid_number')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <button type="submit" class="btn text-white mt-3" style="background-color: #3bae9c">Simpan</button>
  </form>