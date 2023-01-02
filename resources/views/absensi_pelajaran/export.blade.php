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
        @foreach ($presensis as $key => $presensi)
            <tr>
                <th scope="row" style="vertical-align: middle;">{{ $loop->iteration }}</th>
                <td style="vertical-align: middle;">{{ $siswas[$key]->name }}</td>
                @foreach ($presensi as $k => $presen)
                    @if ($presen)
                        @if ($presen->kehadiran == 'hadir')
                            <td class="bg-success cell-table" data-toggle="modal"
                            data-target="#ubah-absen" data-bool-absen="false" style="cursor: pointer;border: 1px solid grey;" data-status="sudah" data-presensi-id="{{ $presen->id }}" data-kehadiran="hadir">
                            </td>
                        @elseif($presen->kehadiran == 'sakit')
                            <td class="cell-table" data-toggle="modal"
                            data-target="#ubah-absen" data-bool-absen="false" style="cursor: pointer;border: 1px solid grey;background-color: #E28A07;" data-status="sudah" data-presensi-id="{{ $presen->id }}" data-kehadiran="sakit">
                            </td>
                        @elseif($presen->kehadiran == 'izin')
                            <td class="cell-table bg-warning" data-toggle="modal"
                            data-target="#ubah-absen" data-bool-absen="false" style="cursor: pointer;border: 1px solid grey;" data-status="sudah" data-presensi-id="{{ $presen->id }}" data-kehadiran="izin">
                            </td>
                        @else
                            <td class="cell-table bg-danger" data-toggle="modal"
                            data-target="#ubah-absen" data-bool-absen="false" style="cursor: pointer;border: 1px solid grey;" data-status="sudah" data-presensi-id="{{ $presen->id }}" data-kehadiran="alpha">
                            </td>
                        @endif
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