<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <!-- plugins:css -->
  <link rel="stylesheet" href="/template/vendors/feather/feather.css">
  <link rel="stylesheet" href="/template/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="/template/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <!-- endinject -->

  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="/template/vendors/ti-icons/css/themify-icons.css">
  <!-- End plugin css for this page -->

  <!-- inject:css -->
  <link rel="stylesheet" href="/template/css/vertical-layout-light/style.css">
  <!-- endinject -->

  {{-- css bootstrap --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  {{-- bundle bootstrap --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>

  {{-- icon svg bootstrap --}}
  <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
      <path
        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
    </symbol>
    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
      <path
        d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
    </symbol>
    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
      <path
        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
    </symbol>
  </svg>

  <link rel="shortcut icon" href="/template/images/favicon.png" />

  <link href='/fullcalendar/lib/main.css' rel='stylesheet' />
  <script src='/fullcalendar/lib/main.js'></script>

  <style>
    body.sidebar-icon-only .nav-item span {
      display: none;
    }

    body.sidebar-icon-only .nav-link {
      display: flex;
      justify-content: center;
      align-content: center
    }

    body.sidebar-icon-only .nav-link i {
      margin: 0 !important;
    }

    body.sidebar-icon-only .nav-item.hover-open,
    .sidebar .nav-item:hover {
      border-radius: 10px !important;
    }

    .navbar .navbar-brand-wrapper .brand-logo-mini img {
      width: 100% !important;
    }

    .alert-nontifikasi {
      transition: 1s;
    }

    @media (max-width: 400px) {
      .tahun-ajaran-navbar {
        color: transparent;
        width: 5px;
      }
    }
    
    .swal2-icon.swal2-warning.swal2-icon-show {
    animation: swal2-animate-error-icon .5s;
    margin-top: 50px;
    margin-bottom: 10px !important;
    }

    .swal2-modal .swal2-title {
    font-size: 25px;
    line-height: 1;
    font-weight: 600 !important;
    color: #1F1F1F;
    font-weight: initial;
    margin-bottom: 0;
    }
  </style>

  @yield('tambahcss')
</head>

<body>
  <div class="container-scroller">

    <!-- partial:partials/_navbar.html -->
    @include('mypartials.navbar')
    <!-- partial -->

    <div class="container-fluid page-body-wrapper">

      <!-- partial:partials/_settings-panel.html -->
      @include('mypartials.settings-panel')
      <!-- partial -->

      <!-- partial:partials/_sidebar.html -->
      @include('mypartials.aside')
      <!-- partial -->

      <div class="main-panel">
        <div class="content-wrapper">
          <div class="container" style="width: 15rem">
            {{-- @include('vendor.lara-izitoast.toast') --}}
          </div>
          @yield('container')
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

  <form action="" class="form-delete" method="POST">
    @csrf
    @method('delete')
    @stack('other_delete')
  </form>


  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="/template/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="/template/vendors/chart.js/Chart.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="/template/js/off-canvas.js"></script>
  <script src="/template/js/hoverable-collapse.js"></script>
  <script src="/template/js/template.js"></script>
  <script src="/template/js/settings.js"></script>
  <script src="/template/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  {{-- <script src="/template/js/dashboard.js"></script> --}}
  <script src="/template/js/Chart.roundedBarCharts.js"></script>
  <script src="/template/js/chart.js"></script>
  <!-- End custom js for this page-->

  {{-- ajax --}}
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function deleteData(url){
          Swal.fire({
              title: 'Apakah anda yakin ingin hapus data ini?',
              text: "Data yang terhapus tidak dapat dikembalikan",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Hapus',
              cancelButtonText: 'Kembali'

          }).then((result) => {
              if (result.isConfirmed) {
                  $('.form-delete').attr('action', url).submit();
              } 
          })
      }
  </script>

  @include('mypartials.js')
  @yield('tambahjs')
</body>

</html>