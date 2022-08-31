<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="/template/vendors/feather/feather.css">
  <link rel="stylesheet" href="/template/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="/template/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="/template/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="/template/images/favicon.png" />

  {{-- css bootstrap --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  {{-- icon bootstrap --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper p-0 ">
      <div class="content-wrapper d-flex align-items-center auth px-0" style="background-image: url('/img/bgc.jpg'); background-size: cover; background-repeat: no-repeat">
        <div class="row w-100 mx-0">
          <div class="col-lg-8 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5" style="border-radius: 10px; box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.276)">
              <h3>Register</h3>
              <!-- Session Status -->
              <x-auth-session-status class="mb-4" :status="session('status')" />

              <!-- Validation Errors -->
              <x-auth-validation-errors class="mb-4" :errors="$errors" />

              <form class="pt-3" action="{{ route('password.email') }}" method="post" style=" width: 100%; display: flex; flex-wrap:wrap; justify-content: space-between">
                @csrf
                <div class="form-group">
                  <label for="nama" class="form-label">Nama Sekolah</label>
                  <input type="text" class="form-control form-control-lg" placeholder="Nama Sekolah"
                    name="sekolah" style="border-radius: 5px; width: 100%">
                </div>
                <div class="form-group">
                  <label for="npsn" class="form-label">NPSN</label>
                  <input type="text" class="form-control form-control-lg" placeholder="NPSN"
                    name="npsn" style="border-radius: 5px; width: 100%">
                </div>
                <div class="form-group">
                  <label for="alamat" class="form-label">Alamat</label>
                  <input type="text" class="form-control form-control-lg" placeholder="alamat"
                    name="alamat" style="border-radius: 5px; width: 100%">
                </div>
                <div class="form-group">
                  <label for="logo" class="form-label">Logo</label>
                  <input class="form-control form-control-lg" type="file" id="formFile" name="file" style="border-radius: 5px; height: 2.2rem; width: 100%">
                </div>
                <div class="form-group">
                  <label for="logo" class="form-label">Tingkat</label>
                  <br>
                  <select name="" id="" class="text-dark form-control form-control-lg" style="border: 1px solid rgb(205, 205, 205); border-radius: 5px; height: 3rem; width: 100%">
                    <option value="">SD</option>
                    <option value="">SMP</option>
                    <option value="">SMA</option>
                    <option value="">SMK</option>
                  </select>
                </div>
            </form>
            <a href="/login" class="d-flex justify-content-center mt-3"><i class="bi bi-arrow-left-circle mr-2"></i> Back to login</a>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="/template/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="/template/js/off-canvas.js"></script>
  <script src="/template/js/hoverable-collapse.js"></script>
  <script src="/template/js/template.js"></script>
  <script src="/template/js/settings.js"></script>
  <script src="/template/js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>