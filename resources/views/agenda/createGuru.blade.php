@extends('mylayouts.main')

@section('container')
    <div class="card">
        <div class="card-body">
            <div class="title d-flex justify-content-between">
                <h4 class="card-title">Create Jadwal</h4>
                <form action="/agenda-guru" method="get">
                    @include('mypartials.tahunajaran')
                    <button class="btn btn-sm btn-danger text-white font-weight-bold">Kembali</button>
                </form>
            </div>
            <div class="mt-3 mb-3">
                <label for="hari" class="form-label">Hari</label>
                <select name="hari" id="hari" class="form-control">
                    <option value="">Senin</option>
                </select>
            </div>
            <div class="mt-3 mb-3">
                <label for="nama" class="form-label">Nama</label>
                <select name="nama" id="nama" class="form-control">
                    <option value="">Puguh Rismadi</option>
                </select>
            </div>
            <div class="mt-3 mb-3">
                <label for="kelas" class="form-label">Kelas</label>
                <select name="kelas" id="kelas" class="form-control">
                    <option value="">X RPL 1</option>
                </select>
            </div>
            <div class="mt-3 mb-3">
                <label for="mapel" class="form-label">Mata Pelajaran</label>
                <select name="mapel" id="mapel" class="form-control">
                    <option value="">Pemrograman Berorientasi Objek (PBO)</option>
                </select>
            </div>
            <div class="mt-3 mb-3">
                <label for="jam-awal" class="form-label">Jam Awal</label>
                <input type="time" name="jam-awal" id="jam-awal" class="form-control">
            </div>
            <div class="mt-3 mb-3">
                <label for="jam-akhir" class="form-label">Jam Akhir</label>
                <input type="time" name="jam-akhir" id="jam-akhir" class="form-control">
            </div>
            <button class="btn text-white" style="background-color: #3bae9c">Buat</button>
        </div>
    </div>
@endsection

