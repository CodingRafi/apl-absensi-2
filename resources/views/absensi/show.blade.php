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
        <h4 class="card-title float-left">Absensi {{ $absensis[0]['user']->name }}</h4>
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
                        @foreach ($absensi['absensis'] as $k => $row)
                        @if (strtolower(date("D", mktime(0, 0, 0, explode('-', $date[0])[1], $k+1, explode('-',
                        $date[0])[0]))) == 'sun')
                        <td class="bg-secondary" style="height: 2rem;"></td>
                        @else
                        @if ($row && $row->presensi_masuk)
                        @foreach ($status_kehadiran as $status)
                        @if ($status->id == $row->status_kehadiran_id)
                        <td class="text-white cell-table" style="background: {{ $status->color }}">{{
                            explode(':', explode(' ',$row->presensi_masuk)[1])[0] }}:{{
                            explode(':', explode(' ',$row->presensi_masuk)[1])[1] }}
                        </td>
                        @endif
                        @endforeach
                        @else
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;">
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
                        <td class="text-white cell-table" style="background: {{ $status->color }}">{{
                            explode(':', explode(' ',$row->presensi_pulang)[1])[0] }}:{{
                            explode(':', explode(' ',$row->presensi_pulang)[1])[1] }}
                        </td>
                        @endif
                        @endforeach
                        @else
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;">
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
@endsection
