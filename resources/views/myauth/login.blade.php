<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  {{-- bootstrap --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper p-0">
      <div class="content-wrapper d-flex align-items-center auth px-0" style="background-image: url('/img/bgc.jpg'); background-size: cover; background-repeat: no-repeat">
        <div class="row w-100 mx-0">
          <div class="col-lg-6 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5" style="border-radius: 1rem; box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.276)">
              <x-auth-validation-errors class="mb-4" :errors="$errors" />
              <form action="/login" method="POST" style="width: 100%;">
                @csrf
                <input type="hidden" class="role" name="role" id="">
                <div class="container p-0">
                    <h1 class="mb-3" style="color: #263238;">Masuk</h1>
                    <div class="mb-3">
                        <select class="form-select select-pilihan text-dark" aria-label="Default select example" style="width: 100%; height: 7vh; border: 1px solid rgb(205, 205, 205); border-radius: 5px">
                            <option value="belum" selected>Masuk Sebagai</option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->name }}" style="text-transform: capitalize;">{{ str_replace("_", " ", $role->name) }}</option>
                            @endforeach              
                            <option value="siswa">Siswa</option>
                        </select>
                    </div>
                    <div class="mb-3 div-email">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control input-email" id="email" placeholder="name@example.com"
                            name="login" style="width: 100%; height: 7vh;" disabled>
                    </div>
                    <div class="mb-3 div-nip" style="display: none;">
                        <label for="nip" class="form-label">NIP</label>
                        <input type="number" class="form-control input-nip" id="nip" placeholder="NIP" name="login">
                    </div>
                    <div class="mb-3 div-nipd" style="display: none;">
                        <label for="nipd" class="form-label">NIPD</label>
                        <input type="number" class="form-control input-nipd" id="nipd" placeholder="NIPD" name="login">
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" id="password" class="form-control input-password" name="password" style="width: 100%; height: 7vh; border: 1px solid rgb(205, 205, 205); border-radius: 5px" placeholder="&nbsp;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" disabled>
                    </div>
                    <div class="mb-3">
                        <div class="container p-0">
                            <div class="row" style=" width: 100%; display: flex; justify-content: space-between;">
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                        <label class="form-check-label m-0" for="remember">Remember Me</label>
                                    </div>
                                </div>
                                <div class="col-6 d-flex justify-content-end align-items-center">
                                  <a href="forgot-password" style="font-size: 12.5px; text-decoration: none; font-weight: 600; color:#3bae9c;">Lupa Password?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-grid gap-2">
                            <button class="btn text-white tombol-masuk" type="submit" style="background: #3bae9c; width: 100%;" disabled>Masuk</button>
                        </div>
                    </div>
                </div>
                <a href="/register" class="d-flex justify-content-center mt-3"><i class="bi bi-arrow-left-circle mr-2"></i> Don't have an account? register now!</a>
            </form>
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

  {{-- js login --}}
  <script>
      const inputValue = document.querySelector('.role');
      const inputEmail = document.querySelector('.input-email');
      const divEmail = document.querySelector('.div-email');
      const inputNip = document.querySelector('.input-nip'); 
      const divNip = document.querySelector('.div-nip');
      const inputNipd = document.querySelector('.input-nipd'); 
      const divNipd = document.querySelector('.div-nipd');
      const inputPassword = document.querySelector('.input-password');
      const tombolMasuk = document.querySelector('.tombol-masuk');
      const selectPilihan = document.querySelector('.select-pilihan');
      let sebelum;

      selectPilihan.addEventListener('change', function(e){
        inputValue.value = e.target.value
        if (selectPilihan.value == 'belum') {
          if(sebelum == 'siswa'){
            inputNipd.setAttribute('disabled', 'disabled');
            inputPassword.setAttribute('disabled', 'disabled');
          }else if(sebelum == 'guru'){
            inputNip.setAttribute('disabled', 'disabled');
            inputPassword.setAttribute('disabled', 'disabled');
          }else{
            inputEmail.setAttribute('disabled', 'disabled');
            inputPassword.setAttribute('disabled', 'disabled');
          }
          tombolMasuk.setAttribute('disabled', 'disabled')
        }else if(selectPilihan.value != 'belum' && selectPilihan.value == 'siswa') {
          inputEmail.setAttribute('disabled', 'disabled');
          divEmail.style.display = 'none';
          inputNip.setAttribute('disabled', 'disabled');
          divNip.style.display = 'none';
          inputNipd.removeAttribute('disabled');
          divNipd.style.display = 'block';
          inputPassword.removeAttribute('disabled');
          sebelum = 'siswa';
          tombolMasuk.removeAttribute('disabled');
        }else if(selectPilihan.value != 'belum' && selectPilihan.value == 'guru' || selectPilihan.value == 'karyawan'){
          inputEmail.setAttribute('disabled', 'disabled');
          divEmail.style.display = 'none';
          inputNipd.setAttribute('disabled', 'disabled');
          divNipd.style.display = 'none';
          inputNip.removeAttribute('disabled');
          divNip.style.display = 'block';
          inputPassword.removeAttribute('disabled');
          sebelum = selectPilihan.value;
          tombolMasuk.removeAttribute('disabled');
        }else{
          inputEmail.removeAttribute('disabled');
          divEmail.style.display = 'block';
          inputNip.setAttribute('disabled', 'disabled');
          divNip.style.display = 'none';
          inputNipd.setAttribute('disabled', 'disabled');
          divNipd.style.display = 'none';
          inputPassword.removeAttribute('disabled');
          sebelum = 'lainnya';
          tombolMasuk.removeAttribute('disabled');
        }
      })
  </script>
</body>
</html>