@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Create Kelas</h4>
        <form action="{{ route('kelas.store') }}" method="POST">
            @csrf
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
    </div>
</div>
@endsection