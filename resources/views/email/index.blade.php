<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
      th{
        font-weight: 600;
      }
    </style>

    <title>Email</title>
  </head>
  <body>
    <div class="container-fluid d-flex justify-content-center align-items-center" style="height: 100vh; background-color: #f2f2f2">
      <div class="card col-lg-8 m-auto">
        <div class="card-body">
          <div class="1">
            <div class="table-responsive table-borderless">
              <table>
                <tr>
                  <th class="col-4">Nama Sekolah</th>
                  <td class="col-1">:</td>
                  <td class="col-7">{{ $sekolah->nama }}</td>
                </tr>
                <tr>
                  <th class="col-4">NPSN</th>
                  <td class="col-1">:</td>
                  <td class="col-7">{{ $sekolah->npsn }}</td>
                </tr>
              </table>
           </div>
         </div>
          <hr>
          <div class="2 mb-4">
            <div class="title"><h5>User admin sekolah</h5></div>
            <div class="table-responsive table-borderless">
              <table>
                <tr>
                  <th class="col-4">Nama Sekolah</th>
                  <td class="col-1">:</td>
                  <td class="col-7">{{ $sekolah->nama }}</td>
                </tr>
                <tr>
                  <th class="col-4">Email</th>
                  <td class="col-1">:</td>
                  <td class="col-7">{{ $user->email }}</td>
                </tr>
                <tr>
                  <th class="col-4">Password</th>
                  <td class="col-1">:</td>
                  <td class="col-7">{{ $password }}</td>
                </tr>
              </table>
           </div>
          </div>
          @if ($yayasan)    
          <div class="3 mb-4">
            <div class="title"><h5>User yayasan</h5></div>
            <div class="table-responsive table-borderless">
              <table>
                <tr>
                  <th class="col-4">Nama Sekolah</th>
                  <td class="col-1">:</td>
                  <td class="col-7">{{ $sekolah->nama }}</td>
                </tr>
                <tr>
                  <th class="col-4">Email</th>
                  <td class="col-1">:</td>
                  <td class="col-7">{{ $yayasan->email }}</td>
                </tr>
                <tr>
                  <th class="col-4">Password</th>
                  <td class="col-1">:</td>
                  <td class="col-7">{{ $password_yayasan }}</td>
                </tr>
              </table>
           </div>
          </div>
          @endif
          <span class=""><i><a href="/">Clink here to login!</a></i></span>
        </div>
      </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>

{{-- nama sekolah
npsn sekolah
data admin & yayasan : nama, email, password --}}