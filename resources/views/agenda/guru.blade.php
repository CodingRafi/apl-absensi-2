@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title float-left">Agenda Guru</h4>
        <ul class="nav float-right mb-4" style="gap: 1rem;">
            <li class="nav-item">
                <div class="dropdown">
                    <button class="btn dropdown-toggle ml-3" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false" style="border: none">
                        Tahun Ajaran
                    </button>
                    <ul class="dropdown-menu ml-1" aria-labelledby="dropdownMenuButton1">
                        @foreach ($tahun_ajarans as $tahun_ajaran)
                        <li class="
                        ">
                            <form action="" method="get">
                                <input type="hidden" name="tahun_awal" value="{{ $tahun_ajaran->tahun_awal }}">
                                <input type="hidden" name="tahun_akhir" value="{{ $tahun_ajaran->tahun_akhir }}">
                                <input type="hidden" name="semester" value="{{ $tahun_ajaran->semester }}">
                                <button type="submit" class="dropdown-item">{{ $tahun_ajaran->tahun_awal }}/{{
                                    $tahun_ajaran->tahun_akhir }} Semester {{ $tahun_ajaran->semester }}</button>
                            </form>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </li>
            <div class="nav-item">
                <div class="input-group">
                    {{-- @if (count($kelas_filter)>0)
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false"
                            style="border: 1px solid rgb(205, 205, 205); height: 1.9rem; width: 5rem; padding: 0.1rem">
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
                    @endif --}}
                </div>
            </div>
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