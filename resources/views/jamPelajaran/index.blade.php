@extends('mylayouts.main')

@section('container')
    <div class="card">
        <div class="card-body">
            <div class="title d-flex justify-content-between">
                <h4 class="card-title">Jam Pelajaran</h4>
                <form action="/createJamPelajaran" method="get">
                    @include('mypartials.tahunajaran')
                    <button class="btn btn-sm text-white font-weight-bold" style="background-color: #3bae9c; min-width: 5vh;">Create</button>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Jam Ke</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td>1</td>
                            <td>1</td>
                            <td>07.00 s/d 08.00</td>
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
    </div>
@endsection