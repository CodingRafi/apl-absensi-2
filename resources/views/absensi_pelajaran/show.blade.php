@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title float-left">Data Siswa</h4>
        <ul class="nav mb-4 justify-content-end" style="gap: 1rem; clear: right !important;">
            @foreach ($status_kehadiran as $status)
            <li class="nav-item d-flex align-items-center" style="gap: .3rem">
                <span class="d-inline-block"
                    style="background-color: {{ $status->color }};width: 1rem;height:1rem;"></span>
                {{ $status->nama }}
            </li>
            @endforeach
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
                            @foreach (config('services.bulan') as $key => $bulan)
                            <li>
                                <form action="" method="get">
                                    @include('mypartials.tahunajaran')
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
                <form action="/presensi-export" method="get">
                    @include('mypartials.tahunajaran')
                    @if (request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    <button type="submit" class="btn btn-sm text-white font-weight-bold px-3"
                        style="background-color: #3bae9c">Export</button>
                </form>
            </li>
            @if (auth()->user()->can('export_presensi'))
            @endif
        </ul>
        <div class="table-responsive">
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
                            onclick="edit(this, {{ $absensi['user']->id }}, '{{ $date[$k] }}', {{ request('id') }}, {{ $row->id }})">{{
                            explode(':', explode(' ',$row->presensi_masuk)[1])[0] }}:{{
                            explode(':', explode(' ',$row->presensi_masuk)[1])[1] }}
                        </td>
                        @endif
                        @endforeach
                        @else
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"
                            onclick="edit(this, {{ $absensi['user']->id }}, '{{ $date[$k] }}', {{ request('id') }})" data-presensi="masuk">
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
                <form action="{{ route('absensi-pelajaran.presensi.store_update') }}" method="post" class="form-presensi">
                    @csrf
                    <input type="hidden" name="user_id" class="user_id">
                    <input type="hidden" name="absensi_pelajaran_id" class="absensi_pelajaran_id">
                    <input type="hidden" name="date" class="date">
                    <input type="hidden" name="presensi" class="presensi">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <select class="form-control text-dark select-kehadiran" name="status_kahadiran_id" required
                                id="keterangan">
                                <option value="" selected>Pilih keterangan</option>
                                @foreach ($status_kehadiran as $status)
                                <option value="{{ $status->id }}">{{ $status->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
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
    function edit(el, user_id, date, absensi_pelajaran_id, id = null){
        $('.form-presensi input[name="_method"]').remove();
        $('.form-presensi input[name="date"]').val(date)
        $('.form-presensi input[name="user_id"]').val(user_id)
        $('.form-presensi input[name="absensi_pelajaran_id"]').val(absensi_pelajaran_id)
        $('.form-presensi input[name="presensi"]').val($(el).attr('data-presensi'))
        if (id) {
            $.get('/absensi-pelajaran/presensi/' + id, function(response){
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