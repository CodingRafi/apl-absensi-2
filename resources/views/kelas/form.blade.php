<form action="{{ (isset($data)) ? route('kelas.update', [$data->id]) : route('kelas.store') }}" method="POST">
    @csrf
    @if(isset($data))
    @method('patch')
    @endif
    @include('mypartials.tahunajaran')
    <div class="mb-3">
        <label for="tingkat_id" class="form-label">Tingkat</label>
        <select class="form-select @error('tingkat_id') is-invalid @enderror" name="tingkat_id" id="tingkat_id">
            <option selected>Pilih tingkat</option>
            @foreach (Auth::user()->sekolah->tingkat as $tingkat)
            <option value="{{ $tingkat->id }}" {{ isset($data) ? ($data->tingkat->id == $tingkat->id ? 'selected' : '') : (old('tingkat_id') == $tingkat->id ? 'selected' : '') }}>{{ $tingkat->romawi }}</option>
            @endforeach
          </select>
        @error('tingkat_id')
            <div class="invalid-feedback">
                {{ $message }}  
            </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="nama" class="form-label">Nama Kelas</label>
        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ isset($data) ? $data->nama : old('nama') }}" style=" font-size: 15px; height: 6.5vh;">
        @error('nama')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <button type="submit" class="btn text-white" style="background-color: #3bae9c">Simpan</button>
</form>