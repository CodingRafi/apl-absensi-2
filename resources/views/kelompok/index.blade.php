@extends('mylayouts.main')

@section('container')
    <div class="card">
        <div class="card-body">
            <div class="title d-flex justify-content-between">
                <h4 class="card-title">Kelompok</h4>
                <form action="{{ route('kelompok.create') }}" method="get">
                    @include('mypartials.tahunajaran')
                    <button class="btn btn-sm text-white font-weight-bold" style="background-color: #3bae9c; min-width: 5vw;">Create</button>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Kelompok</th>
                            <th>Jam Masuk</th>
                            <th>Jam Pulang</th>
                            <th>Nama Guru</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kelompoks as $kelompok)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kelompok->nama }}</td>
                            <td>{{ $kelompok->jam_masuk }}</td>
                            <td>{{ $kelompok->jam_pulang }}</td>
                            <td>
                                @foreach ($kelompok->user as $user)
                                    <p>{{ $user->name }}</p>
                                @endforeach
                            </td>
                            <td>
                                <form action="{{ route('kelompok.edit', [$kelompok->id]) }}" method="get">
                                    @include('mypartials.tahunajaran')
                                    <button class="btn btn-sm btn-warning text-white font-weight-bold" style="min-width: 5vw; margin: 2px;">Edit</button>
                                </form>
                                <form action="{{ route('kelompok.destroy', [$kelompok->id]) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    @include('mypartials.tahunajaran')
                                    <button class="btn btn-sm btn-danger text-white font-weight-bold" style="min-width: 5vw; margin: 2px;">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection