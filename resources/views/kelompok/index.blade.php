@extends('mylayouts.main')

@section('container')
    <div class="card">
        <div class="card-body">
            <div class="title d-flex justify-content-between">
                <h4 class="card-title">Kelompok</h4>
                <form action="/createKelompok" method="get">
                    @include('mypartials.tahunajaran')
                    <button class="btn btn-sm text-white font-weight-bold" style="background-color: #3bae9c; min-width: 5vw;">Create</button>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Kelompok</th>
                            <th>Nama Guru</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td>1</td>
                            <td>Kelompok 1</td>
                            <td>Puguh Rismadi</td>
                            <td>
                                <form action="/editKelompok" method="get">
                                    @include('mypartials.tahunajaran')
                                    <button class="btn btn-sm btn-warning text-white font-weight-bold" style="min-width: 5vw; margin: 2px;">Edit</button>
                                </form>
                                <form action="/hapusKelompok" method="get">
                                    @include('mypartials.tahunajaran')
                                    <button class="btn btn-sm btn-danger text-white font-weight-bold" style="min-width: 5vw; margin: 2px;">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection