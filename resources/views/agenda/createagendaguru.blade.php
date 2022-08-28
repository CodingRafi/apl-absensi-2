@extends('mylayouts.main')

@section('container')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title float-left">Create Agenda Guru</h4>
            <a href="" class="btn btn-sm btn-danger font-weight-bold float-right text-white">Kembali</a>
            <form class="mt-5">
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Nama</label>
                  <input type="text" class="form-control" placeholder="Masukan Nama">
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Mata Pelajaran</label>
                  <input type="text" class="form-control" placeholder="Masukan Mata Pelajaran">
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Hari/ Tanggal</label>
                  <input type="date" class="form-control" placeholder="Masukan Hari/ Tanggal">
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Jam Awal</label>
                  <input type="time" class="form-control" placeholder="Masukan Jam Awal">
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Jam Akhir</label>
                  <input type="time" class="form-control" placeholder="Masukan Akhir">
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Kelas</label>
                  <select name="" id="" class="btn" style="width: 55.5rem; border: 1px solid rgb(202, 202, 202); text-align:left;">
                      <option value="">X RPL</option>
                      <option value="">XI RPL</option>
                      <option value="">XII RPL</option>
                  </select>
              </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Materi</label>
                  <input type="text" class="form-control" placeholder="Masukan Materi">
                </div>
                <button type="submit" class="btn btn-sm text-white font-weight-bold px-3" style="background-color: #3bae9c">Simpan</button>
              </form>
        </div>
    </div>
@endsection