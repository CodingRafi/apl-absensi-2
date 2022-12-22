<form action="{{ (isset($data)) ? route('kelompok.update', [$kelompok->id]) : route('kelompok.store') }}" method="POST">
    @csrf
    <div class="mt-3 mb-3">
        <label for="nama" class="form-label">Nama Kelompok</label>
        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" placeholder="Masukan nama kelompok" value="{{ isset($data) ? $data->nama : old('nama') }}">
        @error('nama')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mt-3 mb-3">
        <label for="jam_masuk" class="form-label">Jam Masuk</label>
        <input type="time" class="form-control @error('jam_masuk') is-invalid @enderror" name="jam_masuk" id="jam_masuk" value="{{ isset($data) ? $data->jam_masuk : old('jam_masuk') }}">
        @error('jam_masuk')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mt-3 mb-3">
        <label for="jam_pulang" class="form-label">Jam Pulang</label>
        <input type="time" class="form-control @error('jam_pulang') is-invalid @enderror" name="jam_pulang" id="jam_pulang" value="{{ isset($data) ? $data->jam_pulang : old('jam_pulang') }}">
        @error('jam_pulang')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="gurus" class="form-label">Guru</label>
        <select class="fstdropdown-select @error('gurus') is-invalid @enderror" name="gurus[]" id="gurus" style=" font-size: 15px; height: 6.5vh;" multiple>
            @foreach ($gurus as $guru)
                <option value="{{ $guru->id }}">{{ $guru->name }}</option>
            @endforeach
        </select>
        @error('gurus')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="d-flex justify-content-center"><button class="btn text-white" style="background-color: #3bae9c; min-width: 6vw;">Simpan</button></div>
</form>