@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title float-left">Data Siswa</h4>
        <ul class="nav mb-4 justify-content-end" style="gap: 1rem; clear: right !important;">
            <li class="nav-item">
                <span class="badge badge-pill badge-success" style="color: rgba(0, 0, 0, 0)">1</span>
                Hadir
            </li>
            <li class="nav-item">
                <span class="badge badge-pill" style="background: rgba(226, 138, 7, 1); color: rgba(0, 0, 0, 0)">1</span>
                Sakit
            </li>
            <li class="nav-item">
                <span class="badge badge-pill" style="background: rgba(243, 248, 10, 1); color: rgba(0, 0, 0, 0)">1</span>
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
                                    <input type="hidden" name="idb" value="12">
                                    <button type="submit" class="dropdown-item">Desember</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
        <div class="table-responsive">
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
                                        <td class="cell-table" data-toggle="modal"
                                        data-target="#ubah-absen" data-bool-absen="false" style="cursor: pointer;border: 1px solid grey;" data-status="belum" data-siswa="{{ $siswas[$key]->id }}" data-absensi-pelajaran="{{ $id }}" data-date="{{ date("Y-m-d", mktime(0, 0, 0, explode('-', $date[0])[1], $k+1, explode('-', $date[0])[0])) }}" data-idk="{{ request('idk') }}">
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
 <div class="modal fade" id="ubah-absen">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Masukan Keterangan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/presensi" method="post" class="form-presensi">
                    @csrf
                    <input type="hidden" name="siswa_id" class="siswa_id" disabled>
                    <input type="hidden" name="absensi_pelajaran_id" class="absensi_pelajaran_id" disabled>
                    <input type="hidden" name="date" class="date" disabled>
                    <input type="hidden" name="idk" class="idk" disabled>
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
        cellTable.forEach(e => {
            e.addEventListener('click', presensi)
        });

        function presensi(e){
            if (e.target.getAttribute('data-status') == 'sudah') {
                const selectKehadiran = document.querySelector('.select-kehadiran');
                selectKehadiran.value = e.target.getAttribute('data-kehadiran');

                const formPresensi = document.querySelector('.form-presensi');
                formPresensi.setAttribute('action', '');
                formPresensi.setAttribute('action', '/presensi/' + e.target.getAttribute('data-presensi-id'));

            }else{
                const siswa_id = document.querySelector('.siswa_id');
                siswa_id.removeAttribute('disabled');
                siswa_id.value = e.target.getAttribute('data-siswa');

                const absensi_pelajaran_id = document.querySelector('.absensi_pelajaran_id');
                absensi_pelajaran_id.removeAttribute('disabled');
                absensi_pelajaran_id.value = e.target.getAttribute('data-absensi-pelajaran');

                const date = document.querySelector('.date');
                date.removeAttribute('disabled');
                date.value = e.target.getAttribute('data-date');

                const idk = document.querySelector('.idk');
                idk.removeAttribute('disabled');
                idk.value = e.target.getAttribute('data-idk');
            }
        }
    </script>
@endsection