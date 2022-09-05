@extends('mylayouts.main')

@section('tambahcss')
    <style>
        @media (max-width: 400px) {
            .search{
                width: 36vw;
            }
        }
        @media (max-width: 400px) {
            .bulan{
                width: 22vw;
            }
        }

        @media (max-width: 400px) {
            .jurusan{
                width: 18rem;
            }
        }
    </style>
@endsection

@section('container')
<div class="card">
    <input type="hidden" name="" value="{{ $role }}" class="role">
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
            @if ($role == 'siswa')
            <li class="nav-item">
                <div class="input-group input-group-sm">
                    <form action="" method="get" style="display: flex; gap:5px;">
                        @include('mypartials.tahunajaran')
                        <input type="text" class="form-control search" placeholder="Search" name="s_siswa" style="height: 1.9rem">
                        <button type="submit" class="btn" style="border: 1px solid rgb(205, 205, 205); height: 1.9rem; width: 2.5rem; padding: 0.1rem"><i class="bi bi-search"></i></button>
                    </form>
                </div>
            </li>
            @if (count($kelas_filter) > 0)       
            <li class="nav-item">
                <div class="input-group">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false" style="border: 1px solid rgb(205, 205, 205); height: 1.9rem; padding: 0.1rem">
                            Kelas
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            @foreach ($kelas_filter as $kelas)
                            <li>
                                <form action="" method="get">
                                    @include('mypartials.tahunajaran')
                                    @if (request('idb'))
                                        <input type="hidden" name="idb" value="{{ request('idb') }}">
                                    @endif
                                    <input type="hidden" name="idk" value="{{ $kelas->id }}">
                                    <button type="submit" class="dropdown-item">{{ $kelas->nama }}</button>
                                </form>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </li>
            @endif
            @if ( Auth::user()->sekolah->tingkat == 'smk' )
            <li class="nav-item">
                <div class="input-group">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle jurusan" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false" style="border: 1px solid rgb(205, 205, 205); height: 1.9rem; padding: 0.1rem">
                            Jurusan
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            @foreach ($kompetensis as $kompetensi)
                            <li>
                                <form action="" method="get">
                                    @include('mypartials.tahunajaran')
                                    <input type="hidden" name="idj" value="{{ $kompetensi->id }}">
                                    @if (request('idb'))
                                        <input type="hidden" name="idb" value="{{ request('idb') }}">
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
            @else
            <li class="nav-item">
                <div class="input-group input-group-sm">
                    <form action="" method="get" style="display: flex; gap: 5px">
                        @include('mypartials.tahunajaran')
                        <input type="text" class="form-control search" placeholder="Search" style="height: 1.9rem;" name="s_user">
                        <button type="submit" class="btn" style="border: 1px solid rgb(205, 205, 205); height: 1.9rem; width: 2.5rem; padding: 0.1rem"><i class="bi bi-search"></i></button>
                    </form>
                </div>
            </li>
            @endif
            {{-- <li class="nav-item">
                <form action="/export/absensi" method="get">
                    @include('mypartials.tahunajaran')
                    @if (request('idk'))
                        <input type="hidden" name="idk" value="{{ request('idk') }}">
                    @endif
                    @if (request('idb'))
                        <input type="hidden" name="idb" value="{{ request('idb') }}">
                    @endif
                    @if (request('idj'))
                        <input type="hidden" name="idj" value="{{ request('idj') }}">
                    @endif
                    @if (request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    <input type="hidden" name="role" value="{{ $role }}">
                    <button type="submit" class="btn btn-sm text-white font-weight-bold px-3"
                    style="background-color: #3bae9c">Export</button>
                </form>
            </li> --}}
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
                        <th scope="col" rowspan="2" style="vertical-align: middle;">No</th>
                        <th scope="col" rowspan="2" style="vertical-align: middle;">Nama</th>
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
                        <th scope="row" rowspan="2" style="vertical-align: middle;">{{ $loop->iteration }}</th>
                            @if ($role == 'siswa')
                            <td rowspan="2" style="vertical-align: middle;">{{ $siswas[$key]->name }}</td>
                            @else
                            <td rowspan="2" style="vertical-align: middle;">{{ $users[$key]->name }}</td>
                            @endif
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
                                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;" data-toggle="modal"
                                            data-target="#ubah-absen" style="cursor: pointer;"data-presensi="masuk" data-user-id="{{ $users[$key]->id }}" data-rfid="{{ $users[$key]->rfid->id }}" data-date="{{ date("Y-m-d", mktime(0, 0, 0, explode('-', $date[0])[1], $k+1, explode('-', $date[0])[0])) }}"></td>
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
                                           <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;" data-toggle="modal"
                                           data-target="#ubah-absen" style="cursor: pointer;" data-presensi="pulang" data-user-id="{{ $users[$key]->id }}" data-rfid="{{ $users[$key]->rfid->id }}" data-date="{{ date("Y-m-d", mktime(0, 0, 0, explode('-', $date[0])[1], $k+1, explode('-', $date[0])[0])) }}"></td>
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
<div class="modal fade" id="ubah-absen">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Presensi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/absensi" method="post" class="form-presensi">
                    @csrf
                    <input type="hidden" name="presensi" class="presensi" disabled>
                    <input type="hidden" name="table" class="table" value="{{ $role }}">
                    <input type="hidden" name="siswa_id" class="siswa_id" disabled>
                    <input type="hidden" name="user_id" class="user_id" disabled>
                    <input type="hidden" name="kelas_id" class="kelas_id" disabled>
                    <input type="hidden" name="rfid_id" class="rfid_id" disabled>
                    <input type="hidden" name="date" class="date" disabled>
                    <input type="hidden" name="id" class="id" disabled>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="bidang" class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <select class="form-control text-dark select-kehadiran" name="kehadiran" required>
                                    <option value="" selected>Pilih keterangan</option>
                                    <option value="hadir">Hadir</option>
                                    <option value="sakit">Sakit</option>
                                    <option value="izin">Izin</option>
                                    <option value="alpha">Alpha</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row form-group-time" style="display: none;">
                            <label for="bidang" class="col-sm-2 col-form-label">Waktu</label>
                            <div class="col-sm-10">
                                <input type="time" name="waktu" id="" class="input-time form-control">
                            </div>
                        </div>
                        <button type="submit" class="btn text-white float-right" style="background-color: #3bae9c">Simpan
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
    const cellTable = document.querySelectorAll('.cell-table');
    const modalTitle = document.querySelector('.modal-title');
    const input_presensi = document.querySelector('.presensi');
    const siswa_id = document.querySelector('.siswa_id');
    const user_id = document.querySelector('.user_id');
    const kelas_id = document.querySelector('.kelas_id');
    const rfid_id = document.querySelector('.rfid_id');
    const date = document.querySelector('.date');
    const role = document.querySelector('.role');
    const id = document.querySelector('.id');
    const select = document.querySelector('.select-kehadiran');
    const formGroup = document.querySelector('.form-group-time');
    const inputTime = document.querySelector('.input-time');
    const formPresensi = document.querySelector('.form-presensi');
    
    cellTable.forEach(e => {
        e.addEventListener('click', function(e){
            modalTitle.innerHTML = 'Presensi ' + e.target.getAttribute('data-presensi');

            if (e.target.getAttribute('data-bool-absen') == 'true') {
                formPresensi.setAttribute('action', '');
                formPresensi.setAttribute('action', '/absensi/' + e.target.getAttribute('data-id'));
                select.value = '';
                select.value = e.target.getAttribute('data-kehadiran');
                input_presensi.removeAttribute('disabled');
                input_presensi.value = e.target.getAttribute('data-presensi');
                date.removeAttribute('disabled');
                date.value = e.target.getAttribute('data-date');
                if (e.target.getAttribute('data-kehadiran') == 'hadir') {
                    formGroup.style.display = 'block';
                    inputTime.value = '00:00';
                    inputTime.value = e.target.getAttribute('data-jam') + ':' + e.target.getAttribute('data-menit')
                }
            }else{
                formPresensi.setAttribute('action', '');
                formPresensi.setAttribute('action', '/absensi');
                if (role.value == 'siswa') {
                    siswa_id.removeAttribute('disabled');
                    siswa_id.value = e.target.getAttribute('data-siswa-id');
                    kelas_id.removeAttribute('disabled');
                    kelas_id.value = e.target.getAttribute('data-kelas-id');
                }else{
                    user_id.removeAttribute('disabled');
                    user_id.value = e.target.getAttribute('data-user-id');
                }
                rfid_id.removeAttribute('disabled');
                rfid_id.value = e.target.getAttribute('data-rfid');
                input_presensi.removeAttribute('disabled');
                input_presensi.value = e.target.getAttribute('data-presensi');
                date.removeAttribute('disabled');
                date.value = e.target.getAttribute('data-date');
            }
        })
    });

    select.addEventListener('change', function(e){
        if(e.target.value == 'hadir'){
            formGroup.style.display = 'block';
            inputTime.required = true;
        }else{
            formGroup.style.display = 'none';
            inputTime.required = false;
        }
    })
</script>
@endsection