@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Kompetensi</h4>
        <form action="/kompetensi/create" method="get">
            @include('mypartials.tahunajaran')
            <button class="btn btn-sm text-white font-weight-bold position-absolute px-3" style="top: .7rem; right: 1rem; background-color: #3bae9c">Tambah Kompetensi</button>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kompetensi Keahlian</th>
                    <th scope="col">Program Keahlian</th>
                    <th scope="col">Bidang Keahlian</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kompetensis as $kompetensi)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $kompetensi->kompetensi }}</td>
                    <td>{{ $kompetensi->program }}</td>
                    <td>{{ $kompetensi->bidang }}</td>
                    <td>
                        <form action="/kompetensi/{{ $kompetensi->id }}/edit" method="get">
                            @include('mypartials.tahunajaran')
                            <button type="submit" class="btn btn-sm btn-warning text-white font-weight-bold" style="width: 5rem; margin: 0.1rem">Edit</button>
                        </form>
                        <form action="/kompetensi/{{ $kompetensi->id }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger font-weight-bold"
                                onclick="return confirm('Yakin?')" style="width: 5rem; margin: 0.1rem">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection