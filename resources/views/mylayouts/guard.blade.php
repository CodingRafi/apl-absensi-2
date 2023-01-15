<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Login</title>
  <!-- plugins:css -->
  <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/png" />
  <link rel="stylesheet" href="/template/vendors/feather/feather.css">
  <link rel="stylesheet" href="/template/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="/template/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="/template/css/vertical-layout-light/style.css">
  <link rel="stylesheet" href="{{ asset('css/fstdropdown.css') }}">
  <!-- endinject -->
  {{-- bootstrap --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  @stack('css')
</head>
<body>

    @yield('content')

  <!-- plugins:js -->
  <script src="/template/vendors/js/vendor.bundle.base.js"></script>
  <script src="/template/js/off-canvas.js"></script>
  <script src="/template/js/hoverable-collapse.js"></script>
  <script src="/template/js/template.js"></script>
  <script src="/template/js/settings.js"></script>
  <script src="/template/js/todolist.js"></script>
  <script src="{{ asset('js/fstdropdown.js') }}"></script>
  <script>
    setFstDropdown();
  </script>
  @include('mypartials.js')
  @stack('js')
</body>
</html>