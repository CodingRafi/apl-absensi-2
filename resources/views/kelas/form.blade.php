<form action="{{ (isset($data)) ? route('kelas.update', [$data->id]) : route('kelas.store') }}" method="POST">
    @csrf
    @if(isset($data))
    @method('patch')
    @endif
    @include('mypartials.tahunajaran')
    <div class="mb-3">
        <label for="nama" class="form-label">Nama Kelas</label>
        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ isset($data) ? $data->nama : old('nama') }}" style=" font-size: 15px; height: 6.5vh;" required>
        @error('nama')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <button type="submit" class="btn text-white" style="background-color: #3bae9c">Simpan</button>
</form>