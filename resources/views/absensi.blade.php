@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title float-left">Absensi {{ $role }}</h4>
        <ul class="nav float-right mb-4" style="gap: 1rem;">
            <li class="nav-item">
                <div class="input-group">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false"
                            style="border: 1px solid rgb(205, 205, 205); height: 1.9rem; width: 7rem; padding: 0.1rem">
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
                    <form action="" method="get">
                        @include('mypartials.tahunajaran')
                        <input type="text" class="form-control" placeholder="Search" style="height: 29px;" name="s_siswa">
                        <button type="submit" class="btn" style="border: 1px solid rgb(205, 205, 205); height: 1.9rem; width: 2.5rem; padding: 0.1rem"><i class="bi bi-search"></i></button>
                    </form>
                </div>
            </li>
            <li class="nav-item">
                <div class="input-group">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false" style="border: 1px solid rgb(205, 205, 205); height: 1.9rem; width: 5rem; padding: 0.1rem">
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
            @if ( Auth::user()->sekolah->tingkat == 'smk' )
            <li class="nav-item">
                <div class="input-group">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false" style="border: 1px solid rgb(205, 205, 205); height: 1.9rem; width: 7rem; padding: 0.1rem">
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
                    <form action="" method="get">
                        @include('mypartials.tahunajaran')
                        <input type="text" class="form-control" placeholder="Search" style="height: 29px;" name="s_user">
                        <button type="submit" class="btn" style="border: 1px solid rgb(205, 205, 205); height: 1.9rem; width: 2.5rem; padding: 0.1rem"><i class="bi bi-search"></i></button>
                    </form>
                </div>
            </li>
            @endif
            <li class="nav-item">
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
                            {{-- @dd(explode('-', $date[0])) --}}
                            {{-- @dd(date("D", mktime(0, 0, 0, explode('-', $date[0])[1], $k, explode('-', $date[0])[0]))) --}}
                            @if ($sigleAbsensi)
                                    <td class="bg-success">
                                        <form action="detail-absensi-siswa" method="get">
                                            @include('mypartials.tahunajaran')
                                            <button class="btn text-white">{{ explode(':', explode(' ',$sigleAbsensi->presensi_masuk)[1])[0] }}:{{ explode(':', explode(' ',$sigleAbsensi->presensi_masuk)[1])[1] }}</button>
                                        </form>
                                    </td>
                                @else
                                    @if (strtolower(date("D", mktime(0, 0, 0, explode('-', $date[0])[1], $k+1, explode('-', $date[0])[0]))) == 'sun')
                                        <td class="bg-secondary" style="height: 2rem;"></td>
                                    @else
                                        <td></td>
                                    @endif
                                @endif
                            @endforeach
                        </tr>
                        <tr>
                            @foreach ($absensi as $k => $sigleAbsensi)
                                @if ($sigleAbsensi)
                                    <td class="bg-success">
                                        <form action="detail-absensi-siswa" method="get">
                                            @include('mypartials.tahunajaran')
                                            <button class="btn text-white">{{ explode(':', explode(' ',$sigleAbsensi->presensi_pulang)[1])[0] }}:{{ explode(':', explode(' ',$sigleAbsensi->presensi_pulang)[1])[1] }}</button>
                                        </form>
                                    </td>
                                @else
                                @if (strtolower(date("D", mktime(0, 0, 0, explode('-', $date[0])[1], $k+1, explode('-', $date[0])[0]))) == 'sun')
                                <td class="bg-secondary" style="height: 2rem;"></td>
                            @else
                                <td></td>
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

@section('tambahjs')
<script>
    // var dt = new Date();
    // console.log(dt)
    // var month = dt.getMonth();
    // console.log(month)
    // var year = dt.getFullYear();
    // console.log(year)
    // daysInMonth = new Date(year, month, 0).getDate();

    // function getDayNamesInMonth(month, year) {
    //     let date = new Date(year, month, 1);
    //     let days = [];
    //     while (date.getMonth() === month) {
    //         days.push(new Date(date).toLocaleDateString('en-ID', { weekday: 'short' }));
    //         date.setDate(date.getDate() + 1);
    //     }
    //     return dayNames;
    // }

    // console.log(daysInMonth)
</script>
@endsection