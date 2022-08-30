@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Kelas</h4>
        <form action="/kelas/create" method="get">
            @include('mypartials.tahunajaran')
            <button type="submit" class="btn btn-sm text-white font-weight-bold position-absolute px-3" style="top: .7rem; right: 1rem; background-color: #3bae9c;">Tambah Kelas</button>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
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
                        <form action="/kelas/{{ $kelas->id }}/edit" method="get">
                            @include('mypartials.tahunajaran')
                            <button type="submit" class="btn btn-sm btn-warning text-white font-weight-bold" style="width: 5rem; margin: 0.1rem">Edit</button>
                        </form>
                        <form action="/kelas/{{ $kelas->id }}" method="post">
                            @csrf
                            @method('delete')
                            @include('mypartials.tahunajaran')
                            <button type="submit" class="btn btn-sm btn-danger font-weight-bold" onclick="return confirm('Ini akan menghapus semua siswa, dan agenda untuk kelas ini?')" style="width: 5rem; margin: 0.1rem">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection