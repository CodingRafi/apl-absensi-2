@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title float-left">Data Siswa</h4>
        <ul class="nav float-right mb-4" style="gap: 1rem;">
            <li class="nav-item">
                <div class="input-group">
                    @if (count($kompetensis)>0)
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false" style="border: 1px solid rgb(205, 205, 205); height: 1.9rem; width: 7rem; padding: 0.1rem">
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
                    @endif
                </div>
            </li>
            <li class="nav-item">
                <div class="input-group">
                    @if (count($kelas_filter)>0)
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false" style="border: 1px solid rgb(205, 205, 205); height: 1.9rem; width: 5rem; padding: 0.1rem">
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
                    @endif
                </div>
            </li>
            <li class="nav-item">
                <div class="input-group input-group-sm">
                    <form action="" method="get" style="display: flex; gap: 0.3rem">
                        @include('mypartials.tahunajaran')
                        <input type="text" class="form-control" placeholder="Search" style="height: 1.9rem;" name="search" value="{{ request('search') }}">
                        <button type="submit" class="btn" style="border: 1px solid rgb(205, 205, 205); height: 1.9rem; width: 2.5rem; padding: 0.1rem"><i class="bi bi-search"></i></button>
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
                    <tr class="text-center">
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
                                <button class="btn btn-sm btn-warning text-white font-weight-bold" style="width: 5rem; margin: 0.1rem;">Edit</button>
                            </form>
                            <form action="/siswa/{{ $student->id }}" method="post">
                                @csrf
                                @method('delete')
                                @include('mypartials.tahunajaran')
                                <button type="submit" class="btn btn-sm btn-danger font-weight-bold" style="width: 5rem; margin: 0.1rem;" onclick="return confirm('yakin?')">Hapus</button>
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