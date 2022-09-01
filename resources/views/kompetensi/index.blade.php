@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Kompetensi</h4>
        @if (auth()->user()->can('add_kompetensi'))
        <form action="/kompetensi/create" method="get">
            @include('mypartials.tahunajaran')
            <button class="btn btn-sm text-white font-weight-bold position-absolute px-3" style="top: .7rem; right: 1rem; background-color: #3bae9c">Tambah Kompetensi</button>
        </form>
        @endif
        <table class="table">
            <thead>
                <tr class="text-center">
                    <th scope="col">No</th>
                    <th scope="col">Kompetensi Keahlian</th>
                    <th scope="col">Program Keahlian</th>
                    <th scope="col">Bidang Keahlian</th>
                    @if (auth()->user()->can('edit_kompetensi') || auth()->user()->can('delete_kompetensi'))
                    <th scope="col">Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($kompetensis as $kompetensi)
                <tr class="text-center">
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $kompetensi->kompetensi }}</td>
                    <td>{{ $kompetensi->program }}</td>
                    <td>{{ $kompetensi->bidang }}</td>
                    @if (auth()->user()->can('edit_kompetensi') || auth()->user()->can('delete_kompetensi')) 
                    <td>
                        @if (auth()->user()->can('edit_kompetensi'))
                        <form action="/kompetensi/{{ $kompetensi->id }}/edit" method="get">
                            @include('mypartials.tahunajaran')
                            <button type="submit" class="btn btn-sm btn-warning text-white font-weight-bold" style="width: 5rem; margin: 0.1rem">Edit</button>
                        </form>
                        @endif
                        @if (auth()->user()->can('delete_kompetensi'))
                        <form action="/kompetensi/{{ $kompetensi->id }}" method="post">
                            @csrf
                            @method('delete')
                            @include('mypartials.tahunajaran')
                            <button type="submit" class="btn btn-sm btn-danger font-weight-bold"
                                onclick="return confirm('apakah anda yakin akan menghapus jurusan ini? maka semua siswa pada jurusan ini akan terhapus')" style="width: 5rem; margin: 0.1rem">Hapus</button>
                        </form>
                        @endif
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection