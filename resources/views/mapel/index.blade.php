@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Mata Pelajaran</h4>
        <form action="/mapel/create" method="get">
            @include('mypartials.tahunajaran')
            <button class="btn btn-sm text-white font-weight-bold position-absolute px-3" style="top: .7rem; right: 1rem; background-color: #3bae9c">Tambah</button>
        </form>
        <table class="table">
            <thead>
                <tr class="text-center">
                    <th scope="col">No</th>
                    <th scope="col">Nama Mapel</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mapels as $mapel)
                <tr class="text-center">
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $mapel->nama }}</td>
                    <td>
                        <form action="/mapel/{{ $mapel->id }}/edit" method="get">
                            @include('mypartials.tahunajaran')
                            <button type="submit" class="btn btn-sm btn-warning text-white" style="width: 5rem; margin: 0.1rem">Edit</button>
                        </form>
                        <form action="/mapel/{{ $mapel->id }}" method="post">
                            @csrf
                            @method('delete')
                            @include('mypartials.tahunajaran')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('semua agenda dan guru yang menggunakan mapel ini akan berubah')" style="width: 5rem; margin: 0.1rem">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection