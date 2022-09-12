<table>
    <thead>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Nama</th>
            <th colspan="{{ count($date) }}">{{ date("F", mktime(0, 0, 0, explode('-', $date[0])[1], 10)) }}</th>
        </tr>
        <tr>
            @foreach ($date as $dt)
            <th >{{ explode('-', $dt)[2] }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($absensis as $key => $absensi) 
        <tr>
            <th>{{ $loop->iteration }}</th>
                @if ($role == 'siswa')
                <td>{{ $siswas[$key]->name }}</td>
                @else
                <td>{{ $users[$key]->name }}</td>
                @endif
                @foreach ($absensi as $k => $sigleAbsensi)
                    @if ($sigleAbsensi)
                        @if ($sigleAbsensi->kehadiran == 'hadir')
                            <td>{{ explode(':', explode(' ',$sigleAbsensi->presensi_masuk)[1])[0] }}:{{ explode(':', explode(' ',$sigleAbsensi->presensi_masuk)[1])[1] }}
                            </td>
                        @elseif($sigleAbsensi->kehadiran == 'sakit')
                            <td></td>
                        @elseif($sigleAbsensi->kehadiran == 'izin')
                            <td></td>
                        @else
                            <td></td>
                        @endif
                    @else
                        @if (strtolower(date("D", mktime(0, 0, 0, explode('-', $date[0])[1], $k+1, explode('-', $date[0])[0]))) == 'sun')
                            <td></td>
                        @else
                            <td></td>
                        @endif
                    @endif
                @endforeach
            </tr>
            <tr>
                @foreach ($absensi as $k => $sigleAbsensi)
                    @if ($sigleAbsensi && $sigleAbsensi->presensi_pulang)
                        @if ($sigleAbsensi->kehadiran == 'hadir')
                            <td>{{ explode(':', explode(' ',$sigleAbsensi->presensi_pulang)[1])[0] }}:{{ explode(':', explode(' ',$sigleAbsensi->presensi_pulang)[1])[1] }}
                            </td>
                        @elseif($sigleAbsensi->kehadiran == 'sakit')
                            <td></td>
                        @elseif($sigleAbsensi->kehadiran == 'izin')
                            <td></td>
                        @else
                            <td></td>
                        @endif
                    @else
                        <td></td>
                    @endif
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
