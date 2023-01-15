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
            <h4 class="card-title">Edit Kelompok Jadwal</h4>
            <form action="{{ route('kelompok.index', [$data->kelompok->id]) }}" method="get">
                @include('mypartials.tahunajaran')
                <button class="btn btn-sm btn-danger text-white"
                    style="min-width: 5vw;border-radius: 5px;font-weight: 500;">Kembali</button>
            </form>
        </div>
        @include('kelompok_jadwal.form')
    </div>
</div>
@endsection

@section('tambahjs')
@if ($errors->any())
<script>
    $(document).ready(function(){
        showAlert("{{ $errors->first('msg_error') }}", 'error');
    })
</script>
@endif
@endsection