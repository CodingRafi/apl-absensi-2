<table class="table text-center">
    <thead class="thead-light">
        <tr>
            <th scope="col" rowspan="2" style="text-align: center;border: 1px solid grey;">No</th>
            <th scope="col" rowspan="2" style="text-align: center;border: 1px solid grey;">Nama</th>
            <th scope="col" colspan="{{ count($date) }}" style="text-align: center;border: 1px solid grey;">{{ date("F", mktime(0, 0, 0, explode('-',
                $date[0])[1], 10)) }}</th>
        </tr>
        <tr>
            @foreach ($date as $dt)
            <th scope="col" style="text-align: center;border: 1px solid grey;">{{ explode('-', $dt)[2] }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($absensis as $key => $absensi)
        <tr>
            <th scope="row" rowspan="2" style="text-align: center;border: 1px solid grey;" height="25">{{ $loop->iteration }}</th>
            <td rowspan="2" style="text-align: center;border: 1px solid grey;" height="25">{{ $absensi['user']->name }}</td>
            @foreach ($absensi['absensis'] as $k => $row)
            @if (strtolower(date("D", mktime(0, 0, 0, explode('-', $date[0])[1], $k+1, explode('-',
            $date[0])[0]))) == 'sun')
            <td style="height: 2rem;background: #6C757D;" height="25"></td>
            @else
            @if ($row && $row->presensi_masuk)
            @foreach ($status_kehadiran as $status)
            @if ($status->id == $row->status_kehadiran_id)
            <td class="text-white cell-table" style="cursor: pointer;background: {{ $status->color }}"
                data-presensi="masuk" height="25"
                onclick="edit(this, {{ $absensi['user']->id }}, '{{ $date[$k] }}', {{ $row->id }})">{{
                explode(':', explode(' ',$row->presensi_masuk)[1])[0] }}:{{
                explode(':', explode(' ',$row->presensi_masuk)[1])[1] }}
            </td>
            @endif
            @endforeach
            @else
            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"
                onclick="edit(this, {{ $absensi['user']->id }}, '{{ $date[$k] }}')" data-presensi="masuk" height="25">
            </td>
            @endif
            @endif
            @endforeach
        </tr>
        <tr>
            @foreach ($absensi['absensis'] as $k => $row)
            @if (strtolower(date("D", mktime(0, 0, 0, explode('-', $date[0])[1], $k+1, explode('-',
            $date[0])[0]))) == 'sun')
            <td style="height: 2rem;background: #6C757D;" height="25"></td>
            @else
            @if ($row && $row->presensi_pulang)
            @foreach ($status_kehadiran as $status)
            @if ($status->id == $row->status_kehadiran_id)
            <td class="text-white cell-table" style="cursor: pointer;background: {{ $status->color }}"
                data-presensi="pulang" height="25"
                onclick="edit(this, {{ $absensi['user']->id }}, '{{ $date[$k] }}', {{ $row->id }})">{{
                explode(':', explode(' ',$row->presensi_pulang)[1])[0] }}:{{
                explode(':', explode(' ',$row->presensi_pulang)[1])[1] }}
            </td>
            @endif
            @endforeach
            @else
            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"
                onclick="edit(this, {{ $absensi['user']->id }}, '{{ $date[$k] }}')" data-presensi="pulang" height="25">
            </td>
            @endif
            @endif
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>