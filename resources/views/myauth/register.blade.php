@extends('mylayouts.guard')

@section('content')
<div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper p-0 ">
    <div class="content-wrapper d-flex align-items-center auth px-0"
      style="background-image: url('/img/bgc.jpg'); background-size: cover; background-repeat: no-repeat">
      <div class="row w-100 mx-0">
        <div class="col-lg-6 mx-auto">
          <div class="auth-form-light text-left py-5 px-4 px-sm-5"
            style="border-radius: 10px; box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.276)">
            <h3>Register</h3>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4 text-danger" :errors="$errors" />

            <form class="pt-3" action="{{ route('register.store') }}" method="post" style=" width: 100%;"
              enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="nama" class="form-label">Nama Sekolah</label>
                <input type="text" class="form-control form-control-lg" placeholder="Nama Sekolah" name="nama_sekolah"
                  style="border-radius: 5px; width: 100%" value="{{ old('nama_sekolah') }}" required>
              </div>
              <div class="form-group">
                <label for="npsn" class="form-label">NPSN</label>
                <input type="number" class="form-control form-control-lg" placeholder="NPSN" name="npsn"
                  style="border-radius: 5px; width: 100%" value="{{ old('npsn') }}" required>
              </div>
              <div class="form-group">
                <label for="kepala_sekolah" class="form-label">Nama Kepala Sekolah</label>
                <input type="text" class="form-control form-control-lg" placeholder="Kepala Sekolah"
                  name="kepala_sekolah" style="border-radius: 5px; width: 100%" value="{{ old('kepala_sekolah') }}"
                  required>
              </div>
              <div class="form-group">
                <label for="tingkat" class="form-label">Tingkat</label>
                <br>
                <select name="tingkat" id="tingkat" class="text-dark form-control form-control-lg"
                  style="border: 1px solid rgb(205, 205, 205); border-radius: 5px; height: 3rem; width: 100%" required>
                  <option value="">Pilih Tingkat</option>
                  <option value="sd" {{ old('tingkat') == 'sd' ? 'selected' : '' }}>SD</option>
                  <option value="smp" {{ old('tingkat') == 'smp' ? 'selected' : '' }}>SMP</option>
                  <option value="sma" {{ old('tingkat') == 'sma' ? 'selected' : '' }}>SMA</option>
                  <option value="smk" {{ old('tingkat') == 'smk' ? 'selected' : '' }}>SMK</option>
                </select>
              </div>
              <div class="form-group">
                <label for="logo" class="form-label">Logo (opsional)</label>
                <input class="form-control form-control-lg" type="file" id="formFile" name="logo"
                  style="border-radius: 5px; height: 2.2rem; width: 100%">
              </div>
              <div class="mb-3">
                <label for="ref_provinsi_id" class="form-label">Provinsi</label>
                <select class="between-input-item-select form-control" name="ref_provinsi_id" id="ref_provinsi_id">
                  <option value="">Pilih Provinsi</option>
                  @foreach ($provinsis as $provinsi)
                  <option value="{{ $provinsi->id }}" {{ isset($data) ? ($data->ref_provinsi_id == $provinsi->id ?
                    'selected' : '') : (old('ref_provinsi_id') == $provinsi->id ? 'selected' : '') }}>{{ $provinsi->nama
                    }}</option>
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
                  style=" font-size: 15px; height: 6.5vh;" id="jalan">
                @error('jalan')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
              <div class="form-group">
                <label for="instagram" class="form-label">Instagram (opsional)</label>
                <input type="text" class="form-control form-control-lg" placeholder="https://instagram.com"
                  name="instagram" style="border-radius: 5px; width: 100%">
              </div>
              <div class="form-group">
                <label for="youtube" class="form-label">Youtube (opsional)</label>
                <input type="text" class="form-control form-control-lg" placeholder="https://youtube.com" name="youtube"
                  style="border-radius: 5px; width: 100%">
              </div>

              <hr>

              <h3>User admin sekolah</h3>
              <div class="form-group">
                <label for="nama" class="form-label">Nama admin sekolah</label>
                <input type="text" class="form-control form-control-lg" placeholder="Nama" name="name"
                  style="border-radius: 5px; width: 100%" value="{{ old('name') }}" required>
              </div>
              <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control form-control-lg" placeholder="email" name="email"
                  style="border-radius: 5px; width: 100%" value="{{ old('email') }}" required>
              </div>
              <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control form-control-lg" placeholder="password" name="password"
                  style="border-radius: 5px; width: 100%" required>
              </div>

              <hr>
              <h3>User yayasan (opsional)</h3>
              <div class="form-group">
                <label for="nama" class="form-label">Nama yayasan</label>
                <input type="text" class="form-control form-control-lg name-yayasan" placeholder="Nama"
                  name="name_yayasan" style="border-radius: 5px; width: 100%" value="{{ old('name_yayasan') }}">
              </div>
              <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control form-control-lg email-yayasan" placeholder="email"
                  name="email_yayasan" style="border-radius: 5px; width: 100%" value="{{ old('email_yayasan') }}">
              </div>
              <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control form-control-lg password-yayasan" placeholder="password"
                  name="password_yayasan" style="border-radius: 5px; width: 100%">
              </div>

              <div class="mt-3">
                <button type="submit" class="btn btn-block btn-lg text-white font-weight-medium auth-form-btn"
                  style="background-color: #3bae9c">Register</button>
              </div>
            </form>
            <a href="/login" class="d-flex justify-content-center mt-3"><i class="bi bi-arrow-left-circle mr-2"></i>
              Back to login</a>
          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>
@endsection

@push('js')
<script>
  const nameYayasan = document.querySelector('.name-yayasan');
  nameYayasan.addEventListener('keyup', function(e){
      if(e.target.value.length > 0){
        document.querySelector('.email-yayasan').required = true;
        document.querySelector('.password-yayasan').required = true;
      }else{
        document.querySelector('.email-yayasan').required = false;
        document.querySelector('.password-yayasan').required = false;
      }
  })
</script>
@endpush
@include('mypartials.js')

