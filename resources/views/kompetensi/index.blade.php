@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Kompetensi</h4>
        <form action="/kompetensi/create" method="get">
            @if (request('tahun_awal'))
            <input type="hidden" name="tahun_awal" value="{{ request('tahun_awal') }}">
            @endif
            @if (request('tahun_akhir'))
            <input type="hidden" name="tahun_akhir" value="{{ request('tahun_akhir') }}">
            @endif
            @if (request('semester'))
            <input type="hidden" name="semester" value="{{ request('semester') }}">
            @endif
            <button class="btn btn-sm text-white font-weight-bold position-absolute" style="top: .7rem; right: 1rem; background-color: #3bae9c">Tambah Kompetensi</button>
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
                        <a href="/kompetensi/{{ $kompetensi->id }}/edit" class="btn btn-warning text-white">Edit</a>
                        <form action="/kompetensi/{{ $kompetensi->id }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Yakin?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection