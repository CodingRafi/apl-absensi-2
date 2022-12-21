@extends('mylayouts.main')

@section('tambahcss')
    <style>
        .nav-pills .show>.nav-link {
            background-color: transparent !important;
        }

        .dropdown-menu.show {
            top: .4rem !important;
            left: -8rem !important;
        }
    </style>
@endsection

@section('container')
    <div class="card">
        <div class="card-body">
            <div class="title d-flex justify-content-between">
                <h4 class="card-title">Create Kelompok</h4>
                <form action="{{ route('kelompok.index') }}" method="get">
                    @include('mypartials.tahunajaran')
                    <button class="btn btn-sm btn-danger text-white" style="min-width: 5vw;border-radius: 5px;font-weight: 500;">Kembali</button>
                </form>
            </div>
            @if (count($gurus) > 0)
            <form action="{{ route('kelompok.store')  }}" method="POST">
                @csrf
                <div class="mt-3 mb-3">
                    <label for="nama" class="form-label">Nama Kelompok</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" placeholder="Masukan nama kelompok" value="{{ old('nama') }}">
                    @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mt-3 mb-3">
                    <label for="jam_masuk" class="form-label">Jam Masuk</label>
                    <input type="time" class="form-control @error('jam_masuk') is-invalid @enderror" name="jam_masuk" id="jam_masuk" value="{{ old('jam_masuk') }}">
                    @error('jam_masuk')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mt-3 mb-3">
                    <label for="jam_pulang" class="form-label">Jam Pulang</label>
                    <input type="time" class="form-control @error('jam_pulang') is-invalid @enderror" name="jam_pulang" id="jam_pulang" value="{{ old('jam_pulang') }}">
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
            @else
            <div class="alert alert-primary" role="alert">
                Tidak ada guru
            </div>
            @endif
        </div>
    </div>
@endsection