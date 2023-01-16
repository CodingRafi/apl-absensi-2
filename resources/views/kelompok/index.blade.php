@extends('mylayouts.main')

@section('container')
    <div class="card">
        <div class="card-body">
            <div class="title d-flex justify-content-between">
                <h4 class="card-title">Kelompok</h4>
                <form action="{{ route('kelompok.create') }}" method="get">
                    @include('mypartials.tahunajaran')
                    <button class="btn btn-sm text-white font-weight-bold" style="background-color: #3bae9c; min-width: 5vw;border-radius: 5px;">Tambah</button>
                </form>
            </div>
            <div class="table table-responsive table-hover text-center">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kelompok</th>
                            <th>Nama Guru</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kelompoks as $kelompok)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kelompok->nama }}</td>
                            <td>
                                @foreach ($kelompok->user as $user)
                                    {{ $user->profile_user->name }}
                                @endforeach
                            </td>
                            <td>
                                <form action="{{ route('kelompok.show', [$kelompok->id]) }}" method="get">
                                    @include('mypartials.tahunajaran')
                                    <button class="btn btn-sm text-white" style="background-color: #3bae9c; width: 5rem; margin: 0.1rem;border-radius: 5px;font-weight: 500;">Show</button>
                                </form>
                                @if (auth()->user()->can('edit_kelompok'))
                                <form action="{{ route('kelompok.edit', [$kelompok->id]) }}" method="get">
                                    @include('mypartials.tahunajaran')
                                    <button class="btn btn-sm btn-warning text-white" style="min-width: 5rem; margin: 2px;border-radius: 5px;font-weight: 500;">Edit</button>
                                </form>
                                @endif
                                @if (auth()->user()->can('delete_kelompok'))
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="deleteData('{{ route('kelompok.destroy', [$kelompok->id]) }}')" style="width: 5rem; margin: 0.1rem;border-radius: 5px;font-weight: 500;">Hapus</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection