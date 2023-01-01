@extends('mylayouts.guard')

<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<style>
  /* Mark input boxes that gets an error on validation: */
  input.invalid {
    background-color: #ffdddd;
  }

  /* Hide all steps by default: */
  .tab {
    display: none;
  }

  #prevBtn {
    background-color: #bbbbbb;
    border-radius: 5px;
    font-weight: 500;
    cursor: pointer;
  }

  #nextBtn {
    background-color: #3bae9c;
    border-radius: 5px;
    font-weight: 500;
    cursor: pointer;
  }

  button:hover {
    opacity: 0.8;
  }

  .btn-check:focus+.btn,
  .btn:focus {
    box-shadow: none !important;
  }

  /* Make circles that indicate the steps of the form: */
  .step {
    height: 8px;
    width: 8px;
    margin: 0 2px;
    background-color: #bbbbbb;
    border: none;
    border-radius: 50%;
    display: inline-block;
    opacity: 0.5;
  }

  .step.active {
    opacity: 1;
  }

  /* Mark the steps that are finished and valid: */
  .step.finish {
    background-color: #3bae9c;
  }
</style>

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

            <form class="p-0 pt-3 m-0" action="{{ route('register.store') }}" id="regForm" method="post"
              style=" width: 100%;" enctype="multipart/form-data">
              @csrf
              <div class="tab" id="sekolah">
                <h5>Data Sekolah</h5>
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
                    style="border: 1px solid rgb(205, 205, 205); border-radius: 5px; height: 3rem; width: 100%"
                    required>
                    <option value="">Pilih Tingkat</option>
                    <option value="sd" {{ old('tingkat')=='sd' ? 'selected' : '' }}>SD</option>
                    <option value="smp" {{ old('tingkat')=='smp' ? 'selected' : '' }}>SMP</option>
                    <option value="sma" {{ old('tingkat')=='sma' ? 'selected' : '' }}>SMA</option>
                    <option value="smk" {{ old('tingkat')=='smk' ? 'selected' : '' }}>SMK</option>
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
                      'selected' : '') : (old('ref_provinsi_id') == $provinsi->id ? 'selected' : '') }}>{{
                      $provinsi->nama
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
                  <input type="text" class="form-control @error('jalan') is-invalid @enderror"
                    placeholder="Masukan Jalan" name="jalan" value="{{ isset($data) ? $data->jalan : old('jalan') }}"
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
                  <input type="text" class="form-control form-control-lg" placeholder="https://youtube.com"
                    name="youtube" style="border-radius: 5px; width: 100%">
                </div>
              </div>

              <div class="tab" id="admin" style="display: none;">
                <h5>Data user admin sekolah</h5>
                <div class="form-group">
                  <label for="nama" class="form-label">Nama admin sekolah</label>
                  <input type="text" class="form-control form-control-sm" placeholder="Nama" name="name"
                    style="border-radius: 5px; width: 100%" value="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control form-control-sm" placeholder="Email" name="email"
                    style="border-radius: 5px; width: 100%" value="{{ old('email') }}" required>
                </div>
                <div class="form-group">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control form-control-sm" placeholder="password" name="password"
                    style="border-radius: 5px; width: 100%" required>
                </div>
              </div>

              <div class="tab" id="yayasan" style="display: none;">
                <h5>Data user yayasan (opsional)</h5>
                <div class="form-group">
                  <label for="nama" class="form-label">Nama yayasan</label>
                  <input type="text" class="form-control form-control-sm name-yayasan" placeholder="Nama"
                    name="name_yayasan" style="border-radius: 5px; width: 100%" value="{{ old('name_yayasan') }}">
                </div>
                <div class="form-group">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control form-control-sm email-yayasan" placeholder="Email"
                    name="email_yayasan" style="border-radius: 5px; width: 100%" value="{{ old('email_yayasan') }}">
                </div>
                <div class="form-group">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control form-control-sm password-yayasan" placeholder="Password"
                    name="password_yayasan" style="border-radius: 5px; width: 100%">
                </div>
              </div>

              <div class="mt-3" style="overflow:auto;">
                <div style="float:right;">
                  <button class="btn text-white" type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                  <button class="btn text-white" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                </div>
              </div>

              <div style="text-align:center;margin-top:40px;">
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>
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
<script>
  var currentTab = 0; // Current tab is set to be the first tab (0)
  showTab(currentTab); // Display the current tab
  
  function showTab(n) {
    // This function will display the specified tab of the form...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    //... and fix the Previous/Next buttons:
    if (n == 0) {
      document.getElementById("prevBtn").style.display = "none";
    } else {
      document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
      document.getElementById("nextBtn").innerHTML = "Submit";
    } else {
      document.getElementById("nextBtn").innerHTML = "Next";
    }
    //... and run a function that will display the correct step indicator:
    fixStepIndicator(n)
  }
  
  function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form...
    if (currentTab >= x.length) {
      // ... the form gets submitted:
      document.getElementById("regForm").submit();
      return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
  }
  
  function validateForm() {
    // This function deals with validation of the form fields
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
      document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid; // return the valid status
  }
  
  function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
      x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class on the current step:
    x[n].className += " active";
  }
</script>
@endpush
@include('mypartials.js')