@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title float-left">Data Siswa</h4>
        <ul class="nav float-right mb-4" style="gap: 1rem;">
            <li class="nav-item">
                <div class="input-group">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Jurusan
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            @foreach ($kompetensis as $kompetensi)
                            <li>
                                <form action="" method="get">
                                    @include('mypartials.tahunajaran')
                                    <input type="hidden" name="idj" value="{{ $kompetensi->id }}">
                                    <button type="submit" class="dropdown-item">{{ $kompetensi->kompetensi }}</button>
                                </form>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <div class="input-group">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Kelas
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            @foreach ($kelas_filter as $kelas)
                            <li>
                                <form action="" method="get">
                                    @include('mypartials.tahunajaran')
                                    <input type="hidden" name="idk" value="{{ $kelas->id }}">
                                    <button type="submit" class="dropdown-item">{{ $kelas->nama }}</button>
                                </form>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <div class="input-group input-group-sm">
                    <form action="" method="get">
                        @include('mypartials.tahunajaran')
                        <input type="text" class="form-control" placeholder="Search" style="height: 29px;" name="search" value="{{ request('search') }}">
                        <button type="submit">Search</button>
                    </form>
                </div>
            </li>
            <li class="nav-item">
                <form action="/export" method="get">
                    @include('mypartials.tahunajaran')
                    @if (request('idk'))
                        <input type="hidden" name="idk" value="{{ request('idk') }}">
                    @endif
                    @if (request('idj'))
                        <input type="hidden" name="idj" value="{{ request('idj') }}">
                    @endif
                    @if (request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    <button type="submit" class="btn btn-sm text-white font-weight-bold px-3"
                    style="background-color: #3bae9c">Export</button>
                </form>
            </li>
            <li class="nav-item">
                <form action="/import" method="get">
                    @include('mypartials.tahunajaran')
                    <button class="btn btn-sm text-white font-weight-bold"
                        style="background-color: #3bae9c">Import</button>
                </form>
            </li>
            <li class="nav-item">
                <form action="/siswa/create" method="get">
                    @include('mypartials.tahunajaran')
                    <button class="btn btn-sm text-white font-weight-bold" style="background-color: #3bae9c">Tambah
                        Siswa</button>
                </form>
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
                        <th scope="col">Kelas</th>
                        <th scope="col">Jurusan</th>
                        <th scope="col">JK</th>
                        <th scope="col">Tempat Lahir</th>
                        <th scope="col">Tanggal Lahir</th>
                        <th scope="col">NIK</th>
                        <th scope="col">Agama</th>
                        <th scope="col">Jalan</th>
                        <th scope="col">kelurahan</th>
                        <th scope="col">kecamatan</th>
                        <th scope="col">RFID Number</th>
                        <th scope="col">Status RFID</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswas as $student)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $student->nisn }}</td>
                        <td>{{ $student->nipd }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->kelas }}</td>
                        <td>{{ $student->jurusan }}</td>
                        <td>{{ $student->jk }}</td>
                        <td>{{ $student->tempat_lahir }}</td>
                        <td>{{ $student->tanggal_lahir }}</td>
                        <td>{{ $student->nik }}</td>
                        <td>{{ $student->agama }}</td>
                        <td>{{ $student->jalan }}</td>
                        <td>{{ $student->kelurahan }}</td>
                        <td>{{ $student->kecamatan }}</td>
                        {{-- <td>{{ $student->rfid->rfid_number }}</td>
                        <td>{{ $student->rfid->status }}</td> --}}
                        <td>
                            <form action="/siswa/{{ $student->id }}/edit" method="get">
                                @include('mypartials.tahunajaran')
                                <button class="btn btn-warning">Edit</button>
                            </form>
                            <form action="/siswa/{{ $student->id }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection