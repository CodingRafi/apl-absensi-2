<form action="{{ (isset($data)) ? route('kompetensi.update', [$data->id]) : route('kompetensi.store') }}" method="POST">
    @csrf
    @if(isset($data))
    @method('patch')
    @endif
    @include('mypartials.tahunajaran')
    <div class="mb-3">
        <label for="kompetensi" class="form-label">Kompetensi Keahlian</label>
        <input type="text" class="form-control @error('kompetensi') is-invalid @enderror" id="kompetensi" name="kompetensi" value="{{ isset($data) ? $data->kompetensi : old('kompetensi') }}" style=" font-size: 15px; height: 6.5vh;" required>
        @error('kompetensi')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="program" class="form-label">Program Keahlian</label>
        <input type="text" class="form-control @error('program') is-invalid @enderror" id="program" name="program" value="{{ isset($data) ? $data->program : old('program') }}" style=" font-size: 15px; height: 6.5vh;" required>
        @error('program')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="bidang" class="form-label">Bidang Keahlian</label>
        <input type="text" class="form-control @error('bidang') is-invalid @enderror" id="bidang" name="bidang" value="{{ isset($data) ? $data->bidang : old('bidang') }}" style=" font-size: 15px; height: 6.5vh;" required>
        @error('bidang')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <button type="submit" class="btn text-white" style="background-color: #3bae9c">Simpan</button>
</form>