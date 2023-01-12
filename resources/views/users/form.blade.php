<style>
    .nav-pills .show>.nav-link {
        background-color: transparent !important;
    }

    .dropdown-menu.show {
        top: .4rem !important;
        left: -8rem !important;
    }

    .nama-koleksi {
        font-size: 16px;
    }
</style>

<form class="mt-5"
    action="{{ (isset($data)) ? route('users.update', ['id' => $data->id, 'role' => $role]) : route('users.store', [$role]) }}"
    method="POST" enctype="multipart/form-data">
    @if (isset($data))
    @method('patch')
    @endif
    @csrf   
    @include('mypartials.tahunajaran')
    <div class="mb-3">
        <label for="name" class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan Nama"
            name="name" value="{{ isset($data) ? $data->name : old('name') }}" style=" font-size: 15px; height: 6.5vh;"
            id="name">
        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    @if ($role == 'siswa')
    <div class="mb-3">
        <label for="nipd" class="form-label">NIPD</label>
        <input type="number" class="form-control @error('nipd') is-invalid @enderror" placeholder="Masukan NIPD"
            name="nipd" value="{{ isset($data) ? $data->nipd : old('nipd') }}" style=" font-size: 15px; height: 6.5vh;"
            id="nipd">
        @error('nipd')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="nisn" class="form-label">NISN</label>
        <input type="number" class="form-control @error('nisn') is-invalid @enderror" placeholder="Masukan NISN"
            name="nisn" value="{{ isset($data) ? $data->nisn : old('nisn') }}" style=" font-size: 15px; height: 6.5vh;"
            id="nisn">
        @error('nisn')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="nik" class="form-label">NIK</label>
        <input type="number" class="form-control @error('nik') is-invalid @enderror" placeholder="Masukan NIK"
            name="nik" value="{{ isset($data) ? $data->nik : old('nik') }}" style=" font-size: 15px; height: 6.5vh;"
            id="nik">
        @error('nik')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="kelas_id" class="form-label">Kelas</label>
        <select class="form-select @error('kelas_id') is-invalid @enderror" aria-label="Default select example" name="kelas_id"
            value="{{ old('kelas_id') }}" style=" font-size: 15px; height: 6.5vh;" id="kelas_id">
            <option value="">Pilih Kelas</option>
            @foreach ($kelas as $row)
            <option value="{{ $row->id }}" {{ isset($data) ? ($data->kelas_id == $row->id ? 'selected' : '') : (old('kelas_id') == $row->id ? 'selected' : '') }}>{{ $row->nama}}</option>
            @endforeach
        </select>
        @error('kelas_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    @if (Auth::user()->sekolah->tingkat == 'smk' || Auth::user()->sekolah->tingkat == 'sma')
    <div class="mb-3">
        <label for="kompetensi_id" class="form-label">Kompetensi</label>
        <select class="form-select @error('kompetensi_id') is-invalid @enderror" aria-label="Default select example" name="kompetensi_id"
            value="{{ old('kompetensi_id') }}" style=" font-size: 15px; height: 6.5vh;" id="kompetensi_id">
            <option value="">Pilih Kompetensi</option>
            @foreach ($kompetensis as $kompetensi)
            <option value="{{ $kompetensi->id }}" {{ isset($data) ? ($data->kompetensi_id == $kompetensi->id ? 'selected' : '') : (old('kompetensi_id') == $kompetensi->id ? 'selected' : '') }}>{{ $kompetensi->kompetensi}}</option>
            @endforeach
        </select>
        @error('kompetensi_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    @endif
    @else
    <div class="mb-3">
        <label for="nip" class="form-label">NIP</label>
        <input type="number" class="form-control @error('nip') is-invalid @enderror" placeholder="Masukan NIP"
            name="nip" value="{{ isset($data) ? $data->nip : old('nip') }}" style=" font-size: 15px; height: 6.5vh;"
            id="nip">
        @error('nip')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    @endif
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukan Email"
            name="email" value="{{ isset($data) ? $data->email : old('email') }}"
            style=" font-size: 15px; height: 6.5vh;" id="email">
        @error('email')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
        <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
            placeholder="Masukan Tempat Lahir" name="tempat_lahir"
            value="{{ isset($data) ? $data->tempat_lahir : old('tempat_lahir') }}"
            style=" font-size: 15px; height: 6.5vh;" id="tempat_lahir">
        @error('tempat_lahir')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
            placeholder="Masukan Tanggal Lahir" name="tanggal_lahir"
            value="{{ isset($data) ? $data->tanggal_lahir : old('tanggal_lahir') }}"
            style=" font-size: 15px; height: 6.5vh;" id="tanggal_lahir">
        @error('tanggal_lahir')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="agama_id" class="form-label">Agama</label>
        <select class="form-select @error('agama_id') is-invalid @enderror" id="agama_id" name="ref_agama_id"
            value="{{ old('agama_id') }}" style=" font-size: 15px; height: 6.5vh;">
            <option value="">Pilih Agama</option>
            @foreach ($agamas as $agama)
            <option value="{{ $agama->id }}" {{ isset($data) ? ($data->ref_agama_id == $agama->id ? 'selected' : '') : (old('ref_agama_id') == $agama->id ? 'selected' : '') }}>{{ $agama->nama}}</option>
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
            value="{{ old('jk') }}" style=" font-size: 15px; height: 6.5vh;" id="jk">
            <option value="L" {{ isset($data) ? ($data->name == 'L' ? 'selected' : '') : (old('name') == 'L' ?
                'selected' : '') }}>Laki-laki</option>
            <option value="P" {{ isset($data) ? ($data->name == 'P' ? 'selected' : '') : (old('name') == 'P' ?
                'selected' : '') }}>Perempuan</option>
        </select>
        @error('jk')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    @if ($role == 'guru')
    <div class="mb-3">
        <label for="mapel" class="form-label">Mapel</label>
        <select class="fstdropdown-select @error('mapel[]') is-invalid @enderror" name="mapel[]"
            value="{{ old('mapel[]') }}" style=" font-size: 15px; height: 6.5vh;" multiple id="mapel">
            @foreach ($mapels as $mapel)
            @if (isset($data) && count($data->mapel) > 0)
            @foreach ($data->mapel as $mapel_pilih)
            <option value="{{ $mapel->id }}" {{ $mapel->id == $mapel_pilih->id ? 'selected' : '' }}>{{ $mapel->nama }}
            </option>
            @endforeach
            @else
            <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
            @endif
            @endforeach
        </select>
        @error('mapel')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    @endif
    <div class="mb-3">
        <label for="ref_provinsi_id" class="form-label">Provinsi</label>
        <select class="between-input-item-select form-control" name="ref_provinsi_id" id="ref_provinsi_id">
            <option value="">Pilih Provinsi</option>
            @foreach ($provinsis as $provinsi)
            <option value="{{ $provinsi->id }}" {{ isset($data) ? ($data->ref_provinsi_id == $provinsi->id ? 'selected' : '') : (old('ref_provinsi_id') == $provinsi->id ? 'selected' : '') }}>{{ $provinsi->nama }}</option>
            @endforeach
        </select>
        @error('ref_provinsi_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="ref_kabupaten_id" class="form-label">Kota/Kabupaten</label>
        <select class="between-input-item-select form-select" name="ref_kabupaten_id" id="ref_kabupaten_id">
            <option value="">Pilih Kota/Kabupaten</option>
        </select>
        @error('ref_kabupaten_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="ref_kecamatan_id" class="form-label">Kecamatan</label>
        <select class="between-input-item-select form-select" name="ref_kecamatan_id" id="ref_kecamatan_id">
            <option value="">Pilih Kecamatan</option>
        </select>
        @error('ref_kecamatan_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="ref_kelurahan_id" class="form-label">Kelurahan</label>
        <select class="between-input-item-select form-select" name="ref_kelurahan_id" id="ref_kelurahan_id">
            <option value="">Pilih Kelurahan</option>
        </select>
        @error('ref_kelurahan_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="jalan" class="form-label">Jalan</label>
        <input type="text" class="form-control @error('jalan') is-invalid @enderror" placeholder="Masukan Jalan"
            name="jalan" value="{{ isset($data) ? $data->jalan : old('jalan') }}"
            style=" font-size: 15px; height: 6.5vh;" id="jalan">
        @error('jalan')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    @if (!isset($data))
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="*123456*" style=" font-size: 15px; height: 6.5vh;" id="password" disabled>
    </div>
    @endif
    <div class="">
        <label class="form-label">Status Rfid</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status_rfid" id="aktif" value="on" {{ isset($data) ?
            (($data->rfid) ?
        ($data->rfid->status == 'aktif') ? 'checked' : '' : '') : '' }}>
        <label class="form-check-label" for="aktif" style="margin-left: -0.1rem">
            Aktif
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status_rfid" id="tidak" value="tidak" {{ isset($data) ?
            (($data->rfid) ?
        ($data->rfid->status == 'tidak') ? 'checked' : '' : '') : '' }}>
        <label class="form-check-label" for="tidak" style="margin-left: -0.1rem">
            Tidak
        </label>
    </div>
    <div class="mb-3">
        <label for="foto_profil" class="form-label">Foto Profil</label>
        <div class="row">
            <div class="col-md">
                <input type="file" class="form-control form-control-lg" name="profil" style=" font-size: 15px; height: 6.5vh;"
                    id="foto_profil">
            </div>
            @if (isset($data) && $data->profil != '/img/profil.png')
            <div class="col-md-3">
                <a href="{{ asset('storage/' . $data->profil) }}" class="btn btn-primary" target="_blank">Show Photo Uploaded</a>
            </div>
            @endif
        </div>
    </div>
    <div class="mb-3">
        <label for="rfid" class="form-label">Rfid</label>
        <input type="text" class="form-control @error('rfid_number') is-invalid @enderror" placeholder="Masukan Rfid"
            name="rfid_number" value="{{ isset($data) ? $data->rfid ? ($data->rfid->rfid_number) : '' : old('rfid') }}"
            style=" font-size: 15px; height: 6.5vh;" id="rfid">
        @error('rfid_number')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <button type="submit" class="btn text-white mt-3" style="background-color: #3bae9c">Simpan</button>
</form>
