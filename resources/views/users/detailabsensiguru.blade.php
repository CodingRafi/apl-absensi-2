@extends('mylayouts.main')

@section('container')
    <div class="card">
        <div class="card-body">
            <div class="atas mb-5">
                <h4 class="card-title float-left" style="color: #3bae9c">Absensi </h4>
                <div class="d-flex float-right" style="gap: 5px">
                    <form action="absensi-guru" method="get">
                        @if (request('tahun_awal'))
                        <input type="hidden" name="tahun_awal" value="{{ request('tahun_awal') }}">
                        @endif
                        @if (request('tahun_akhir'))
                        <input type="hidden" name="tahun_akhir" value="{{ request('tahun_akhir') }}">
                        @endif
                        @if (request('semester'))
                        <input type="hidden" name="semester" value="{{ request('semester') }}">
                        @endif
                        <button class="kembali btn btn-sm text-white bg-danger font-weight-bold">Kembali</button>
                    </form>
                </div>
            </div>
            <div class="bawah d-flex justify-content-start" style="margin-top: 100px; gap:1rem">
                <div>
                    <img src="img/Profile.png" alt="image" style="width: 100px; border-radius:10px">
                </div>
                <div class="d-flex">
                    <ul style="list-style: none">
                        <li class="font-weight-bold">NIP</li>
                        <li class="font-weight-bold">NAMA LENGKAP</li>
                        <li class="font-weight-bold">BIDANG</li>
                        <li class="font-weight-bold">JENIS KELAMIN</li>
                    </ul>
                    <ul style="list-style: none">
                        <li>:</li>
                        <li>:</li>
                        <li>:</li>
                        <li>:</li>
                    </ul>
                    <ul style="list-style: none">
                        <li>0123456789</li>
                        <li>PUGUH RISMADI</li>
                        <li>KEPALA PROGRAM REKAYASA PERANGKAT LUNAK (RPL)</li>
                        <li>LAKI-LAKI</li>
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