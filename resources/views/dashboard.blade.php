@extends('mylayouts.main')

@section('container')
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