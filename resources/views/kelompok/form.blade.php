<form action="{{ (isset($kelompok)) ? route('kelompok.update', [$kelompok->id]) : route('kelompok.store') }}" method="POST">
    @csrf
    @if (isset($kelompok))
        @method('patch')
    @endif
    <div class="mt-3 mb-3">
        <label for="nama" class="form-label">Nama Kelompok</label>
        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" placeholder="Masukan nama kelompok" value="{{ isset($kelompok) ? $kelompok->nama : old('nama') }}">
        @error('nama')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="gurus" class="form-label">Guru</label>
        <select class="fstdropdown-select @error('gurus') is-invalid @enderror" name="gurus[]" id="gurus" style=" font-size: 15px; height: 6.5vh;" multiple>
            @foreach ($gurus as $guru)
                @if (isset($kelompok))
                    @foreach ($kelompok->user as $user)
                        @if ($user->id == $guru->id)
                        <option value="{{ $guru->id }}" selected>{{ $guru->profile_user->name }}</option>
                        @else
                        <option value="{{ $guru->id }}">{{ $guru->profile_user->name }}</option>
                        @endif
                    @endforeach
                @else
                <option value="{{ $guru->id }}">{{ $guru->profile_user->name }}</option>
                @endif
            @endforeach
        </select>
        @error('gurus')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="d-flex justify-content-end"><button class="btn text-white" style="background-color: #3bae9c; min-width: 6vw;">Simpan</button></div>
</form>