@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title float-left">Agenda Siswa</h4>
        <ul class="nav float-right mb-4" style="gap: 1rem;">
            <div class="nav-item">
                <div class="input-group">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false"
                            style="border: 1px solid rgb(205, 205, 205); height: 1.9rem; min-width: 6rem; padding: 0.1rem">
                            Tanggal
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1"
                            style="max-height: 50vh;overflow: auto;">
                            <li>
                                <form action="" method="get">
                                    @include('mypartials.tahunajaran')
                                    <input type="hidden" name="idb" value="">
                                    <input type="hidden" name="idt" value="">
                                    <button type="submit" class="dropdown-item"></button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="nav-item">
                <div class="input-group">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false"
                            style="border: 1px solid rgb(205, 205, 205); height: 1.9rem; min-width: 5rem; padding: 0.1rem">
                            Bulan
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1"
                            style="max-height: 50vh;overflow: auto;">
                            <li>
                                <form action="" method="get">
                                    @include('mypartials.tahunajaran')
                                    <input type="hidden" name="idt" value="">
                                    <input type="hidden" name="idb" value="1">
                                    <button type="submit" class="dropdown-item">Januari</button>
                                </form>
                            </li>
                            <li>
                                <form action="" method="get">
                                    @include('mypartials.tahunajaran')
                                    <input type="hidden" name="idt" value="">
                                    <input type="hidden" name="idb" value="2">
                                    <button type="submit" class="dropdown-item">Februari</button>
                                </form>
                            </li>
                            <li>
                                <form action="" method="get">
                                    @include('mypartials.tahunajaran')
                                    <input type="hidden" name="idt" value="">
                                    <input type="hidden" name="idb" value="3">
                                    <button type="submit" class="dropdown-item">Maret</button>
                                </form>
                            </li>
                            <li>
                                <form action="" method="get">
                                    @include('mypartials.tahunajaran')
                                    <input type="hidden" name="idt" value="">
                                    <input type="hidden" name="idb" value="4">
                                    <button type="submit" class="dropdown-item">April</button>
                                </form>
                            </li>
                            <li>
                                <form action="" method="get">
                                    @include('mypartials.tahunajaran')
                                    <input type="hidden" name="idt" value="">
                                    <input type="hidden" name="idb" value="5">
                                    <button type="submit" class="dropdown-item">Mei</button>
                                </form>
                            </li>
                            <li>
                                <form action="" method="get">
                                    @include('mypartials.tahunajaran')
                                    <input type="hidden" name="idt" value="">
                                    <input type="hidden" name="idb" value="6">
                                    <button type="submit" class="dropdown-item">Juni</button>
                                </form>
                            </li>
                            <li>
                                <form action="" method="get">
                                    @include('mypartials.tahunajaran')
                                    <input type="hidden" name="idt" value="">
                                    <input type="hidden" name="idb" value="7">
                                    <button type="submit" class="dropdown-item">Juli</button>
                                </form>
                            </li>
                            <li>
                                <form action="" method="get">
                                    @include('mypartials.tahunajaran')
                                    <input type="hidden" name="idt" value="">
                                    <input type="hidden" name="idb" value="8">
                                    <button type="submit" class="dropdown-item">Agustus</button>
                                </form>
                            </li>
                            <li>
                                <form action="" method="get">
                                    @include('mypartials.tahunajaran')
                                    <input type="hidden" name="idt" value="">
                                    <input type="hidden" name="idb" value="9">
                                    <button type="submit" class="dropdown-item">September</button>
                                </form>
                            </li>
                            <li>
                                <form action="" method="get">
                                    @include('mypartials.tahunajaran')
                                    <input type="hidden" name="idt" value="">
                                    <input type="hidden" name="idb" value="10">
                                    <button type="submit" class="dropdown-item">Oktober</button>
                                </form>
                            </li>
                            <li>
                                <form action="" method="get">
                                    @include('mypartials.tahunajaran')
                                    <input type="hidden" name="idt" value="">
                                    <input type="hidden" name="idb" value="11">
                                    <button type="submit" class="dropdown-item">November</button>
                                </form>
                            </li>
                            <li>
                                <form action="" method="get">
                                    @include('mypartials.tahunajaran')
                                    <input type="hidden" name="idt" value="">
                                    <input type="hidden" name="idb" value="12">
                                    <button type="submit" class="dropdown-item">Desember</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <li class="nav-item">
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false" style="border: 1px solid rgb(205, 205, 205); height: 1.9rem; min-width: 8rem; padding: 0.1rem">
                        Tahun Ajaran
                    </button>
                    <ul class="dropdown-menu ml-1" aria-labelledby="dropdownMenuButton1">
                        @foreach ($tahun_ajarans as $tahun_ajaran)
                        <li class="
                        ">
                            <form action="" method="get">
                                <input type="hidden" name="idt" value="">
                                <input type="hidden" name="idb" value="">
                                <input type="hidden" name="tahun_awal" value="">
                                <input type="hidden" name="tahun_akhir" value="">
                                <input type="hidden" name="semester" value="">
                                <button type="submit" class="dropdown-item"> Semester </button>
                            </form>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </li>
        </ul>
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-light">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Mapel</th>
                        <th>Jam</th>
                        <th>Kelas</th>  
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection