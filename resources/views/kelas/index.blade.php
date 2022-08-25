@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Kelas</h4>
        <a href="/Kelas/create" class="btn btn-success position-absolute" style="top: .7rem; right: 1rem;">Tambah
            Kelas</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Kompetensi Keahlian</th>
                    <th scope="col">Program Keahlian</th>
                    <th scope="col">Bidang Keahlian</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($kompetensis as $kompetensi)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $kompetensi->kompetensi }}</td>
                    <td>{{ $kompetensi->program }}</td>
                    <td>{{ $kompetensi->bidang }}</td>
                    <td>
                        <a href="/kompetensi/{{ $kompetensi->id }}/edit" class="btn btn-warning text-white">Edit</a>
                        <form action="/kompetensi/{{ $kompetensi->id }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach --}}
            </tbody>
        </table>
    </div>
</div>
@endsection