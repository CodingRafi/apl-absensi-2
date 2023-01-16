@extends('mylayouts.main')

@section('tambahcss')
    <style>
        .title{
            font-weight: 500;
        }
    </style>
@endsection

@section('container')
@if (Auth::user()->hasRole('super_admin'))
<div class="card">
    <div class="card-body">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Sekolah Tersedia : {{ $countSekolah }}
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <div class="table-responsive table-borderless">
                            <table>
                                @foreach ($sekolah as $s)
                                <tr>
                                    <td>- {{ $s->nama }}</td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        Role Tersedia : {{ $countRole }}
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <div class="table-responsive table-borderless">
                            <table>
                                @foreach ($roles as $role)
                                @if ($role->name != 'super_admin')
                                <tr>
                                    <td>- {{ $role->name }}</td>
                                </tr>
                                @endif
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        Tahun Ajaran Tersedia : {{ $countTahunAjaran }}
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <div class="table-responsive table-borderless">
                            <table>
                                @foreach ($tahun_ajarans as $tahun_ajaran)
                                <tr>
                                    <td>- {{ $tahun_ajaran->tahun_awal }}/{{ $tahun_ajaran->tahun_akhir }} Semester {{
                                        $tahun_ajaran->semester }}</td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
    <div class="card mb-3" style="min-height: 17rem;overflow: auto;">
        <div class="card-body">
            <div class="title" style="display: flex; justify-content: space-between">
                <h4 class="card-title">Profile Sekolah</h4>
                @if (auth()->user()->can('edit_sekolah'))
                <form action="{{ route('sekolah.edit.own') }}" method="get">
                    @include('mypartials.tahunajaran')
                    <button class="btn btn-warning btn-sm text-white"
                        style="min-width: 5vw;font-weight: 500;border-radius: 5px;">Edit</button>
                </form>
                @endif
            </div>
            <div class="row">
                <div class="col-lg-9">
                    <table class="table table-responsive table-borderless">
                        <tr>
                            <td class="title">Nama Sekolah</td>
                            <td>:</td>
                            <td>{{ Auth::user()->sekolah->nama }}</td>
                        </tr>
                        <tr>
                            <td class="title">NPSN</td>
                            <td>:</td>
                            <td>{{ Auth::user()->sekolah->npsn }}</td>
                        </tr>
                        <tr>
                            <td class="title">Kepala Sekolah</td>
                            <td>:</td>
                            <td>{{ Auth::user()->sekolah->kepala_sekolah }}</td>
                        </tr>
                        <tr>
                            <td class="title">Alamat</td>
                            <td>:</td>
                            <td>{{ Auth::user()->sekolah->alamat }}</td>
                        </tr>
                        <tr>
                            <td class="d-flex gap-3">
                                @if ( Auth::user()->sekolah->instagram )
                                <a href="{{ Auth::user()->sekolah->instagram }}"><i class="bi bi-instagram"
                                        style="color: purple;"></i></a>
                                @endif
                                @if ( Auth::user()->sekolah->youtube )
                                <a href="{{ Auth::user()->sekolah->youtube }}"><i class="bi bi-youtube"
                                        style="color: red"></i></a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @if ( Auth::user()->sekolah->youtube )
                                <a href="{{ Auth::user()->sekolah->youtube }}"><i class="bi bi-youtube"
                                        style="color: red"></i></a>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-3">
                    <img src="{{ Auth::user()->sekolah->logo != '/img/tutwuri.png' ? asset('storage/' . Auth::user()->sekolah->logo) : Auth::user()->sekolah->logo }}"
                        alt="" scale="1/1"
                        style="width: 10rem; object-fit: cover; border-radius: 5px; display: block;">
                </div>
            </div>
        </div>
    </div>
    {{-- @if (auth()->user()->can('view_users') && !Auth::user()->hasRole('yayasan'))
    <div class="col-md-4">
        <div class="card mb-3" style="height: 15rem;overflow: auto;">
            <div class="card-body">
                <div class="title-yayasan" style="display: flex; justify-content: space-between">
                    <h4 class="card-title">Yayasan</h4>
                    @if (!$yayasan)
                    <form action="/create-yayasan" method="get">
                        @include('mypartials.tahunajaran')
                        <button type="submit" class="btn btn-sm text-white p-0"
                            style="background-color: #369488; min-width: 5rem; height: 1.5rem; font-weight: 500; border-radius: 5px;">Tambah</button>
                    </form>
                    @endif
                </div>
                @if ($yayasan)
                <div class="table table-responsive table-hover text-center" style="border-radius: 3px;">
                    <table class="table align-middle">
                        <thead style="background-color: #3bae9ddc; color: aliceblue;">
                            <tr>
                                <th style="width: 5%;">Nama</th>
                                <th style="width: 5%;">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 15%; height: 8vh">{{ $yayasan->profile_user->name }}</td>
                                <td style="width: 15%; height: 8vh">{{ $yayasan->email }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @else
                <div class="alert alert-danger" role="alert">
                    Maaf tidak ada data yayasan ditemukan
                </div>
                @endif
            </div>
        </div>
    </div>
    @endif --}}

@if (auth()->user()->can('view_users') || auth()->user()->can('view_kompetensi'))
<div class="container-fluid p-0">
    <div class="row">
        @if (auth()->user()->can('view_users'))
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data User</h4>
                    <canvas id="user"></canvas>
                </div>
            </div>
        </div>
        @endif
        @if (auth()->user()->can('view_kompetensi'))
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="card-title">Kompetensi</h4>
                    <canvas id="kompetensi"></canvas>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endif

@if (auth()->user()->can('view_kelas'))
<div class="container-fluid p-0 mb-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="min-height: 15rem;">
                <div class="card-body">
                    <h4 class="card-title">Kelas</h4>
                    <canvas id="kelas"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if (auth()->user()->can('view_mapel'))
<div class="container-fluid p-0 mb-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="min-height: 15rem;">
                <div class="card-body">
                    <h4 class="card-title">Mapel</h4>
                    <canvas id="mapel"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endif

@if (auth()->user()->can('show_absensi'))
<div class="container-fluid p-0 mb-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="min-height: 15rem;">
                <div class="card-body">
                    <h4 class="card-title">Absensi</h4>
                    <canvas id="absensi-user"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection

@section('tambahjs')
<script src="{{ asset('template/vendors/chart.js/Chart.min.js') }}"></script>
@if (auth()->user()->can('view_users'))
{{-- !Data User --}}
<script>
    const data = {
        labels: {!! json_encode($users['key']) !!},
        datasets: [{
        label: 'Total',
        data: {!! json_encode($users['data']) !!},
        backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 159, 64, 0.5)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
        borderWidth: 1,
        fill: false
        }]
    };

    const options = {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        },
        legend: {
            display: false
        },
        elements: {
            point: {
                radius: 0
            }
        }
    };

    const barChartCanvas = $("#user").get(0).getContext("2d");
    const barChart = new Chart(barChartCanvas, {
      type: 'bar',
      data: data,
      options: options
    });
</script>
@endif

@if (auth()->user()->can('view_kompetensi'))
{{-- !Kompetensi --}}
<script>
    const dataKompetensi = {
        datasets: [{
            data: {!! json_encode($kompetensis['data']) !!},
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 159, 64, 0.5)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
        }],

        labels: {!! json_encode($kompetensis['key']) !!}
    };
    const optionKompetensi = {
        responsive: true,
        animation: {
            animateScale: true,
            animateRotate: true
        }
    };

    const pieChartCanvas = $("#kompetensi").get(0).getContext("2d");
    const pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: dataKompetensi,
      options: optionKompetensi
    });
</script>
@endif

@if (auth()->user()->can('view_mapel'))
{{-- !Data Mapel --}}
<script>
    const data_mapel = {
        labels: {!! json_encode($mapels['key']) !!},
        datasets: [{
        label: 'Total guru',
        data: {!! json_encode($mapels['data']) !!},
        backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 159, 64, 0.5)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
        borderWidth: 1,
        fill: false
        }]
    };

    const options_mapel = {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        },
        legend: {
            display: false
        },
        elements: {
            point: {
                radius: 0
            }
        }
    };

    const mapelChartCanvas = $("#mapel").get(0).getContext("2d");
    new Chart(mapelChartCanvas, {
      type: 'bar',
      data: data_mapel,
      options: options_mapel
    });
</script>
@endif

@if (auth()->user()->can('view_kelas'))
{{-- !Data Kelas --}}
<script>
    const data_kelas = {
        labels: {!! json_encode($kelas['key']) !!},
        datasets: [{
        label: 'Total siswa',
        data: {!! json_encode($kelas['data']) !!},
        backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 159, 64, 0.5)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
        borderWidth: 1,
        fill: false
        }]
    };

    const options_kelas = {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        },
        legend: {
            display: false
        },
        elements: {
            point: {
                radius: 0
            }
        }
    };

    const kelasChartCanvas = $("#kelas").get(0).getContext("2d");
    new Chart(kelasChartCanvas, {
      type: 'bar',
      data: data_kelas,
      options: options_kelas
    });
</script>
@endif

@if (auth()->user()->can('show_absensi'))
<script>
    const canvasAbsensiUser = document.getElementById("absensi-user").getContext('2d');

    const data_absensi_user = {
        labels: {!! json_encode(config('services.bulan')) !!},
        datasets: {!! json_encode($absensis) !!}
    };

    const options_absensi_user = {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                },
                scaleLabel: {
                    display: false,
                }
            }]            
        }  
    };

    new Chart(canvasAbsensiUser, {
        type: 'line',
        data: data_absensi_user,
        options: options_absensi_user
    });
</script>
@endif
@endsection