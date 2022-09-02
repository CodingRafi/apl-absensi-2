@extends('mylayouts.main')

@section('container')
<div class="card mb-3">
    <div class="card-body">
        <div class="title" style="display: flex; justify-content: space-between">
            <h4 class="card-title" style="color: #369488; font-weight:600;">Profile Sekolah</h4>
            <form action="/edit-sekolah" method="get">
        `       @include('mypartials.tahunajaran')
                <button class="btn btn-sm btn-warning text-white font-weight-bold" style="min-width: 5vw;">Edit</button>
            </form>
        </div>
        <div class="cover" style="display: flex; gap:50px;">
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

{{-- 
    -nama
    -npsn
    -social media
    -alamat
    -nama kelapa sekolah
--}}
<div class="row">
    <div class="col-lg-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Absensi Guru</h4>
                <canvas id="lineChartGuru"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Absensi Guru Hari Ini</h4>
                <p class="card-description">Izin</p>
                <ol>
                    <li>Hermawan</li>
                    <li>Suprianto Diningrat</li>
                </ol>
                <p class="card-description">Alpha</p>
                <ol>
                    <li>Hermawan</li>
                    <li>Suprianto Diningrat</li>
                </ol>
                <p class="card-description">Sakit</p>
                <ol>
                    <li>Hermawan</li>
                    <li>Suprianto Diningrat</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Absensi Siswa</h4>
                <canvas id="lineChartSiswa"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Absensi Siswa Hari Ini</h4>
                <p class="card-description">Izin</p>
                <ol>
                    <li>Hermawan</li>
                    <li>Suprianto Diningrat</li>
                </ol>
                <p class="card-description">Alpha</p>
                <ol>
                    <li>Hermawan</li>
                    <li>Suprianto Diningrat</li>
                </ol>
                <p class="card-description">Sakit</p>
                <ol>
                    <li>Hermawan</li>
                    <li>Suprianto Diningrat</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection