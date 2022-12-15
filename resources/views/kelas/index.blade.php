@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Kelas</h4>
        @if (auth()->user()->can('add_kelas'))
            @if (count($tahun_ajarans) > 0)
            <form action="{{ route('kelas.create') }}" method="get">
                @include('mypartials.tahunajaran')
                <button type="submit" class="btn btn-sm text-white position-absolute px-3" style="top: .7rem; right: 1rem; background-color: #3bae9c;border-radius: 5px;font-weight: 500;">Tambah Kelas</button>
            </form>
            @endif
        @endif
        <table class="table">
            <thead>
                <tr class="text-center">
                    <th scope="col">No</th>
                    <th scope="col">Nama Kelas</th>
                    @if (auth()->user()->can('edit_kelas') || auth()->user()->can('delete_kelas'))   
                    <th scope="col">Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($classes as $kelas)
                <tr class="text-center">
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $kelas->nama }}</td>
                    @if (auth()->user()->can('edit_kelas') || auth()->user()->can('delete_kelas'))      
                    <td>
                        @if (auth()->user()->can('edit_kelas'))
                        <form action="{{ route('kelas.edit', [$kelas->id]) }}" method="get">
                            @include('mypartials.tahunajaran')
                            <button type="submit" class="btn btn-sm btn-warning text-white" style="width: 5rem; margin: 0.1rem; border-radius: 5px; font-weight: 500;">Edit</button>
                        </form>
                        @endif
                        @if (auth()->user()->can('delete_kelas'))
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="deleteData('{{ route('kelas.destroy', [$kelas->id]) }}')" style="width: 5rem; margin: 0.1rem; border-radius: 5px; font-weight: 500;">Hapus</button>
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