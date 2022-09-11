@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Create Tenggat Waktu</h4>
        <form action="/tenggat" method="POST">
            @csrf
            @include('mypartials.tahunajaran')
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" required>
                @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="jam_masuk" class="form-label">Jam Masuk</label>
                <input type="time" class="form-control @error('jam_masuk') is-invalid @enderror" id="jam_masuk" name="jam_masuk" value="{{ old('jam_masuk') }}" required>
                @error('jam_masuk')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="jam_pulang" class="form-label">Jam Pulang</label>
                <input type="time" class="form-control @error('jam_pulang') is-invalid @enderror" id="jam_pulang" name="jam_pulang" value="{{ old('jam_pulang') }}" required>
                @error('jam_pulang')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="jam_pulang" class="form-label">User</label>
                <select class="form-select" name="user" style="text-transform: capitalize;">
                    @foreach ($roles as $role)
                        @if ($role->name != 'yayasan' && $role->name != 'admin' && $role->name != 'super_admin')
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endif
                        @endforeach
                        <option value="siswa">Siswa</option>
                </select>
            </div>
            <button type="submit" class="btn text-white" style="background-color: #3bae9c">Simpan</button>
        </form>
    </div>
</div>
@endsection