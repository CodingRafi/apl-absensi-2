@extends('mylayouts.main')

@section('tambahcss')
<style>
    @media (max-width: 647px) {

        .kelas,
        .jurusan {
            width: 33vw;
        }
    }

    @media (max-width: 647px) {
        .bulan {
            width: 22vw;
        }
    }

    @media (max-width: 647px) {
        .search {
            width: 32vw;
        }
    }
</style>
@endsection

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title float-left">Absensi {{ $role }}</h4>
        <ul class="nav float-right mb-4" style="gap: 1rem;">
            <li class="nav-item">
                <div class="input-group">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle bulan" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false"
                            style="border: 1px solid rgb(205, 205, 205); min-width: 5rem; height: 1.9rem; padding: 0.1rem">
                            Bulan
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1"
                            style="max-height: 50vh;overflow: auto;">
                            @foreach (config('services.bulan') as $key => $bulan)
                            <li>
                                <form action="" method="get">
                                    @include('mypartials.tahunajaran')
                                    @if (request('kelas'))
                                    <input type="hidden" name="kelas" value="{{ request('kelas') }}">
                                    @endif
                                    @if (request('jurusan'))
                                    <input type="hidden" name="jurusan" value="{{ request('jurusan') }}">
                                    @endif
                                    @if (request('search'))
                                    <input type="hidden" name="search" value="{{ request('search') }}">
                                    @endif
                                    <input type="hidden" name="bulan" value="{{ $key+1 }}">
                                    <button type="submit" class="dropdown-item">{{ $bulan }}</button>
                                </form>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <div class="input-group input-group-sm">
                    <form action="" method="get" style="display: flex; gap: 5px">
                        @include('mypartials.tahunajaran')
                        @if (request('bulan'))
                        <input type="hidden" name="bulan" value="{{ request('bulan') }}">
                        @endif
                        @if (request('kelas'))
                        <input type="hidden" name="kelas" value="{{ request('kelas') }}">
                        @endif
                        @if (request('jurusan') && check_jenjang())
                        <input type="hidden" name="jurusan" value="{{ request('jurusan') }}">
                        @endif
                        <input type="text" class="form-control search" placeholder="Search" style="height: 1.9rem;"
                            name="search" value="{{ request('search') ?? '' }}">
                        <button type="submit" class="btn"
                            style="border: 1px solid rgb(205, 205, 205); height: 1.9rem; width: 2.5rem; padding: 0.1rem"><i
                                class="bi bi-search"></i></button>
                    </form>
                </div>
            </li>
            @if ($role == 'siswa')
            <li class="nav-item">
                <div class="input-group">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle kelas" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false"
                            style="border: 1px solid rgb(205, 205, 205); height: 1.9rem; min-width: 5rem; padding: 0.1rem">
                            Kelas
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            @foreach ($kelas as $row)
                            <li>
                                <form action="" method="get">
                                    @include('mypartials.tahunajaran')
                                    @if (request('bulan'))
                                    <input type="hidden" name="bulan" value="{{ request('bulan') }}">
                                    @endif
                                    @if (request('jurusan') && check_jenjang())
                                    <input type="hidden" name="jurusan" value="{{ request('jurusan') }}">
                                    @endif
                                    @if (request('search'))
                                    <input type="hidden" name="search" value="{{ request('search') }}">
                                    @endif
                                    <input type="hidden" name="kelas" value="{{ $row->id }}">
                                    <button type="submit" class="dropdown-item">{{ $row->romawi }} {{ $row->nama }}</button>
                                </form>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </li>
            @if (check_jenjang())
            <li class="nav-item">
                <div class="input-group">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle jurusan" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false"
                            style="border: 1px solid rgb(205, 205, 205); height: 1.9rem; min-width: 6rem; padding: 0.1rem">
                            Jurusan
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            @foreach ($kompetensis as $kompetensi)
                            <li>
                                <form action="" method="get">
                                    @include('mypartials.tahunajaran')
                                    <input type="hidden" name="jurusan" value="{{ $kompetensi->id }}">
                                    @if (request('bulan'))
                                    <input type="hidden" name="bulan" value="{{ request('bulan') }}">
                                    @endif
                                    @if (request('kelas'))
                                    <input type="hidden" name="kelas" value="{{ request('kelas') }}">
                                    @endif
                                    @if (request('search'))
                                    <input type="hidden" name="search" value="{{ request('search') }}">
                                    @endif
                                    <button type="submit" class="dropdown-item">{{ $kompetensi->kompetensi }}</button>
                                </form>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </li>
            @endif
            @endif
            <li class="nav-item">
                <form action="{{ route('absensi.export', [$role]) }}" method="get">
                    @include('mypartials.tahunajaran')
                    @if (request('kelas'))
                    <input type="hidden" name="kelas" value="{{ request('kelas') }}">
                    @endif
                    @if (request('bulan'))
                    <input type="hidden" name="bulan" value="{{ request('bulan') }}">
                    @endif
                    @if (request('jurusan'))
                    <input type="hidden" name="jurusan" value="{{ request('jurusan') }}">
                    @endif
                    @if (request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    <button type="submit" class="btn btn-sm text-white px-3"
                        style="background-color: #3bae9c;border-radius: 5px;font-weight: 500;">Export</button>
                </form>
            </li>
        </ul>
        <ul class="nav mb-4 justify-content-end" style="gap: 1rem; clear: right !important;">
            @foreach ($status_kehadiran as $status)
            <li class="nav-item d-flex align-items-center" style="gap: .3rem">
                <span class="d-inline-block"
                    style="background-color: {{ $status->color }};width: 1rem;height:1rem;"></span>
                {{ $status->nama }}
            </li>
            @endforeach
        </ul>
        @if(session()->has('message'))
        <div class="alert alert-success" role="alert"></div>
        {{ session('message') }}
        @endif

        <div class="table-responsive">
            <div id='calendar'></div>
            <table class="table text-center">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" rowspan="2" style="vertical-align: middle;">No</th>
                        <th scope="col" rowspan="2" style="vertical-align: middle;">Nama</th>
                        <th scope="col" colspan="{{ count($date) }}">{{ date("F", mktime(0, 0, 0, explode('-',
                            $date[0])[1], 10)) }}</th>
                    </tr>
                    <tr>
                        @foreach ($date as $dt)
                        <th scope="col">{{ explode('-', $dt)[2] }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($absensis as $key => $absensi)
                    <tr>
                        <th scope="row" rowspan="2" style="vertical-align: middle;">{{ $loop->iteration }}</th>
                        <td rowspan="2" style="vertical-align: middle;">{{ $absensi['user']->name }}</td>
                        @foreach ($absensi['absensis'] as $k => $row)
                        @if (strtolower(date("D", mktime(0, 0, 0, explode('-', $date[0])[1], $k+1, explode('-',
                        $date[0])[0]))) == 'sun')
                        <td class="bg-secondary" style="height: 2rem;"></td>
                        @else
                        @if ($row && $row->presensi_masuk)
                        @foreach ($status_kehadiran as $status)
                        @if ($status->id == $row->status_kehadiran_id)
                        <td class="text-white cell-table" style="cursor: pointer;background: {{ $status->color }}"
                            data-presensi="masuk"
                            onclick="edit(this, {{ $absensi['user']->id }}, '{{ $date[$k] }}', {{ $row->id }})">{{
                            explode(':', explode(' ',$row->presensi_masuk)[1])[0] }}:{{
                            explode(':', explode(' ',$row->presensi_masuk)[1])[1] }}
                        </td>
                        @endif
                        @endforeach
                        @else
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"
                            onclick="edit(this, {{ $absensi['user']->id }}, '{{ $date[$k] }}')" data-presensi="masuk">
                        </td>
                        @endif
                        @endif
                        @endforeach
                    </tr>
                    <tr>
                        @foreach ($absensi['absensis'] as $k => $row)
                        @if (strtolower(date("D", mktime(0, 0, 0, explode('-', $date[0])[1], $k+1, explode('-',
                        $date[0])[0]))) == 'sun')
                        <td class="bg-secondary" style="height: 2rem;"></td>
                        @else
                        @if ($row && $row->presensi_pulang)
                        @foreach ($status_kehadiran as $status)
                        @if ($status->id == $row->status_kehadiran_id)
                        <td class="text-white cell-table" style="cursor: pointer;background: {{ $status->color }}"
                            data-presensi="pulang"
                            onclick="edit(this, {{ $absensi['user']->id }}, '{{ $date[$k] }}', {{ $row->id }})">{{
                            explode(':', explode(' ',$row->presensi_pulang)[1])[0] }}:{{
                            explode(':', explode(' ',$row->presensi_pulang)[1])[1] }}
                        </td>
                        @endif
                        @endforeach
                        @else
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"
                            onclick="edit(this, {{ $absensi['user']->id }}, '{{ $date[$k] }}')" data-presensi="pulang">
                        </td>
                        @endif
                        @endif
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="edit-absensi">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Presensi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 15px;">
                <form action="{{ route("absensi.store_update", [$role]) }}" method="post" class="form-presensi">
                    @csrf
                    <input type="hidden" name="user_id" class="user_id">
                    <input type="hidden" name="date" class="date">
                    <input type="hidden" name="presensi" class="presensi">
                    <div class="card-body">
                        <div class="mb-3 div-keterangan">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <select class="form-control text-dark select-kehadiran" name="status_kahadiran_id" required
                                id="keterangan">
                                <option value="" selected>Pilih keterangan</option>
                                @foreach ($status_kehadiran as $status)
                                <option value="{{ $status->id }}">{{ $status->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 ">
                            <label for="waktu" class="form-label">Waktu</label>
                            <input type="time" name="waktu" class="form-control" id="waktu">
                        </div>
                        <button type="submit" class="btn text-white float-right"
                            style="background-color: #3bae9c">Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('tambahjs')
<script>
    function edit(el, user_id, date, id = null){
        let data_presensi = $(el).attr('data-presensi');
        $('.form-presensi input[name="_method"]').remove();
        $('.form-presensi input[name="date"]').val(date)
        $('.form-presensi input[name="user_id"]').val(user_id)
        $('.form-presensi input[name="presensi"]').val(data_presensi)
        
        if (data_presensi == 'masuk') {
            $('.div-keterangan').css('display', 'block');
        }else{
            $('.div-keterangan').css('display', 'none');
        }

        if (id) {
            // $('<input>').attr('type','hidden').attr('name', '_method').val('patch').appendTo('.form-presensi');
            $.get('/absensi/{{ $role }}/' + id, function(response){
                $('.form-presensi select option').each((i,e)=>{
                    if ($(e).attr('value') == response.data.status_kehadiran_id) {
                        $(e).attr('selected', 'selected')
                    }
                })

                if ($(el).attr('data-presensi') == 'masuk') {
                    $('.form-presensi input[name="waktu"]').val(response.data.presensi_masuk.split(' ')[1])
                }else{
                    $('.form-presensi input[name="waktu"]').val(response.data.presensi_pulang.split(' ')[1])
                }

                $('#edit-absensi').modal('show');
            })
        }else{
            $('#edit-absensi').modal('show');
        }
    }

    $('#edit-absensi .close').on('click', function(){
        $('#edit-absensi form')[0].reset();
        $('#edit-absensi').modal('hide')
    });
</script>
@endsection