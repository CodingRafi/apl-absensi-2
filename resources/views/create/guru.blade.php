@extends('mylayouts.main')

@section('container')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title float-left">Create Data Guru</h4>
            <a href="" class="btn btn-sm btn-danger font-weight-bold float-right text-white">Kembali</a>
            <form class="mt-5">
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">NIP</label>
                  <input type="number" class="form-control" placeholder="Masukan NIP">
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
                  <input type="text" class="form-control" placeholder="Masukan Nama">
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Tempat Lahir</label>
                  <input type="text" class="form-control" placeholder="Masukan Tempat Lahir">
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Tanggal Lahir</label>
                  <input type="date" class="form-control" placeholder="Masukan Tanggal Lahir">
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Agama</label>
                  <input type="text" class="form-control" placeholder="Masukan Agama">
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Jenis Kelamin</label>
                  <select class="form-control" aria-label="Default select example">
                    <option selected></option>
                    <option value="1">Laki-laki</option>
                    <option value="2">Perempuan</option>
                  </select>
                </div>
                <div class="mb-3">
                    <label for="">Alamat</label>
                    <div><textarea class="form-label" cols="102" rows="10" placeholder="Masukan Alamat"></textarea></div>
                </div>
                <button type="submit" class="btn text-white" style="background-color: #3bae9c">Simpan</button>
              </form>
        </div>
    </div>
@endsection