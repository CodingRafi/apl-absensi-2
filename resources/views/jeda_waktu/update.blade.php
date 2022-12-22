@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Update Kelas</h4>
        <form action="/tenggat/{{ $jeda->id }}" method="POST">
            @csrf
            @method('patch')
            @include('mypartials.tahunajaran')
           <div class="mb-3">
                <label for="jam_masuk" class="form-label">Jam Masuk</label>
                <input type="time" class="form-control @error('jam_masuk') is-invalid @enderror" id="jam_masuk" name="jam_masuk" value="{{ isset($data) ? $data->jam_masuk : old('jam_masuk') }}" required>
                @error('jam_masuk')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="jam_pulang" class="form-label">Jam Pulang</label>
                <input type="time" class="form-control @error('jam_pulang') is-invalid @enderror" id="jam_pulang" name="jam_pulang" value="{{ isset($data) ? $data->jam_pulang : old('jam_pulang') }}" required>
                @error('jam_pulang')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn text-white" style="background-color: #3bae9c">Simpan</button>
        </form>
    </div>
</div>
@endsection