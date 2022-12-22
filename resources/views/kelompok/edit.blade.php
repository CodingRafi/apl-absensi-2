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
                <h4 class="card-title">Edit Kelompok</h4>
                <form action="{{ route('kelompok.index') }}" method="get">
                    @include('mypartials.tahunajaran')
                    <button class="btn btn-sm btn-danger text-white" style="min-width: 5vw;border-radius: 5px;font-weight: 500;">Kembali</button>
                </form>
            </div>
            @if (count($gurus) > 0)
            @include('kelompok.form')
            @else
            <div class="alert alert-primary" role="alert">
                Tidak ada guru
            </div>
            <div class="d-flex justify-content-center"><button class="btn text-white"
                    style="background-color: #3bae9c; min-width: 6vw;">Simpan</button></div>
        </form>
        @else
        <div class="alert alert-primary" role="alert">
            Tidak ada guru
        </div>
        @endif
    </div>
</div>
@endsection