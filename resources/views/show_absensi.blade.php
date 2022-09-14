@extends('mylayouts.main')

@section('tambahcss')
    <style>
        @media (max-width: 647px) {
            .kelas, .jurusan{
                width: 33vw;
            }
        }

        @media (max-width: 647px) {
            .bulan{
                width: 22vw;
            }
        }

        @media (max-width: 647px) {
            .search{
                width: 32vw;
            }
        }
    </style>
@endsection

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title float-left">Presensi</h4>
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
                            <li>
                                <form action="" method="get">
                                    @include('mypartials.tahunajaran')
                                    @if (request('idk'))
                                        <input type="hidden" name="idk" value="{{ request('idk') }}">
                                    @endif
                                    @if (request('idj'))
                                        <input type="hidden" name="idj" value="{{ request('idj') }}">
                                    @endif
                                    <input type="hidden" name="idb" value="1">
                                    <button type="submit" class="dropdown-item">Januari</button>
                                </form>
                            </li>
                            <li>
                                <form action="" method="get">
                                    @include('mypartials.tahunajaran')
                                    @if (request('idk'))
                                        <input type="hidden" name="idk" value="{{ request('idk') }}">
                                    @endif
                                    @if (request('idj'))
                                        <input type="hidden" name="idj" value="{{ request('idj') }}">
                                    @endif
                                    <input type="hidden" name="idb" value="2">
                                    <button type="submit" class="dropdown-item">Februari</button>
                                </form>
                            </li>
                            <li>
                                <form action="" method="get">
                                    @include('mypartials.tahunajaran')
                                    @if (request('idk'))
                                        <input type="hidden" name="idk" value="{{ request('idk') }}">
                                    @endif
                                    @if (request('idj'))
                                        <input type="hidden" name="idj" value="{{ request('idj') }}">
                                    @endif
                                    <input type="hidden" name="idb" value="3">
                                    <button type="submit" class="dropdown-item">Maret</button>
                                </form>
                            </li>
                            <li>
                                <form action="" method="get">
                                    @include('mypartials.tahunajaran')
                                    @if (request('idk'))
                                        <input type="hidden" name="idk" value="{{ request('idk') }}">
                                    @endif
                                    @if (request('idj'))
                                        <input type="hidden" name="idj" value="{{ request('idj') }}">
                                    @endif
                                    <input type="hidden" name="idb" value="4">
                                    <button type="submit" class="dropdown-item">April</button>
                                </form>
                            </li>
                            <li>
                                <form action="" method="get">
                                    @include('mypartials.tahunajaran')
                                    @if (request('idk'))
                                        <input type="hidden" name="idk" value="{{ request('idk') }}">
                                    @endif
                                    @if (request('idj'))
                                        <input type="hidden" name="idj" value="{{ request('idj') }}">
                                    @endif
                                    <input type="hidden" name="idb" value="5">
                                    <button type="submit" class="dropdown-item">Mei</button>
                                </form>
                            </li>
                            <li>
                                <form action="" method="get">
                                    @include('mypartials.tahunajaran')
                                    @if (request('idk'))
                                        <input type="hidden" name="idk" value="{{ request('idk') }}">
                                    @endif
                                    @if (request('idj'))
                                        <input type="hidden" name="idj" value="{{ request('idj') }}">
                                    @endif
                                    <input type="hidden" name="idb" value="6">
                                    <button type="submit" class="dropdown-item">Juni</button>
                                </form>
                            </li>
                            <li>
                                <form action="" method="get">
                                    @include('mypartials.tahunajaran')
                                    @if (request('idk'))
                                        <input type="hidden" name="idk" value="{{ request('idk') }}">
                                    @endif
                                    @if (request('idj'))
                                        <input type="hidden" name="idj" value="{{ request('idj') }}">
                                    @endif
                                    <input type="hidden" name="idb" value="7">
                                    <button type="submit" class="dropdown-item">Juli</button>
                                </form>
                            </li>
                            <li>
                                <form action="" method="get">
                                    @include('mypartials.tahunajaran')
                                    @if (request('idk'))
                                        <input type="hidden" name="idk" value="{{ request('idk') }}">
                                    @endif
                                    @if (request('idj'))
                                        <input type="hidden" name="idj" value="{{ request('idj') }}">
                                    @endif
                                    <input type="hidden" name="idb" value="8">
                                    <button type="submit" class="dropdown-item">Agustus</button>
                                </form>
                            </li>
                            <li>
                                <form action="" method="get">
                                    @include('mypartials.tahunajaran')
                                    @if (request('idk'))
                                        <input type="hidden" name="idk" value="{{ request('idk') }}">
                                    @endif
                                    @if (request('idj'))
                                        <input type="hidden" name="idj" value="{{ request('idj') }}">
                                    @endif
                                    <input type="hidden" name="idb" value="9">
                                    <button type="submit" class="dropdown-item">September</button>
                                </form>
                            </li>
                            <li>
                                <form action="" method="get">
                                    @include('mypartials.tahunajaran')
                                    @if (request('idk'))
                                        <input type="hidden" name="idk" value="{{ request('idk') }}">
                                    @endif
                                    @if (request('idj'))
                                        <input type="hidden" name="idj" value="{{ request('idj') }}">
                                    @endif
                                    <input type="hidden" name="idb" value="10">
                                    <button type="submit" class="dropdown-item">Oktober</button>
                                </form>
                            </li>
                            <li>
                                <form action="" method="get">
                                    @include('mypartials.tahunajaran')
                                    @if (request('idk'))
                                        <input type="hidden" name="idk" value="{{ request('idk') }}">
                                    @endif
                                    @if (request('idj'))
                                        <input type="hidden" name="idj" value="{{ request('idj') }}">
                                    @endif
                                    <input type="hidden" name="idb" value="11">
                                    <button type="submit" class="dropdown-item">November</button>
                                </form>
                            </li>
                            <li>
                                <form action="" method="get">
                                    @include('mypartials.tahunajaran')
                                    @if (request('idk'))
                                        <input type="hidden" name="idk" value="{{ request('idk') }}">
                                    @endif
                                    @if (request('idj'))
                                        <input type="hidden" name="idj" value="{{ request('idj') }}">
                                    @endif
                                    <input type="hidden" name="idb" value="12">
                                    <button type="submit" class="dropdown-item">Desember</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
        <ul class="nav mb-4 justify-content-end" style="gap: 1rem; clear: right !important;">
            <li class="nav-item">
                <span class="badge badge-pill badge-success" style="color: rgba(0, 0, 0, 0)">1</span>
                Hadir
            </li>
            <li class="nav-item">
                <span class="badge badge-pill"
                    style="background: rgba(226, 138, 7, 1); color: rgba(0, 0, 0, 0)">1</span>
                Sakit
            </li>
            <li class="nav-item">
                <span class="badge badge-pill"
                    style="background: rgba(243, 248, 10, 1); color: rgba(0, 0, 0, 0)">1</span>
                Izin
            </li>
            <li class="nav-item">
                <span class="badge badge-pill badge-danger" style="color: rgba(0, 0, 0, 0)">1</span>
                Alpha
            </li>
            <li class="nav-item">
                <span class="badge badge-pill badge-secondary" style="color: rgba(0, 0, 0, 0)">1</span>
                Libur
            </li>
        </ul>

        <div class="table-responsive">
            <div id='calendar'></div>
            <table class="table text-center">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" colspan="{{ count($date) }}">{{ date("F", mktime(0, 0, 0, explode('-', $date[0])[1], 10)) }}</th>
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
                            @foreach ($absensi as $k => $sigleAbsensi)
                            {{-- @dd($sigleAbsensi) --}}
                            {{-- @dd($sigleAbsensi['presensi_pulang']) --}} 
                            {{-- @dd(explode('-', $date[0])) --}}
                            {{-- @dd(date("D", mktime(0, 0, 0, explode('-', $date[0])[1], $k, explode('-', $date[0])[0]))) --}}
                            {{-- @dd($absensi) --}}
                                @if ($sigleAbsensi)
                                    @if ($sigleAbsensi->kehadiran == 'hadir')
                                        <td class="bg-success text-white cell-table" data-toggle="modal"
                                        data-target="#ubah-absen" data-kehadiran="hadir" style="cursor: pointer;" data-bool-absen="true" data-presensi="masuk" data-id="{{ $sigleAbsensi->id }}" data-jam="{{ explode(':', explode(' ',$sigleAbsensi->presensi_masuk)[1])[0] }}" data-menit="{{ explode(':', explode(' ',$sigleAbsensi->presensi_masuk)[1])[1] }}" data-date="{{ date("Y-m-d", mktime(0, 0, 0, explode('-', $date[0])[1], $k+1, explode('-', $date[0])[0])) }}">{{ explode(':', explode(' ',$sigleAbsensi->presensi_masuk)[1])[0] }}:{{ explode(':', explode(' ',$sigleAbsensi->presensi_masuk)[1])[1] }}
                                        </td>
                                    @elseif($sigleAbsensi->kehadiran == 'sakit')
                                        <td class="cell-table" data-toggle="modal"
                                        data-target="#ubah-absen" data-bool-absen="true" data-kehadiran="sakit" style="cursor: pointer;border: 1px solid grey;background-color: #E28A07;" data-presensi="masuk" data-id="{{ $sigleAbsensi->id }}" data-date="{{ date("Y-m-d", mktime(0, 0, 0, explode('-', $date[0])[1], $k+1, explode('-', $date[0])[0])) }}">
                                        </td>
                                    @elseif($sigleAbsensi->kehadiran == 'izin')
                                        <td class="cell-table bg-warning" data-toggle="modal" data-kehadiran="izin"
                                        data-target="#ubah-absen" data-bool-absen="true" style="cursor: pointer;border: 1px solid grey;" data-kehadiran="izin" data-presensi="masuk" data-id="{{ $sigleAbsensi->id }}" data-date="{{ date("Y-m-d", mktime(0, 0, 0, explode('-', $date[0])[1], $k+1, explode('-', $date[0])[0])) }}">
                                        </td>
                                    @else
                                        <td class="cell-table bg-danger" data-toggle="modal" data-kehadiran="alpha"
                                        data-target="#ubah-absen" data-bool-absen="true" style="cursor: pointer;border: 1px solid grey;" data-kehadiran="alpha" data-presensi="masuk" data-id="{{ $sigleAbsensi->id }}" data-date="{{ date("Y-m-d", mktime(0, 0, 0, explode('-', $date[0])[1], $k+1, explode('-', $date[0])[0])) }}">
                                        </td>
                                    @endif
                                @else
                                    @if (strtolower(date("D", mktime(0, 0, 0, explode('-', $date[0])[1], $k+1, explode('-', $date[0])[0]))) == 'sun')
                                        <td class="bg-secondary" style="height: 2rem;"></td>
                                    @else
                                    {{-- @dd($siswas[2]->rfid) --}}
                                        @if ($role == 'siswa')
                                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;" data-toggle="modal"
                                            data-target="#ubah-absen" style="cursor: pointer;" data-bool-absen="false" data-presensi="masuk" data-siswa-id="{{ $siswas[$key]->id }}" data-kelas-id="{{ $siswas[$key]->kelas_id }}" data-rfid="{{ ($siswas[$key]->rfid) ? $siswas[$key]->rfid->id : '' }}" data-date="{{ date("Y-m-d", mktime(0, 0, 0, explode('-', $date[0])[1], $k+1, explode('-', $date[0])[0])) }}"></td>
                                        @else
                                            @if ($users[$key]->rfid)      
                                                <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;" data-toggle="modal"
                                                data-target="#ubah-absen" style="cursor: pointer;"data-presensi="masuk" data-user-id="{{ $users[$key]->id }}" data-rfid="{{ $users[$key]->rfid->id }}" data-date="{{ date("Y-m-d", mktime(0, 0, 0, explode('-', $date[0])[1], $k+1, explode('-', $date[0])[0])) }}"></td>
                                            @else
                                              <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>  
                                            @endif
                                        @endif
                                    @endif
                                @endif
                            @endforeach
                        </tr>
                        <tr>
                            @foreach ($absensi as $k => $sigleAbsensi)

                            {{-- @dd('oke') --}}
                            {{-- @dd($sigleAbsensi) --}}
                            {{-- @dd($sigleAbsensi['presensi_pulang'])  --}}
                            {{-- @dd($sigleAbsensi->presensi_pulang != null) --}}
                                @if ($sigleAbsensi && $sigleAbsensi->presensi_pulang)
                                    @if ($sigleAbsensi->kehadiran == 'hadir')
                                        <td class="bg-success text-white cell-table" data-toggle="modal"
                                        data-target="#ubah-absen" data-kehadiran="hadir" style="cursor: pointer;" data-bool-absen="true" data-presensi="pulang"  data-id="{{ $sigleAbsensi->id }}" data-jam="{{ explode(':', explode(' ',$sigleAbsensi->presensi_pulang)[1])[0] }}" data-menit="{{ explode(':', explode(' ',$sigleAbsensi->presensi_pulang)[1])[1] }}" data-date="{{ date("Y-m-d", mktime(0, 0, 0, explode('-', $date[0])[1], $k+1, explode('-', $date[0])[0])) }}">{{ explode(':', explode(' ',$sigleAbsensi->presensi_pulang)[1])[0] }}:{{ explode(':', explode(' ',$sigleAbsensi->presensi_pulang)[1])[1] }}
                                        </td>
                                    @elseif($sigleAbsensi->kehadiran == 'sakit')
                                        <td class="cell-table" data-toggle="modal"
                                        data-target="#ubah-absen" data-bool-absen="true" style="cursor: pointer;border: 1px solid grey;background-color: #E28A07;" data-kehadiran="sakit" data-presensi="pulang" data-id="{{ $sigleAbsensi->id }}" data-date="{{ date("Y-m-d", mktime(0, 0, 0, explode('-', $date[0])[1], $k+1, explode('-', $date[0])[0])) }}">
                                        </td>
                                    @elseif($sigleAbsensi->kehadiran == 'izin')
                                        <td class="cell-table bg-warning" data-toggle="modal"
                                        data-target="#ubah-absen" data-bool-absen="true" style="cursor: pointer;border: 1px solid grey;" data-kehadiran="izin" data-presensi="pulang" data-id="{{ $sigleAbsensi->id }}" data-date="{{ date("Y-m-d", mktime(0, 0, 0, explode('-', $date[0])[1], $k+1, explode('-', $date[0])[0])) }}">
                                        </td>
                                    @else
                                        <td class="cell-table bg-danger" data-toggle="modal"
                                        data-target="#ubah-absen" data-bool-absen="true" style="cursor: pointer;border: 1px solid grey;" data-kehadiran="alpha" data-presensi="pulang" data-id="{{ $sigleAbsensi->id }}" data-date="{{ date("Y-m-d", mktime(0, 0, 0, explode('-', $date[0])[1], $k+1, explode('-', $date[0])[0])) }}">
                                        </td>
                                    @endif
                                @else
                                    @if (strtolower(date("D", mktime(0, 0, 0, explode('-', $date[0])[1], $k+1, explode('-', $date[0])[0]))) == 'sun')
                                        <td class="bg-secondary" style="height: 2rem;"></td>
                                    @else
                                        @if ($role == 'siswa')
                                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;" data-toggle="modal"
                                            data-target="#ubah-absen" style="cursor: pointer;" data-bool-absen="false" data-presensi="keluar" data-siswa-id="{{ $siswas[$key]->id }}" data-kelas-id="{{ $siswas[$key]->kelas_id }}" data-rfid="{{ ($siswas[$key]->rfid) ? $siswas[$key]->rfid->id : '' }}" data-date="{{ date("Y-m-d", mktime(0, 0, 0, explode('-', $date[0])[1], $k+1, explode('-', $date[0])[0])) }}"></td>
                                        @else
                                            @if ($users[$key]->rfid)    
                                                <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;" data-toggle="modal"
                                                data-target="#ubah-absen" style="cursor: pointer;" data-presensi="pulang" data-user-id="{{ $users[$key]->id }}" data-rfid="{{ $users[$key]->rfid->id }}" data-date="{{ date("Y-m-d", mktime(0, 0, 0, explode('-', $date[0])[1], $k+1, explode('-', $date[0])[0])) }}"></td>
                                            @else
                                               <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td> 
                                            @endif
                                        @endif
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
