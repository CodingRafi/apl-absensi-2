<form action="{{ (isset($data)) ? route('kelompok-jadwal.update', [$data->id]) : route('kelompok-jadwal.store') }}"
    method="POST">
    @csrf
    @if (isset($data))
    @method('patch')
    @endif
    @if (!isset($data))
    <input type="hidden" name="kelompok_id" value="{{ $id }}">
    @endif
    <div class="mb-3">
        <label for="hari" class="form-label">Hari</label>
        <select class="form-select @error('hari') is-invalid @enderror" name="hari"
            value="{{ isset($data) ? $data->hari : old('hari') }}" style=" font-size: 15px; height: 6.5vh;" id="hari">
            <option value="">Pilih Hari</option>
            @foreach (config('services.hari.value') as $hari)
            @if (isset($data))
                @if ($data->hari == $hari)
                <option value="{{ $hari }}" selected>{{ $hari }}</option>
                @else
                <option value="{{ $hari }}">{{ $hari }}</option>
                @endif
            @else
                @if (old('hari') == $hari)
                <option value="{{ $hari }}" selected>{{ $hari }}</option>
                @else
                <option value="{{ $hari }}">{{ $hari }}</option>
                @endif
            @endif
            @endforeach
        </select>
        @error('hari')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mt-3 mb-3">
        <label for="jam_masuk" class="form-label">Jam Masuk</label>
        <input type="time" class="form-control @error('jam_masuk') is-invalid @enderror" name="jam_masuk" id="jam_masuk"
            value="{{ isset($data) ? $data->jam_masuk : old('jam_masuk') }}">
        @error('jam_masuk')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mt-3 mb-3">
        <label for="jam_pulang" class="form-label">Jam Pulang</label>
        <input type="time" class="form-control @error('jam_pulang') is-invalid @enderror" name="jam_pulang"
            id="jam_pulang" value="{{ isset($data) ? $data->jam_pulang : old('jam_pulang') }}">
        @error('jam_pulang')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="d-flex justify-content-end"><button class="btn text-white"
            style="background-color: #3bae9c; min-width: 6vw;">Simpan</button></div>
</form>