@extends('mylayouts.main')

@section('tambahcss')
    <style>
        @media screen and (max-width: 400px){
            .select{
                width: 100%;
            }

            .simpan{
                display: flex;
                justify-content: center;
                align-items: center;
                border-top: 1.5px solid rgb(213, 213, 213);
                padding: 10px;
            }
        }

        .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
            background-color: #3bae9c;
        }
    </style>
@endsection

@section('container')
    <div class="card">
        <div class="card-body">
            <div class="title d-flex justify-content-between">
                <h4 class="card-title">Jam Pelajaran</h4>
            </div>
            <div class="card text-center">
                <div class="card-header">
                  <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                      <a class="nav-link jamPelt active" style="cursor: pointer; font-size: 15px; color: white;">Jam Pelajaran</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link jamIstt" style="cursor: pointer; font-size: 15px; color: #3bae9c;">Jam Istirahat</a>
                    </li>
                  </ul>
                </div>
                <div class="card-body text-left jamPel">
                    <div class="d-flex justify-content-end">
                        {{-- <form action="" method="get"> --}}
                            {{-- @include('mypartials.tahunajaran') --}}
                            <button class="btn btn-sm text-white font-weight-bold btn-warning editJamPel" style="min-width: 5vw; margin: 2px;">Edit</button>
                        {{-- </form> --}}
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Jam Ke</th>
                                    <th>Jam Awal</th>
                                    <th>Jam Akhir</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td>1</td>
                                    <td>1</td>
                                    <td>
                                        <input type="time" class="jamAwal1" name="jamAwal1" id="jamAwal1" style="border: none;" disabled>
                                    </td>
                                    <td>
                                        <input type="time" class="jamAkhir1" name="jamAkhir1" id="jamAkhir1" style="border: none;" disabled>
                                    </td>
                                    <td>
                                        <form action="" method="get">
                                            @include('mypartials.tahunajaran')
                                            <button class="btn btn-sm text-white font-weight-bold btn-danger" style="min-width: 5vw; margin: 2px;">Reset</button>
                                        </form>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>2</td>
                                    <td>2</td>
                                    <td>
                                        <input type="time" class="jamAwal2" name="jamAwal2" id="jamAwal2" style="border: none;" disabled>
                                    </td>
                                    <td>
                                        <input type="time" class="jamAkhir2" name="jamAkhir2" id="jamAkhir2" style="border: none;" disabled>
                                    </td>
                                    <td>
                                        <form action="" method="get">
                                            @include('mypartials.tahunajaran')
                                            <button class="btn btn-sm text-white font-weight-bold btn-danger" style="min-width: 5vw; margin: 2px;">Reset</button>
                                        </form>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>3</td>
                                    <td>3</td>
                                    <td>
                                        <input type="time" class="jamAwal3" name="jamAwal3" id="jamAwal3" style="border: none;" disabled>
                                    </td>
                                    <td>
                                        <input type="time" class="jamAkhir3" name="jamAkhir3" id="jamAkhir3" style="border: none;" disabled>
                                    </td>
                                    <td>
                                        <form action="" method="get">
                                            @include('mypartials.tahunajaran')
                                            <button class="btn btn-sm text-white font-weight-bold btn-danger" style="min-width: 5vw; margin: 2px;">Reset</button>
                                        </form>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>4</td>
                                    <td>4</td>
                                    <td>
                                        <input type="time" class="jamAwal4" name="jamAwal4" id="jamAwal4" style="border: none;" disabled>
                                    </td>
                                    <td>
                                        <input type="time" class="jamAkhir4" name="jamAkhir4" id="jamAkhir4" style="border: none;" disabled>
                                    </td>
                                    <td>
                                        <form action="" method="get">
                                            @include('mypartials.tahunajaran')
                                            <button class="btn btn-sm text-white font-weight-bold btn-danger" style="min-width: 5vw; margin: 2px;">Reset</button>
                                        </form>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>5</td>
                                    <td>5</td>
                                    <td>
                                        <input type="time" class="jamAwal5" name="jamAwal5" id="jamAwal5" style="border: none;" disabled>
                                    </td>
                                    <td>
                                        <input type="time" class="jamAkhir5" name="jamAkhir5" id="jamAkhir5" style="border: none;" disabled>
                                    </td>
                                    <td>
                                        <form action="" method="get">
                                            @include('mypartials.tahunajaran')
                                            <button class="btn btn-sm text-white font-weight-bold btn-danger" style="min-width: 5vw; margin: 2px;">Reset</button>
                                        </form>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>6</td>
                                    <td>6</td>
                                    <td>
                                        <input type="time" class="jamAwal6" name="jamAwal6" id="jamAwal6" style="border: none;" disabled>
                                    </td>
                                    <td>
                                        <input type="time" class="jamAkhir6" name="jamAkhir6" id="jamAkhir6" style="border: none;" disabled>
                                    </td>
                                    <td>
                                        <form action="" method="get">
                                            @include('mypartials.tahunajaran')
                                            <button class="btn btn-sm text-white font-weight-bold btn-danger" style="min-width: 5vw; margin: 2px;">Reset</button>
                                        </form>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>7</td>
                                    <td>7</td>
                                    <td>
                                        <input type="time" class="jamAwal7" name="jamAwal7" id="jamAwal7" style="border: none;" disabled>
                                    </td>
                                    <td>
                                        <input type="time" class="jamAkhir7" name="jamAkhir7" id="jamAkhir7" style="border: none;" disabled>
                                    </td>
                                    <td>
                                        <form action="" method="get">
                                            @include('mypartials.tahunajaran')
                                            <button class="btn btn-sm text-white font-weight-bold btn-danger" style="min-width: 5vw; margin: 2px;">Reset</button>
                                        </form>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>8</td>
                                    <td>8</td>
                                    <td>
                                        <input type="time" class="jamAwal8" name="jamAwal8" id="jamAwal8" style="border: none;" disabled>
                                    </td>
                                    <td>
                                        <input type="time" class="jamAkhir8" name="jamAkhir8" id="jamAkhir8" style="border: none;" disabled>
                                    </td>
                                    <td>
                                        <form action="" method="get">
                                            @include('mypartials.tahunajaran')
                                            <button class="btn btn-sm text-white font-weight-bold btn-danger" style="min-width: 5vw; margin: 2px;">Reset</button>
                                        </form>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>9</td>
                                    <td>9</td>
                                    <td>
                                        <input type="time" class="jamAwal9" name="jamAwal9" id="jamAwal9" style="border: none;" disabled>
                                    </td>
                                    <td>
                                        <input type="time" class="jamAkhir9" name="jamAkhir9" id="jamAkhir9" style="border: none;" disabled>
                                    </td>
                                    <td>
                                        <form action="" method="get">
                                            @include('mypartials.tahunajaran')
                                            <button class="btn btn-sm text-white font-weight-bold btn-danger" style="min-width: 5vw; margin: 2px;">Reset</button>
                                        </form>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>10</td>
                                    <td>10</td>
                                    <td>
                                        <input type="time" class="jamAwal10" name="jamAwal10" id="jamAwal10" style="border: none;" disabled>
                                    </td>
                                    <td>
                                        <input type="time" class="jamAkhir10" name="jamAkhir10" id="jamAkhir10" style="border: none;" disabled>
                                    </td>
                                    <td>
                                        <form action="" method="get">
                                            @include('mypartials.tahunajaran')
                                            <button class="btn btn-sm text-white font-weight-bold btn-danger" style="min-width: 5vw; margin: 2px;">Reset</button>
                                        </form>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>11</td>
                                    <td>11</td>
                                    <td>
                                        <input type="time" class="jamAwal11" name="jamAwal11" id="jamAwal11" style="border: none;" disabled>
                                    </td>
                                    <td>
                                        <input type="time" class="jamAkhir11" name="jamAkhir11" id="jamAkhir11" style="border: none;" disabled>
                                    </td>
                                    <td>
                                        <form action="" method="get">
                                            @include('mypartials.tahunajaran')
                                            <button class="btn btn-sm text-white font-weight-bold btn-danger" style="min-width: 5vw; margin: 2px;">Reset</button>
                                        </form>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>12</td>
                                    <td>12</td>
                                    <td>
                                        <input type="time" class="jamAwal12" name="jamAwal12" id="jamAwal12" style="border: none;" disabled>
                                    </td>
                                    <td>
                                        <input type="time" class="jamAkhir12" name="jamAkhir12" id="jamAkhir12" style="border: none;" disabled>
                                    </td>
                                    <td>
                                        <form action="" method="get">
                                            @include('mypartials.tahunajaran')
                                            <button class="btn btn-sm text-white font-weight-bold btn-danger" style="min-width: 5vw; margin: 2px;">Reset</button>
                                        </form>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>13</td>
                                    <td>13</td>
                                    <td>
                                        <input type="time" class="jamAwal13" name="jamAwal13" id="jamAwal13" style="border: none;" disabled>
                                    </td>
                                    <td>
                                        <input type="time" class="jamAkhir13" name="jamAkhir13" id="jamAkhir13" style="border: none;" disabled>
                                    </td>
                                    <td>
                                        <form action="" method="get">
                                            @include('mypartials.tahunajaran')
                                            <button class="btn btn-sm text-white font-weight-bold btn-danger" style="min-width: 5vw; margin: 2px;">Reset</button>
                                        </form>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>14</td>
                                    <td>14</td>
                                    <td>
                                        <input type="time" class="jamAwal14" name="jamAwal14" id="jamAwal14" style="border: none;" disabled>
                                    </td>
                                    <td>
                                        <input type="time" class="jamAkhir14" name="jamAkhir14" id="jamAkhir14" style="border: none;" disabled>
                                    </td>
                                    <td>
                                        <form action="" method="get">
                                            @include('mypartials.tahunajaran')
                                            <button class="btn btn-sm text-white font-weight-bold btn-danger" style="min-width: 5vw; margin: 2px;">Reset</button>
                                        </form>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>15</td>
                                    <td>15</td>
                                    <td>
                                        <input type="time" class="jamAwal15" name="jamAwal15" id="jamAwal15" style="border: none;" disabled>
                                    </td>
                                    <td>
                                        <input type="time" class="jamAkhir15" name="jamAkhir15" id="jamAkhir15" style="border: none;" disabled>
                                    </td>
                                    <td>
                                        <form action="" method="get">
                                            @include('mypartials.tahunajaran')
                                            <button class="btn btn-sm text-white font-weight-bold btn-danger" style="min-width: 5vw; margin: 2px;">Reset</button>
                                        </form>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <td>16</td>
                                    <td>16</td>
                                    <td>
                                        <input type="time" class="jamAwal16" name="jamAwal16" id="jamAwal16" style="border: none;" disabled>
                                    </td>
                                    <td>
                                        <input type="time" class="jamAkhir16" name="jamAkhir16" id="jamAkhir16" style="border: none;" disabled>
                                    </td>
                                    <td>
                                        <form action="" method="get">
                                            @include('mypartials.tahunajaran')
                                            <button class="btn btn-sm text-white font-weight-bold btn-danger" style="min-width: 5vw; margin: 2px;">Reset</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn text-white simpanJamPel" style="background-color: #3bae9c">Simpan</button>
                    </div>
                </div>
                <div class="card-body jamIst" style="display: none;">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-sm text-white font-weight-bold floar-right" data-bs-toggle="modal" data-bs-target="#modalJamIst" style="background-color: #3bae9c">Create</button>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Jam Ke</th>
                                    <th>Jam Awal</th>
                                    <th>Jam Akhir</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td>1</td>
                                    <td>1</td>
                                    <td>09.00</td>
                                    <td>09.45</td>
                                    <td>
                                        <form action="" method="get">
                                            @include('mypartials.tahunajaran')
                                            <button class="btn btn-sm text-white font-weight-bold btn-warning" style="min-width: 5vw; margin: 2px;">Edit</button>
                                        </form>
                                        <form action="" method="get">
                                            @include('mypartials.tahunajaran')
                                            <button class="btn btn-sm text-white font-weight-bold btn-danger" style="min-width: 5vw; margin: 2px;">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- modal jam istirahat --}}
                <div class="modal fade" id="modalJamIst" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Jam Istirahat</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-left">
                            <div class="bawah mb-3">
                                <label for="labelJam" class="form-label">Jam Ke</label>
                                <select class="form-control" name="" id="">
                                    <option value="">1</option>
                                    <option value="">2</option>
                                    <option value="">3</option>
                                </select>
                            </div>
                            <div class="bawah mb-3">
                                <div class="jam d-flex justify-content-between align-items-center gap-3">
                                    <input type="time" class="form-control" name="jamAwal" id="jamAwal">
                                    <span>s.d.</span>
                                    <input type="time" class="form-control" name="jamAkhir" id="jamAkhir">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                          <button type="button" class="btn text-white" style="background-color: #3bae9c">Simpan</button>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
@endsection

@section('tambahjs')
    <script>
        const jamPelt = document.querySelector('.jamPelt');
        const jamIstt = document.querySelector('.jamIstt');
        const jamPel = document.querySelector('.jamPel');
        const jamIst = document.querySelector('.jamIst');

        jamPelt.addEventListener('click', () => {
            jamIstt.style.background = 'none';
            jamIstt.style.color  = '#3bae9c';
            jamPelt.style.background = '#3bae9c';
            jamPelt.style.color = 'white';
            jamPel.style.display = 'block';
            jamIst.style.display = 'none';
        })

        jamIstt.addEventListener('click', () => {
            jamIstt.style.background = '#3bae9c';
            jamIstt.style.color  = 'white';
            jamPelt.style.background = 'none';
            jamPelt.style.color = '#3bae9c';
            jamIst.style.display = 'block';
            jamPel.style.display = 'none';
        })
    </script>

    <script>
        const editJamPel = document.querySelector('.editJamPel');
        const jamAwal1 = document.querySelector('.jamAwal1');
        const jamAwal2 = document.querySelector('.jamAwal2');
        const jamAwal3 = document.querySelector('.jamAwal3');
        const jamAwal4 = document.querySelector('.jamAwal4');
        const jamAwal5 = document.querySelector('.jamAwal5');
        const jamAwal6 = document.querySelector('.jamAwal6');
        const jamAwal7 = document.querySelector('.jamAwal7');
        const jamAwal8 = document.querySelector('.jamAwal8');
        const jamAwal9 = document.querySelector('.jamAwal9');
        const jamAwal10 = document.querySelector('.jamAwal10');
        const jamAwal11 = document.querySelector('.jamAwal11');
        const jamAwal12 = document.querySelector('.jamAwal12');
        const jamAwal13 = document.querySelector('.jamAwal13');
        const jamAwal14 = document.querySelector('.jamAwal14');
        const jamAwal15 = document.querySelector('.jamAwal15');
        const jamAwal16 = document.querySelector('.jamAwal16');

        const jamAkhir1 = document.querySelector('.jamAkhir1');
        const jamAkhir2 = document.querySelector('.jamAkhir2');
        const jamAkhir3 = document.querySelector('.jamAkhir3');
        const jamAkhir4 = document.querySelector('.jamAkhir4');
        const jamAkhir5 = document.querySelector('.jamAkhir5');
        const jamAkhir6 = document.querySelector('.jamAkhir6');
        const jamAkhir7 = document.querySelector('.jamAkhir7');
        const jamAkhir8 = document.querySelector('.jamAkhir8');
        const jamAkhir9 = document.querySelector('.jamAkhir9');
        const jamAkhir10 = document.querySelector('.jamAkhir10');
        const jamAkhir11 = document.querySelector('.jamAkhir11');
        const jamAkhir12 = document.querySelector('.jamAkhir12');
        const jamAkhir13 = document.querySelector('.jamAkhir13');
        const jamAkhir14 = document.querySelector('.jamAkhir14');
        const jamAkhir15 = document.querySelector('.jamAkhir15');
        const jamAkhir16 = document.querySelector('.jamAkhir16');

        editJamPel.addEventListener('click', () => {
            jamAwal1.style.border = '1px solid black';
            jamAwal2.style.border = '1px solid black';
            jamAwal3.style.border = '1px solid black';
            jamAwal4.style.border = '1px solid black';
            jamAwal5.style.border = '1px solid black';
            jamAwal6.style.border = '1px solid black';
            jamAwal7.style.border = '1px solid black';
            jamAwal8.style.border = '1px solid black';
            jamAwal9.style.border = '1px solid black';
            jamAwal10.style.border = '1px solid black';
            jamAwal11.style.border = '1px solid black';
            jamAwal12.style.border = '1px solid black';
            jamAwal13.style.border = '1px solid black';
            jamAwal14.style.border = '1px solid black';
            jamAwal15.style.border = '1px solid black';
            jamAwal16.style.border = '1px solid black';

            jamAwal1.style.borderRadius = '3px';
            jamAwal2.style.borderRadius = '3px';
            jamAwal3.style.borderRadius = '3px';
            jamAwal4.style.borderRadius = '3px';
            jamAwal5.style.borderRadius = '3px';
            jamAwal6.style.borderRadius = '3px';
            jamAwal7.style.borderRadius = '3px';
            jamAwal8.style.borderRadius = '3px';
            jamAwal9.style.borderRadius = '3px';
            jamAwal10.style.borderRadius = '3px';
            jamAwal11.style.borderRadius = '3px';
            jamAwal12.style.borderRadius = '3px';
            jamAwal13.style.borderRadius = '3px';
            jamAwal14.style.borderRadius = '3px';
            jamAwal15.style.borderRadius = '3px';
            jamAwal16.style.borderRadius = '3px';

            jamAkhir1.style.border = '1px solid black';
            jamAkhir2.style.border = '1px solid black';
            jamAkhir3.style.border = '1px solid black';
            jamAkhir4.style.border = '1px solid black';
            jamAkhir5.style.border = '1px solid black';
            jamAkhir6.style.border = '1px solid black';
            jamAkhir7.style.border = '1px solid black';
            jamAkhir8.style.border = '1px solid black';
            jamAkhir9.style.border = '1px solid black';
            jamAkhir10.style.border = '1px solid black';
            jamAkhir11.style.border = '1px solid black';
            jamAkhir12.style.border = '1px solid black';
            jamAkhir13.style.border = '1px solid black';
            jamAkhir14.style.border = '1px solid black';
            jamAkhir15.style.border = '1px solid black';
            jamAkhir16.style.border = '1px solid black';

            jamAkhir1.style.borderRadius = '3px';
            jamAkhir2.style.borderRadius = '3px';
            jamAkhir3.style.borderRadius = '3px';
            jamAkhir4.style.borderRadius = '3px';
            jamAkhir5.style.borderRadius = '3px';
            jamAkhir6.style.borderRadius = '3px';
            jamAkhir7.style.borderRadius = '3px';
            jamAkhir8.style.borderRadius = '3px';
            jamAkhir9.style.borderRadius = '3px';
            jamAkhir10.style.borderRadius = '3px';
            jamAkhir11.style.borderRadius = '3px';
            jamAkhir12.style.borderRadius = '3px';
            jamAkhir13.style.borderRadius = '3px';
            jamAkhir14.style.borderRadius = '3px';
            jamAkhir15.style.borderRadius = '3px';
            jamAkhir16.style.borderRadius = '3px';

            jamAwal1.removeAttribute('disabled');
            jamAwal2.removeAttribute('disabled');
            jamAwal3.removeAttribute('disabled');
            jamAwal4.removeAttribute('disabled');
            jamAwal5.removeAttribute('disabled');
            jamAwal6.removeAttribute('disabled');
            jamAwal7.removeAttribute('disabled');
            jamAwal8.removeAttribute('disabled');
            jamAwal9.removeAttribute('disabled');
            jamAwal10.removeAttribute('disabled');
            jamAwal11.removeAttribute('disabled');
            jamAwal12.removeAttribute('disabled');
            jamAwal13.removeAttribute('disabled');
            jamAwal14.removeAttribute('disabled');
            jamAwal15.removeAttribute('disabled');
            jamAwal16.removeAttribute('disabled');
            
            jamAkhir1.removeAttribute('disabled');
            jamAkhir2.removeAttribute('disabled');
            jamAkhir3.removeAttribute('disabled');
            jamAkhir4.removeAttribute('disabled');
            jamAkhir5.removeAttribute('disabled');
            jamAkhir6.removeAttribute('disabled');
            jamAkhir7.removeAttribute('disabled');
            jamAkhir8.removeAttribute('disabled');
            jamAkhir9.removeAttribute('disabled');
            jamAkhir10.removeAttribute('disabled');
            jamAkhir11.removeAttribute('disabled');
            jamAkhir12.removeAttribute('disabled');
            jamAkhir13.removeAttribute('disabled');
            jamAkhir14.removeAttribute('disabled');
            jamAkhir15.removeAttribute('disabled');
            jamAkhir16.removeAttribute('disabled');
        })
    </script>
@endsection