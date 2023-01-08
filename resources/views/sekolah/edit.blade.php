@extends('mylayouts.main')

@section('container')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title" style="color: #369488">Edit Profile</h4>
            <form action="{{ route('sekolah.update.own') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="mb-3">
                    <label for="logo">Logo (opsional)</label>
                    <input class="form-control form-control-sm" type="file" id="logo" name="logo" style="border-radius: 5px; font-size: 15px;">
                </div>
                <div class="mb-3">
                    <label for="nama">Nama Sekolah</label>
                    <input class="form-control form-control-sm @error('nama') is-invalid @enderror" type="text" placeholder="Masukan Nama Sekolah" value="{{ $data->nama, old('nama') }}" name="nama" id="nama" style=" font-size: 15px;">
                    @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="npsn">NPSN</label>
                    <input class="form-control form-control-sm @error('npsn') is-invalid @enderror" type="text" placeholder="Masukan NPSN" value="{{ $data->npsn, old('npsn') }}" name="npsn" id="npsn" style=" font-size: 15px;">
                    @error('npsn')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="kepala_sekolah">Nama Kepala Sekolah</label>
                    <input class="form-control form-control-sm @error('kepala_sekolah') is-invalid @enderror" type="text" placeholder="Masukan Nama Kepala Sekolah" value="{{ $data->kepala_sekolah, old('kepala_sekolah') }}" name="kepala_sekolah" id="kepala_sekolah" style=" font-size: 15px;">
                    @error('kepala_sekolah')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="ref_provinsi_id" class="form-label">Provinsi</label>
                    <select class="between-input-item-select form-control" name="ref_provinsi_id" id="ref_provinsi_id">
                        <option value="">Pilih Provinsi</option>
                        @foreach ($provinsis as $provinsi)
                        <option value="{{ $provinsi->id }}" {{ isset($data) ? ($data->ref_provinsi_id == $provinsi->id ? 'selected' : '') : (old('ref_provinsi_id') == $provinsi->id ? 'selected' : '') }}>{{ $provinsi->nama }}</option>
                        @endforeach
                    </select>
                    @error('ref_provinsi_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="ref_kabupaten_id" class="form-label">Kota/Kabupaten</label>
                    <select class="between-input-item-select form-select" name="ref_kabupaten_id" id="ref_kabupaten_id">
                        <option value="">Pilih Kota/Kabupaten</option>
                    </select>
                    @error('ref_kabupaten_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="ref_kecamatan_id" class="form-label">Kecamatan</label>
                    <select class="between-input-item-select form-select" name="ref_kecamatan_id" id="ref_kecamatan_id">
                        <option value="">Pilih Kecamatan</option>
                    </select>
                    @error('ref_kecamatan_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="ref_kelurahan_id" class="form-label">Kelurahan</label>
                    <select class="between-input-item-select form-select" name="ref_kelurahan_id" id="ref_kelurahan_id">
                        <option value="">Pilih Kelurahan</option>
                    </select>
                    @error('ref_kelurahan_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="jalan" class="form-label">Jalan</label>
                    <input type="text" class="form-control @error('jalan') is-invalid @enderror" placeholder="Masukan Jalan"
                        name="jalan" value="{{ isset($data) ? $data->jalan : old('jalan') }}"
                        style=" font-size: 15px;" id="jalan">
                    @error('jalan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="instagram">Instagram (opsional)</label>
                    <input class="form-control form-control-sm" type="text" placeholder="https://instagram.com" value="{{ $data->instagram, old('instagram') }}" name="instagram" id="instagram" style=" font-size: 15px;">
                </div>
                <div class="mb-3">
                    <label for="youtube">Youtube (opsional)</label>
                    <input class="form-control form-control-sm" type="text" placeholder="https://youtube.com" value="{{ $data->youtube, old('youtube') }}" name="youtube" id="youtube" style=" font-size: 15px;">
                </div>
                <button class="btn text-white" type="submit" style="background-color: #3bae9c">Update</button>
            </form>
        </div>
    </div>
@endsection