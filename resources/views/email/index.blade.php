<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

  <style>
    *{
      font-family: 'Poppins', sans-serif;
      font-size: 12px;
    }
  </style>

  <title>Email</title>
</head>

<body>
  <div class="container">
      <span>Terima kasih telah mendaftar di {{ config('services.brand') }}</span>
      <br>
      <br>

      <span>Berikut adalah akun akun yang terdaftar</span>
      <br>
      <br>

      <span><strong>1. Admin Sekolah</strong></span>
      <br>
      <span>Email : {{ $user->email }}</span>
      <br>
      <span>Password: {{ $password }}</span>
      <br>

      @if ($yayasan)
      <br>
      <span><strong>2. Yayasan Sekolah</strong></span>
      <br>
      <span>Email : {{ $yayasan->email }}</span>
      <br>
      <span>Password: {{ $password_yayasan }}</span>
      <br>
      @endif
  </div>
</body>

</html>

{{-- nama sekolah
npsn sekolah
data admin & yayasan : nama, email, password --}}