@extends('mylayouts.main')

@section('container')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title" style="color: #369488">Edit Profile</h4>
            <div class="mb-3">
                <label for="">Logo</label>
                <input class="form-control form-control-lg" type="file" id="formFile" name="file" style="border-radius: 5px; height: 3vh">
            </div>
            <div class="mb-3">
                <label for="">Nama Sekolah</label>
                <input class="form-control form-control-lg" type="text" placeholder="Masukan Nama Sekolah">
            </div>
            <div class="mb-3">
                <label for="">NPSN</label>
                <input class="form-control form-control-lg" type="text" placeholder="Masukan NPSN">
            </div>
            <div class="mb-3">
                <label for="">Nama Kepala Sekolah</label>
                <input class="form-control form-control-lg" type="text" placeholder="Masukan Nama Kepala Sekolah">
            </div>
            <div class="mb-3">
                <label for="">Alamat</label>
                <input class="form-control form-control-lg" type="text" placeholder="Masukan Alamat">
            </div>
            <div class="mb-3">
                <label for="">Instagram</label>
                <input class="form-control form-control-lg" type="text" placeholder="Masukan Instagram">
            </div>
            <div class="mb-3">
                <label for="">Youtube</label>
                <input class="form-control form-control-lg" type="text" placeholder="Masukan Youtube">
            </div>
            <button class="btn text-white" type="submit" style="background-color: #3bae9c">Update</button>
        </div>
    </div>
@endsection