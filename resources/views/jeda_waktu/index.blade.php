@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Tenggat Waktu</h4>
        <form action="/tenggat/create" method="get">
            @include('mypartials.tahunajaran')
            <button type="submit" class="btn btn-sm text-white font-weight-bold position-absolute px-3" style="top: .7rem; right: 1rem; background-color: #3bae9c;">Tambah Tenggat Waktu</button>
        </form>
        <table class="table">
            <thead>
                <tr class="text-center">
                    <th scope="col">No</th>
                    <th scope="col">Nama Kelas</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($classes as $kelas)
                <tr class="text-center">
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $kelas->nama }}</td>
                    @if (auth()->user()->can('edit_kelas') || auth()->user()->can('delete_kelas'))      
                    <td>
                        @if (auth()->user()->can('edit_kelas'))
                        <form action="/kelas/{{ $kelas->id }}/edit" method="get">
                            @include('mypartials.tahunajaran')
                            <button type="submit" class="btn btn-sm btn-warning text-white font-weight-bold" style="width: 5rem; margin: 0.1rem">Edit</button>
                        </form>
                        @endif
                        @if (auth()->user()->can('delete_kelas'))
                        <form action="/kelas/{{ $kelas->id }}" method="post">
                            @csrf
                            @method('delete')
                            @include('mypartials.tahunajaran')
                            <button type="submit" class="btn btn-sm btn-danger font-weight-bold" onclick="return confirm('Ini akan menghapus semua siswa, dan agenda untuk kelas ini?')" style="width: 5rem; margin: 0.1rem">Hapus</button>
                        </form>
                        @endif
                    </td>
                    @endif
                </tr>
                @endforeach --}}
            </tbody>
        </table>
    </div>
</div>
@endsection