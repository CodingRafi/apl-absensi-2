@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Tahun Ajaran</h4>
        <a href="/tahun-ajaran/create" class="btn btn-sm text-white position-absolute px-3" style="top: .7rem; right: 1rem; background-color: #3bae9c;border-radius: 5px;font-weight: 500;">Tambah
            Tahun Ajaran</a>
        <table class="table">
            <thead>
                <tr class="text-center">
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
                <tr class="text-center">
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $tahun_ajaran->tahun_awal }}</td>
                    <td>{{ $tahun_ajaran->tahun_akhir }}</td>
                    <td>{{ $tahun_ajaran->semester }}</td>
                    <td>{{ $tahun_ajaran->status }}</td>
                    <td>
<<<<<<< HEAD
                        <a href="/tahun-ajaran/{{ $tahun_ajaran->id }}/edit" class="btn btn-sm btn-warning text-white px-3" style="border-radius: 5px;font-weight: 500;">Edit</a>
=======
                        <a href="{{ route('tahun-ajaran.edit', $tahun_ajaran->id) }}" class="btn btn-sm btn-warning text-white font-weight-bold px-3">Edit</a>
>>>>>>> ebec64c571e87310fe1e80a6696837d383c9468f
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection