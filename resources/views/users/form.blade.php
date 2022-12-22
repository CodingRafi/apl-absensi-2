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
    @csrf
    <input type="hidden" name="role" value="{{ $role }}">
    <div class="mb-3">
        <label for="name" class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan Nama"
            name="name" value="{{ isset($data) ? $data->name : old('name') }}" style=" font-size: 15px; height: 6.5vh;"
            required id="name">
        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="nip" class="form-label">NIP</label>
        <input type="number" class="form-control @error('nip') is-invalid @enderror" placeholder="Masukan NIP"
            name="nip" value="{{ isset($data) ? $data->nip : old('nip') }}" style=" font-size: 15px; height: 6.5vh;"
            required id="nip">
        @error('nip')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukan Email"
            name="email" value="{{ isset($data) ? $data->email : old('email') }}"
            style=" font-size: 15px; height: 6.5vh;" required id="email">
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
            style=" font-size: 15px; height: 6.5vh;" required id="tempat_lahir">
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
            style=" font-size: 15px; height: 6.5vh;" required id="tanggal_lahir">
        @error('tanggal_lahir')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="agama_id" class="form-label">Agama</label>
        <select class="form-select @error('agama_id') is-invalid @enderror" id="agama_id" name="ref_agama_id"
            value="{{ old('agama_id') }}" style=" font-size: 15px; height: 6.5vh;" required>
            <option value="">Pilih Agama</option>
            @foreach ($agamas as $agama)
            @if (isset($data) && $data->ref_agama_id)
            <option value="{{ $agama->id }}" {{ $data->ref_agama_id == $agama->id ? 'selected' : '' }}>{{ $agama->nama
                }}
            </option>
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
            value="{{ old('jk') }}" style=" font-size: 15px; height: 6.5vh;" required id="jk">
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
            value="{{ old('mapel[]') }}" style=" font-size: 15px; height: 6.5vh;" required multiple id="mapel">
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
        @error('mapel[]')
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
            @if (isset($data) ? ($data->ref_provinsi_id == $provinsi->id ? 'selected' : '') : (old('ref_provinsi_id') == $provinsi->id ? 'selected' : ''))
            <option value="{{ $provinsi->id }}" selected>{{ $provinsi->nama }}</option>
            @else
            <option value="{{ $provinsi->id }}">{{ $provinsi->nama }}</option>
            @endif
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
            style=" font-size: 15px; height: 6.5vh;" required id="jalan">
        @error('jalan')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password"
            name="password" style=" font-size: 15px; height: 6.5vh;" required id="password">
        @error('password')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
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
        <input type="file" class="form-control form-control-lg" name="profil" style=" font-size: 15px; height: 6.5vh;"
            id="foto_profil">
        @if (isset($data) && $data->profil != '/img/profil.png')
        <a href="{{ $data->profil }}" class="btn btn-primary">Show</a>
        @endif
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function(){
        setTimeout(() => {
            $('.between-input-item-select').select2();
        }, 500);
    })
</script>