@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Kelas</h4>
        <a href="/kelas/create" class="btn btn-success position-absolute" style="top: .7rem; right: 1rem;">Tambah
            Kelas</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Kelas</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classes as $kelas)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $kelas->nama }}</td>
                    <td>
                        <a href="/kelas/{{ $kelas->id }}/edit" class="btn btn-warning text-white">Edit</a>
                        <form action="/kelas/{{ $kelas->id }}" method="post">
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