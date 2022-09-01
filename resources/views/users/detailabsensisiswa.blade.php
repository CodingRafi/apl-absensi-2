@extends('mylayouts.main')

@section('container')
    <div class="card">
        <div class="card-body">
            <div class="atas mb-5">
                <h4 class="card-title float-left" style="color: #3bae9c">Absensi Siswa</h4>
                <div class="d-flex float-right" style="gap: 5px">
                    <form action="absensi-siswa" method="get">
                        @include('mypartials.tahunajaran')
                        <button class="kembali btn btn-sm text-white bg-danger font-weight-bold">Kembali</button>
                    </form>
                </div>
            </div>
            <div class="bawah d-flex justify-content-start" style="margin-top: 100px; gap:1rem">
                <div class="d-flex">
                    <ul style="list-style: none">
                        <li class="font-weight-bold">NAMA LENGKAP : {{ $absensi->siswa->name }}</li>
                        <li class="font-weight-bold">Kelas : {{ $absensi->siswa->kelas->nama }}</li>
                        <li class="font-weight-bold">Jurusan : {{ $absensi->siswa->kompetensi->kompetensi }}</li>
                    </ul>
                </div>
                <div class="garis-vertical" style="border-left: 1px solid black; height:150px;"></div>
                <div>
                    <ul style="list-style: none">
                        <li><input type="radio" name="keterangan" id="hadir"> Hadir</li>
                        <li><input type="radio" name="keterangan" id="alpha"> Alpha</li>
                        <li><input type="radio" name="keterangan" id="izin"> Izin</li>
                        <li><input type="radio" name="keterangan" id="terlambat"> Terlambat</li>
                        <li><input type="radio" name="keterangan" id="kegiatansekolah"> Kegiatan Sekolah</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection