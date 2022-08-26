@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title float-left">Data Siswa</h4>
        <ul class="nav float-right mb-4" style="gap: 1rem;">
            <li class="nav-item">
                <div class="input-group">
                    <select class="custom-select" id="inputGroupSelect01" style="height: 30px; padding: 0; padding-left: 10px;">
                        <option selected>Jurusan</option>
                        <option value="1">Rekayasa Perangkat Lunak</option>
                    </select>
                </div>
            </li>
            <li class="nav-item">
                <div class="input-group">
                    <select class="custom-select" id="inputGroupSelect02" style="height: 30px; padding: 0; padding-left: 10px;">
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
                <a href="" class="btn btn-sm text-white font-weight-bold px-3" style="background-color: #3bae9c">Export</a>
            </li>
            <li class="nav-item">
                <a href="" class="btn btn-sm text-white font-weight-bold px-3" style="background-color: #3bae9c">Import</a>
            </li>
            <li class="nav-item">
                <a href="" class="btn btn-sm text-white font-weight-bold px-3" style="background-color: #3bae9c">Tambah Data</a>
            </li>
        </ul>
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Nama</th>
                        <th scope="col">NISN</th>
                        <th scope="col">Tanggal Lahir</th>
                        <th scope="col">Jurusan</th>
                        <th scope="col">Kelas</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>
                            <img src="/template/images/faces/defaultProfile.jpg" class="rounded-circle" height="36" width="36" alt="image" style="object-fit: cover">
                        </td>
                        <td>Rudi Sugianto</td>
                        <td>0065174732</td>
                        <td>12 Agustus 2005</td>
                        <td>Rekayasa Perangkat Lunak</td>
                        <td>XII RPL 2</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection