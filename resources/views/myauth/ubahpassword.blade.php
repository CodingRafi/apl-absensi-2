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
  <!-- inject:css -->
  <link rel="stylesheet" href="/template/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="/template/images/favicon.png" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper p-0">
      <div class="content-wrapper d-flex align-items-center auth px-0" style="background-image: url('/img/bgc.jpg'); background-size: cover; background-repeat: no-repeat">
        <div class="row w-100 mx-0">
          <div class="col-lg-8 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5" style="border-radius: 10px; box-shadow: box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.276);">
              <div class="title" style="display: flex; justify-content:space-between">
                  <h3>Ubah Password</h3>
                  <form action="/user-settings" method="get">
                    @include('mypartials.tahunajaran')
                    <button class="btn btn-sm btn-danger" style="min-width: 5vw; border-radius: 5px; font-weight: 500;">Kembali</button>
                </form>
              </div>
              <!-- Session Status -->
              <x-auth-session-status class="mb-4" :status="session('status')" />

              <!-- Validation Errors -->
              <x-auth-validation-errors class="mb-4" :errors="$errors" />

              <form action="/reset" style="width: 100%; margin-top: 5vh">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control input-email" id="email" placeholder="name@example.com" name="email" style="width: 100%; height: 7vh;" value="{{ Auth::user()->email }}">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control input-password" id="password" name="password" placeholder="Masukan password baru" style="width: 100%; height: 7vh;">
                </div>
                <div class="mb-3">
                    <label for="confirm-password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control input-confirm-password" id="confirm-password" name="password_confirmation" placeholder="Konfirmasi password baru" style="width: 100%; height: 7vh;">
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-block btn-lg text-white auth-form-btn" style="background-color: #3bae9c; width:100%; padding: 10px; font-size: 15px; border-radius: 5px;">Send Reset Password</button>
                </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- plugins:js -->
  <script src="/template/vendors/js/vendor.bundle.base.js"></script>
  <!-- inject:js -->
  <script src="/template/js/off-canvas.js"></script>
  <script src="/template/js/hoverable-collapse.js"></script>
  <script src="/template/js/template.js"></script>
  <script src="/template/js/settings.js"></script>
  <script src="/template/js/todolist.js"></script>
</body>
</html>

