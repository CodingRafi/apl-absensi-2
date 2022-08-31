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
                    <tr>
                        <th scope="row" rowspan="2" style="vertical-align: middle;">1</th>
                        <td rowspan="2" style="vertical-align: middle;">Rudi Sugianto</td>
                        <td class="bg-success" data-toggle="modal"
                        data-target="#ubah-absen">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
 <div class="modal fade" id="ubah-absen">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Masukan Username Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="bidang" class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-10">
                            <select class="form-control text-dark" name="" id="">
                                <option value="" selected>Pilih keterangan</option>
                                <option value="">Hadir</option>
                                <option value="">Izin</option>
                                <option value="">Alpha</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn text-white float-right" style="background-color: #3bae9c">Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection