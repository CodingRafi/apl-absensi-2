@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Mata Pelajaran</h4>
        @if (auth()->user()->can('add_mapel'))
        <form action="{{ route('mapel.create') }}" method="get">
            @include('mypartials.tahunajaran')
            <button class="btn btn-sm text-white position-absolute px-3" style="top: .7rem; right: 1rem; background-color: #3bae9c;border-radius: 5px;font-weight: 500;">Tambah</button>
        </form>
        @endif
        <table class="table">
            <thead>
                <tr class="text-center">
                    <th scope="col">No</th>
                    <th scope="col">Nama Mapel</th>
                    @if (auth()->user()->can('edit_mapel') || auth()->user()->can('delete_mapel'))
                    <th scope="col">Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($mapels as $mapel)
                <tr class="text-center">
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $mapel->nama }}</td>
                    @if (auth()->user()->can('edit_mapel') || auth()->user()->can('delete_mapel'))    
                    <td>
                        @if (auth()->user()->can('edit_mapel'))
                        <form action="{{ route('mapel.edit', [$mapel->id]) }}" method="get">
                            @include('mypartials.tahunajaran')
                            <button type="submit" class="btn btn-sm btn-warning text-white" style="width: 5rem; margin: 0.1rem; border-radius: 5px; font-weight: 500;">Edit</button>
                        </form>
                        @endif
                        @if (auth()->user()->can('delete_mapel'))
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="deleteData('{{ route('mapel.destroy', [$mapel->id]) }}')" style="width: 5rem; margin: 0.1rem; border-radius: 5px; font-weight: 500;">Hapus</button>
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