@extends('mylayouts.main')

@section('tambahcss')
    <style>
        @media (min-width:590px) {
            .cover {
                display: flex; 
                gap:20px;
            }
        }

        @media (max-width:590px) {
            .logo{
                display: flex;
                justify-content: center

            }
        }

        @media (min-width:590px) {
            .content2{
                width: 58%;

            }
        }

        @media (min-width:590px) {
            .content3{
                width: 40%;

            }
        }

        @media (min-width:590px) {
            .content4{
                width: 58%;

            }
        }

        @media (min-width:590px) {
            .content5{
                width: 40%;

            }
        }

        @media (min-width:590px) {
            .cover1, .cover2{
                display: flex; 
                justify-content: space-between;

            }
        }
    </style>
@endsection

@section('container')
@if ( !Auth::user()->hasRole('super_admin') )
<div class="card mb-3 content1">
    <div class="card-body">
        <div class="title" style="display: flex; justify-content: space-between">
            <h4 class="card-title" style="color: #369488; font-weight:600;">Profile Sekolah</h4>
            <form action="/edit-sekolah" method="get">
               @include('mypartials.tahunajaran')
                <button class="btn btn-sm btn-warning text-white font-weight-bold" style="min-width: 5vw;">Edit</button>
            </form>
        </div>
        <div class="cover">
            <div class="logo">
                @if ( Auth::user()->sekolah->logo != '/img/tutwuri.png' )
                <img src="{{ asset('storage/' . Auth::user()->sekolah->logo) }}" alt="" scale="1/1" style="width: 10rem; height: 10rem; object-fit: cover; border-radius: 5px;">
                @else
                <img src="{{ Auth::user()->sekolah->logo }}" alt="" scale="1/1" style="width: 10rem; height: 10rem; object-fit: cover; border-radius: 5px;">
                @endif
                <div class="mt-1" style="display: flex; justify-content: center; gap:20px;">
                    @if ( Auth::user()->sekolah->instagram )
                    <a href="{{ Auth::user()->sekolah->instagram }}"><i class="bi bi-instagram"></i></a>
                    @endif
                    @if ( Auth::user()->sekolah->youtube )
                    <a href="{{ Auth::user()->sekolah->youtube }}"><i class="bi bi-youtube"></i></a>
                    @endif
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table>
                    <tr>
                        <th>Nama Sekolah</th>
                        <td>&nbsp;</td>
                        <td>:</td>
                        <td>&nbsp;</td>
                        <td>{{ Auth::user()->sekolah->nama }}</td>
                    </tr>
                    <tr>
                        <th>NPSN</th>
                        <td>&nbsp;</td>
                        <td>:</td>
                        <td>&nbsp;</td>
                        <td>{{ Auth::user()->sekolah->npsn }}</td>
                    </tr>
                    <tr>
                        <th>Nama Kepala Sekolah</th>
                        <td>&nbsp;</td>
                        <td>:</td>
                        <td>&nbsp;</td>
                        <td>{{ Auth::user()->sekolah->kepala_sekolah }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>&nbsp;</td>
                        <td>:</td>
                        <td>&nbsp;</td>
                        <td>{{ Auth::user()->sekolah->alamat }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- @dd( Auth::user()->sekolah->kompetensi ) --}}
<div class="cover1">
    <div class="card mb-3 content2">
        <div class="card-body">
            <h4 class="card-title" style="color: #369488; font-weight:600;">Kompetensi</h4>
            @if (count(Auth::user()->sekolah->kompetensi) > 0)  
            <div class="table table-responsive table-borderless d-flex justify-content-center p-0">
                <table class="table-bordered">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Kompetensi</th>
                        <th>Program Keahlian</th>
                        <th>Bidang Keahlian</th>
                    </tr>

                    @foreach (Auth::user()->sekolah->kompetensi as $kompetensi) 
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kompetensi->kompetensi }}</td>
                        <td>{{ $kompetensi->program }}</td>
                        <td>{{ $kompetensi->bidang }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
            @else
            <div class="alert alert-primary" role="alert">
                Maaf tidak ada data Kompetensi ditemukan
            </div>  
            @endif
        </div>
    </div>
    <div class="card mb-3 content3">
        <div class="card-body">
            <h4 class="card-title" style="color: #369488; font-weight:600;">Kelas</h4>
            <div class="table table-responsive table-borderless d-flex justify-content-center">
                <table>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Kelas</th>
                    </tr>
                    @foreach (Auth::user()->sekolah->kelas as $kelas)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kelas->nama }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

<div class="cover2">
    <div class="card mb-3 content4">
        <div class="card-body">
            <h4 class="card-title" style="color: #369488; font-weight:600;">Data User</h4>
            <div class="table table-responsive table-borderless d-flex justify-content-center">
                <table>
                    <tr class="text-center">
                        @foreach ($users as $key => $user)
                        <th>{{ $key }}</th>
                        @endforeach
                    </tr>
                    <tr class="text-center">
                        @foreach ($users as $i => $userRole)
                        <td>{{ count($userRole) }}</td>
                        @endforeach
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="card mb-3 content5">
        <div class="card-body">
            <h4 class="card-title" style="color: #369488; font-weight:600;">Mapel</h4>
            <div class="table table-responsive table-borderless d-flex justify-content-center">
                <table>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Mata Pelajaran</th>
                    </tr>
                    @foreach (Auth::user()->sekolah->mapel as $mapel)                        
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $mapel->nama }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endif

@endsection