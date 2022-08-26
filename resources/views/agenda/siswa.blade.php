@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title float-left">Agenda Siswa</h4>
        <ul class="nav float-right mb-4" style="gap: 1rem;">
            <li class="nav-item">
                <div class="input-group">
                    <select class="custom-select" id="inputGroupSelect01" style="height: 30px; padding: 0; padding-left: 10px">
                        <option selected>Jurusan</option>
                        <option value="1">Rekayasa Perangkat Lunak</option>
                    </select>
                </div>
            </li>
            <li class="nav-item">
                <div class="input-group">
                    <select class="custom-select" id="inputGroupSelect02" style="height: 30px; padding: 0; padding-left: 10px">
                        <option selected>Kelas</option>
                        <option value="1">XII RPL 2</option>
                    </select>
                </div>
            </li>
            <li class="nav-item">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm"
                        placeholder="Search" style="height: 29px;">
                </div>
            </li>
            <li class="nav-item">
                <a href="" class="btn btn-sm text-white font-weight-bold px-3" style="background-color: #3bae9c">Tambah Data</a>
            </li>
        </ul>
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-light">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Mapel</th>
                        <th>Hari/ Tanggal</th>
                        <th>Jam</th>
                        <th>Kelas</th>
                        <th>Materi</th>
                        <th>Dokumentasi</th>
                        <th>Jenis Pembelajaran</th>
                        <th>Link</th>
                        <th>Absensi</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <td>1</td>
                        <td>Puguh Rismadi</td>
                        <td>PBO</td>
                        <td>Senin, 30-08-2022</td>
                        <td>07.00 - 12.50</td>
                        <td>XII RPL 2</td>
                        <td>Vue JS</td>
                        <td><i class="bi bi-filetype-pdf" style="color: red"></i></td>
                        <td>Tatap Muka</td>
                        <td>http:\\google.com</td>
                        <td>Hadir</td>
                        <td></td>
                        <td>
                            <a href="" class="btn btn-sm btn-warning text-white font-weight-bold">Edit</a>
                            <a href="" class="btn btn-sm btn-danger text-white font-weight-bold">Delete</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection