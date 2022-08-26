@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title float-left">Data Siswa</h4>
        <ul class="nav float-right mb-4" style="gap: 1rem;">
            <li class="nav-item">
                <div class="input-group">
                    <select class="custom-select" id="inputGroupSelect01"
                        style="height: 30px; padding: 0; padding-left: 10px;">
                        <option selected>Jurusan</option>
                        <option value="1">Rekayasa Perangkat Lunak</option>
                    </select>
                </div>
            </li>
            <li class="nav-item">
                <div class="input-group">
                    <select class="custom-select" id="inputGroupSelect02"
                        style="height: 30px; padding: 0; padding-left: 10px;">
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
                <form action="/import" method="get">
                    @if (request('tahun_awal'))
                    <input type="hidden" name="tahun_awal" value="{{ request('tahun_awal') }}">
                    @endif
                    @if (request('tahun_akhir'))
                    <input type="hidden" name="tahun_akhir" value="{{ request('tahun_akhir') }}">
                    @endif
                    @if (request('semester'))
                    <input type="hidden" name="semester" value="{{ request('semester') }}">
                    @endif
                    <button class="btn btn-sm text-white font-weight-bold"
                        style="background-color: #3bae9c">Import</button>
                </form>
            </li>
            <li class="nav-item">
                <a href="" class="btn btn-sm text-white font-weight-bold" style="background-color: #3bae9c">Tambah
                    Data</a>
            </li>
        </ul>
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">NISN</th>
                        <th scope="col">NIPD</th>
                        <th scope="col">Name</th>
                        <th scope="col">JK</th>
                        <th scope="col">Tempat Lahir</th>
                        <th scope="col">Tanggal Lahir</th>
                        <th scope="col">NIK</th>
                        <th scope="col">Agama</th>
                        <th scope="col">Jalan</th>
                        <th scope="col">kelurahan</th>
                        <th scope="col">kecamatan</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswas as $siswa)
                    @foreach ($siswa as $student)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $student->nisn }}</td>
                        <td>{{ $student->nipd }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->jk }}</td>
                        <td>{{ $student->tempat_lahir }}</td>
                        <td>{{ $student->tanggal_lahir }}</td>
                        <td>{{ $student->nik }}</td>
                        <td>{{ $student->agama }}</td>
                        <td>{{ $student->jalan }}</td>
                        <td>{{ $student->kelurahan }}</td>
                        <td>{{ $student->kecamatan }}</td>
                        <td>

                        </td>
                    </tr>
                    @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection