@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title float-left">Absensi Siswa</h4>
        <ul class="nav float-right mb-4" style="gap: 1rem;">
            <li class="nav-item">
                <div class="input-group">
                    <select class="custom-select" id="inputGroupSelect02"
                        style="height: 30px; width: 100px; padding: 0; padding-left: 10px;">
                        <option selected>Bulan</option>
                        <option value="1">Januari</option>
                    </select>
                </div>
            </li>
            <li class="nav-item">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm"
                        placeholder="Search" style="height: 29px;">
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
                <span class="badge badge-pill"
                    style="background: rgba(235, 0, 255, 1); color: rgba(0, 0, 0, 0)">1</span>
                Terlambat
            </li>
            <li class="nav-item">
                <span class="badge badge-pill"
                    style="background: rgba(15, 210, 237, 1); color: rgba(0, 0, 0, 0)">1</span>
                Kegiatan Sekolah
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
                        <th scope="col" colspan="10">{{ explode('-', $date[0])[1] }}</th>
                    </tr>
                    <tr>
                        @foreach ($date as $dt)
                        <th scope="col">{{ explode('-', $dt)[2] }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <th scope="row" rowspan="2" style="vertical-align: middle;">1</th>
                        <td rowspan="2" style="vertical-align: middle;">Rafi Prasetya</td>
                        @foreach ($date as $item)
                        @foreach ($user->absensi as $absensi)
                        {{-- @dd(explode(':', explode(' ',$absensi->presensi_masuk)[1])) --}}
                        @if (explode( '-',$item)[0]. '-' . explode('-',$item)[1] . '-' . explode('-',$item)[2] == explode(' ',$absensi->presensi_masuk)[0])
                            
                        <td class="bg-success">
                            <form action="detail-absensi-siswa" method="get">
                                @if (request('tahun_awal'))
                                <input type="hidden" name="tahun_awal" value="{{ request('tahun_awal') }}">
                                @endif
                                @if (request('tahun_akhir'))
                                <input type="hidden" name="tahun_akhir" value="{{ request('tahun_akhir') }}">
                                @endif
                                @if (request('semester'))
                                <input type="hidden" name="semester" value="{{ request('semester') }}">
                                @endif
                                <button class="btn text-white">{{  explode(':', explode(' ',$absensi->presensi_masuk)[1])[0]  }}:{{ explode(':', explode(' ',$absensi->presensi_masuk)[1])[1] }}</button>
                            </form>
                        </td>                            
                        @endif
                        @endforeach
                        @endforeach
                    </tr>
                    <tr>
                        @foreach ($date as $item)
                        @foreach ($user->absensi as $absensi)
                        {{-- @dd($absensi) --}}
                        @if (explode( '-',$item)[0]. '-' . explode('-',$item)[1] . '-' . explode('-',$item)[2] == explode(' ',$absensi->presensi_pulang)[0])
                            
                        <td class="bg-success">
                            <form action="detail-absensi-siswa" method="get">
                                @if (request('tahun_awal'))
                                <input type="hidden" name="tahun_awal" value="{{ request('tahun_awal') }}">
                                @endif
                                @if (request('tahun_akhir'))
                                <input type="hidden" name="tahun_akhir" value="{{ request('tahun_akhir') }}">
                                @endif
                                @if (request('semester'))
                                <input type="hidden" name="semester" value="{{ request('semester') }}">
                                @endif
                                <button class="btn text-white">{{  explode(':', explode(' ',$absensi->presensi_pulang)[1])[0]  }}:{{ explode(':', explode(' ',$absensi->presensi_pulang)[1])[1] }}</button>
                            </form>
                        </td>
                        @endif
                        @endforeach
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