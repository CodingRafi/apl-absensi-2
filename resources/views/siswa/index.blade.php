@extends('mylayouts.main')

@section('tambahcss')
  <style>
      @media (max-width:400px){
        .jurusan, .kelas{
            width: 33vw;
        }
      }
      
      @media (max-width:890px){
        .search{
            width: 10vw;
        }
      }
      
      @media (max-width:400px){
        .search{
            width: 59vw;
        }
      }
  </style>
@endsection

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title float-left">Data Siswa</h4>
        @if (count($tahun_ajarans) > 0) 
        <ul class="nav float-right mb-4" style="gap: 1rem;">
            @if ( Auth::user()->sekolah->tingkat == 'smk' )
            <li class="nav-item">
                <div class="input-group">
                    @if (count($kompetensis)>0)
                    <div class="dropdown">
                        <button class="btn dropdown-toggle jurusan" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false" style="border: 1px solid rgb(205, 205, 205); height: 1.9rem; min-width: 6rem; padding: 0.1rem">
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
            @endif
            <li class="nav-item">
                <div class="input-group">
                    @if (count($kelas_filter)>0)
                    <div class="dropdown">
                        <button class="btn dropdown-toggle kelas" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false" style="border: 1px solid rgb(205, 205, 205); height: 1.9rem; min-width: 5rem; padding: 0.1rem">
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
                        <input type="text" class="form-control search" placeholder="Search" style="height: 1.9rem; min-width: 3rem;" name="search" value="{{ request('search') }}">
                        <button type="submit" class="btn" style="border: 1px solid rgb(205, 205, 205); height: 1.9rem; min-width: 2.5rem; padding: 0.1rem"><i class="bi bi-search"></i></button>
                    </form>
                </div>
            </li>
            @if (auth()->user()->can('export_siswa'))
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
                    <button type="submit" class="btn btn-sm text-white px-3"
                    style="background-color: #3bae9c;border-radius: 5px;font-weight: 500;">Export</button>
                </form>
            </li>
            @endif
            @if (auth()->user()->can('import_siswa'))  
            <li class="nav-item">
                <form action="{{ route('import.siswa') }}" method="get">
                    @include('mypartials.tahunajaran')
                    <button class="btn btn-sm text-white"
                        style="background-color: #3bae9c;border-radius: 5px;font-weight: 500;">Import</button>
                </form>
            </li>
            @endif
            @if (auth()->user()->can('add_siswa'))
            <li class="nav-item">
                <form action="/siswa/create" method="get">
                    @include('mypartials.tahunajaran')
                    <button class="btn btn-sm text-white" style="background-color: #3bae9c;border-radius: 5px;font-weight: 500;">Tambah</button>
                </form>
            </li>
            @endif
        </ul>
        @endif
        <div class="table table-responsive table-hover text-center">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Profil</th>
                        <th scope="col">NISN</th>
                        <th scope="col">NIPD</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
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
                        @if (auth()->user()->can('edit_siswa') || auth()->user()->can('delete_siswa'))
                        <th scope="col">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswas as $student)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>
                            @if ($student->profil != '/img/profil.png')
                            <img src="{{ asset('storage/' . $student->profil) }}" alt="" style="object-fit: cover">
                            @else
                            <img src="{{ $student->profil }}" alt="" style="object-fit: cover">
                            @endif
                        </td>
                        <td>{{ $student->nisn }}</td>
                        <td>{{ $student->nipd }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
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
                        @if ($student->rfid)
                        <td>{{ $student->rfid->rfid_number }}</td>
                        @else
                        <td></td>
                        @endif
                        @if ($student->rfid)
                        <td>{{ $student->rfid->status }}</td>
                        @else
                        <td></td>
                        @endif
                        @if (auth()->user()->can('edit_siswa') || auth()->user()->can('delete_siswa')) 
                        <td>
                            @if (auth()->user()->can('edit_siswa'))
                            <form action="/siswa/{{ $student->id }}/edit" method="get">
                                @include('mypartials.tahunajaran')
                                <button class="btn btn-sm btn-warning text-white font-weight-bold" style="width: 5rem; margin: 0.1rem;border-radius: 5px;">Edit</button>
                            </form>
                            @endif
                            @if (auth()->user()->can('delete_siswa'))
                            <form action="/siswa/{{ $student->id }}" method="post">
                                @csrf
                                @method('delete')
                                @include('mypartials.tahunajaran')
                                <button type="submit" class="btn btn-sm btn-danger font-weight-bold" style="width: 5rem; margin: 0.1rem;border-radius: 5px;" onclick="return confirm('apakah anda yakin ingin menghapus user ini?')">Hapus</button>
                            </form>
                            @endif
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection