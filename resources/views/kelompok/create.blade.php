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

        /* .fstAll {
            display: none !important;
        } */

        /* .fstsearch{
          border: 1px solid rgb(205, 205, 205);
          margin: 0.5rem;
          width: 54rem;
        } */
    </style>
@endsection

@section('container')
    <div class="card">
        <div class="card-body">
            <div class="title d-flex justify-content-between">
                <h4 class="card-title">Create Kelompok</h4>
                <form action="/kelompok" method="get">
                    @include('mypartials.tahunajaran')
                    <button class="btn btn-sm btn-danger text-white font-weight-bold" style="min-width: 5vw;">Kembali</button>
                </form>
            </div>
            <div class="mt-3 mb-3">
                <label for="name" class="form-label">Nama Kelompok</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Masukan nama kelompok">
            </div>
            <div class="mb-3">
                <label for="namaGuru" class="form-label">Nama Guru</label>
                <select class="fstdropdown-select" name="namaGuru" style=" font-size: 15px; height: 6.5vh;" required multiple>
                    <option value="">Puguh Rismadi</option>
                    <option value="">Agus Diana</option>
                    <option value="">Hesti Hera</option>
                </select>
            </div>
            <button class="btn text-white" style="background-color: #3bae9c; min-width: 6vw;">Simpan</button>
        </div>
    </div>
@endsection

@section('tambahjs')
    <script src="/js/fstdropdown.js"></script>
    <script>
        setFstDropdown();
    </script>
@endsection