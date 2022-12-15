@extends('mylayouts.main')

@section('container')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title" style="color: #369488">Edit Profile</h4>
            <form action="/sekolah/{{ Auth::user()->sekolah->id }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="mb-3">
                    <label for="logo">Logo (opsional)</label>
                    <input class="form-control form-control-lg" type="file" id="logo" name="logo" style="border-radius: 5px; font-size: 15px; height: 6.5vh;">
                </div>
                <div class="mb-3">
                    <label for="nama">Nama Sekolah</label>
                    <input class="form-control form-control-lg @error('nama') is-invalid @enderror" type="text" placeholder="Masukan Nama Sekolah" value="{{ Auth::user()->sekolah->nama, old('nama') }}" name="nama" id="nama" style=" font-size: 15px; height: 6.5vh;">
                    @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="npsn">NPSN</label>
                    <input class="form-control form-control-lg @error('npsn') is-invalid @enderror" type="text" placeholder="Masukan NPSN" value="{{ Auth::user()->sekolah->npsn, old('npsn') }}" name="npsn" id="npsn" style=" font-size: 15px; height: 6.5vh;">
                    @error('npsn')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="kepala_sekolah">Nama Kepala Sekolah</label>
                    <input class="form-control form-control-lg @error('kepala_sekolah') is-invalid @enderror" type="text" placeholder="Masukan Nama Kepala Sekolah" value="{{ Auth::user()->sekolah->kepala_sekolah, old('kepala_sekolah') }}" name="kepala_sekolah" id="kepala_sekolah" style=" font-size: 15px; height: 6.5vh;">
                    @error('kepala_sekolah')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="alamat">Alamat</label>
                    <input class="form-control form-control-lg @error('alamat') is-invalid @enderror" type="text" placeholder="Masukan Alamat" value="{{ Auth::user()->sekolah->alamat, old('alamat') }}" name="alamat" id="alamat" style=" font-size: 15px; height: 6.5vh;">
                    @error('alamat')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="instagram">Instagram (opsional)</label>
                    <input class="form-control form-control-lg" type="text" placeholder="https://instagram.com" value="{{ Auth::user()->sekolah->instagram, old('instagram') }}" name="instagram" id="instagram" style=" font-size: 15px; height: 6.5vh;">
                </div>
                <div class="mb-3">
                    <label for="youtube">Youtube (opsional)</label>
                    <input class="form-control form-control-lg" type="text" placeholder="https://youtube.com" value="{{ Auth::user()->sekolah->youtube, old('youtube') }}" name="youtube" id="youtube" style=" font-size: 15px; height: 6.5vh;">
                </div>
                <button class="btn text-white" type="submit" style="background-color: #3bae9c">Update</button>
            </form>
        </div>
    </div>
@endsection