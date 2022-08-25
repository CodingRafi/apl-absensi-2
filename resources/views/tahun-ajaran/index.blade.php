@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Tahun Ajaran</h4>
        <a href="/tahun-ajaran/create" class="btn btn-success position-absolute" style="top: .7rem; right: 1rem;">Tambah
            Tahun Ajaran</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tahun Awal</th>
                    <th scope="col">Tahun Akhir</th>
                    <th scope="col">Semester</th>
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
                    <td>
                        <a href="/tahun_ajaran/{{ $tahun_ajaran->id }}/edit" class="btn btn-warning text-white">Edit</a>
                        <form action="/tahun_ajaran/{{ $tahun_ajaran->id }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection