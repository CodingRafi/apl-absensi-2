@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <div class="title d-flex justify-content-between">
            <h4 class="card-title">Tahun Ajaran</h4>
            <a href="/tahun-ajaran/create" class="btn btn-sm text-white float-right" style="height: fit-content;background-color: #3bae9c;border-radius: 5px;font-weight: 500;">Tambah
                Tahun Ajaran</a>
        </div>
        <div class="table table-responsive table-hover text-center">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tahun Awal</th>
                        <th scope="col">Tahun Akhir</th>
                        <th scope="col">Semester</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tahun_ajarans as $tahun_ajaran)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $tahun_ajaran->tahun_awal }}</td>
                        <td>{{ $tahun_ajaran->tahun_akhir }}</td>
                        <td>{{ $tahun_ajaran->semester }}</td>
                        <td>{{ $tahun_ajaran->status }}</td>
                        <td>
                            <a href="/tahun-ajaran/{{ $tahun_ajaran->id }}/edit" class="btn btn-sm btn-warning text-white px-3" style="border-radius: 5px;font-weight: 500;">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection