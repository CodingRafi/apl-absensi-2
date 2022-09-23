@extends('mylayouts.main')

@section('container')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title" style="color: #369488">Edit Profile</h4>
            <form action="/sekolah/{{ Auth::user()->sekolah->id }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="mb-3">
                    <label for="">Logo (opsional)</label>
                    <input class="form-control form-control-lg" type="file" id="formFile" name="logo" style="border-radius: 5px; font-size: 15px; height: 6.5vh;">
                </div>
                <div class="mb-3">
                    <label for="">Nama Sekolah</label>
                    <input class="form-control form-control-lg" type="text" placeholder="Masukan Nama Sekolah" value="{{ Auth::user()->sekolah->nama }}" name="nama" style=" font-size: 15px; height: 6.5vh;">
                </div>
                <div class="mb-3">
                    <label for="">NPSN</label>
                    <input class="form-control form-control-lg" type="text" placeholder="Masukan NPSN" value="{{ Auth::user()->sekolah->npsn }}" name="npsn" style=" font-size: 15px; height: 6.5vh;">
                </div>
                <div class="mb-3">
                    <label for="">Nama Kepala Sekolah</label>
                    <input class="form-control form-control-lg" type="text" placeholder="Masukan Nama Kepala Sekolah" value="{{ Auth::user()->sekolah->kepala_sekolah }}" name="kepala_sekolah" style=" font-size: 15px; height: 6.5vh;">
                </div>
                <div class="mb-3">
                    <label for="">Alamat</label>
                    <input class="form-control form-control-lg" type="text" placeholder="Masukan Alamat" value="{{ Auth::user()->sekolah->alamat }}" name="alamat" style=" font-size: 15px; height: 6.5vh;">
                </div>
                <div class="mb-3">
                    <label for="">Instagram (opsional)</label>
                    <input class="form-control form-control-lg" type="text" placeholder="https://instagram.com" value="{{ Auth::user()->sekolah->instagram }}" name="instagram" style=" font-size: 15px; height: 6.5vh;">
                </div>
                <div class="mb-3">
                    <label for="">Youtube (opsional)</label>
                    <input class="form-control form-control-lg" type="text" placeholder="https://youtube.com" value="{{ Auth::user()->sekolah->youtube }}" name="youtube" style=" font-size: 15px; height: 6.5vh;">
                </div>
                <button class="btn text-white" type="submit" style="background-color: #3bae9c">Update</button>
            </form>
        </div>
    </div>
@endsection