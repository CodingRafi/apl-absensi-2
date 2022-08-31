@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title float-left">Agenda Guru</h4>
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-light">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Mapel</th>
                        <th>Hari/ Tanggal</th>
                        <th>Jam</th>
                        <th>Kelas</th>
                        <th>Materi</th>
                        <th>Dokumentasi</th>
                        <th>Absensi</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <td>1</td>
                        <td>Puguh Rismadi</td>
                        <td>PBO</td>
                        <td>Senin, 30-08-2022</td>
                        <td>07.00 - 12.50</td>
                        <td>XII RPL 2</td>
                        <td>Vue JS</td>
                        <td><i class="bi bi-filetype-pdf" style="color: red"></i></td>
                        <td>Hadir</td>
                        <td></td>
                        <td>
                            <a href="" class="btn btn-sm btn-warning text-white font-weight-bold">Edit</a>
                            <a href="" class="btn btn-sm btn-danger text-white font-weight-bold">Delete</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection