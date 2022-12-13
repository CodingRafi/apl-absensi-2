@extends('mylayouts.main')

@section('tambahcss')
    <link rel="stylesheet" href="/css/fstdropdown.css">

    <style>
        .nav-pills .show>.nav-link {
            background-color: transparent !important;
        }

        .dropdown-menu.show {
            top: .4rem !important;
            left: -8rem !important;
        }

        .fstdropdown>.fstlist {
            min-height: 10rem !important;
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
                    <button class="btn btn-sm btn-danger text-white font-weight-bold" style="min-width: 5vw;">Kembali</button>
                </form>
            </div>
            @if (count($gurus) > 0)
            <form action="{{ route('kelompok.store')  }}" method="POST">
                @csrf
                <div class="mt-3 mb-3">
                    <label for="nama" class="form-label">Nama Kelompok</label>
                    <input type="text" class="form-control " name="nama" id="nama" placeholder="Masukan nama kelompok">
                </div>
                <div class="mt-3 mb-3">
                    <label for="jam_masuk" class="form-label">Jam Masuk</label>
                    <input type="time" class="form-control" name="jam_masuk" id="jam_masuk">
                </div>
                <div class="mt-3 mb-3">
                    <label for="jam_pulang" class="form-label">Jam Pulang</label>
                    <input type="time" class="form-control" name="jam_pulang" id="jam_pulang">
                </div>
                <div class="mb-3">
                    <label for="gurus" class="form-label">Guru</label>
                    <select class="fstdropdown-select" name="gurus[]" style=" font-size: 15px; height: 6.5vh;" multiple>
                        @foreach ($gurus as $guru)
                            <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                        @endforeach
                    </select>
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

@section('tambahjs')
    <script src="/js/fstdropdown.js"></script>
    <script>
        setFstDropdown();
    </script>
@endsection