@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title float-left">Agenda Guru</h4>
        <ul class="nav float-right mb-4" style="gap: 1rem;">
            <li class="nav-item">
                <div class="input-group">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Hari
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <form action="/agenda/create" method="get">
                    @include('mypartials.tahunajaran')
                    <button type="submit" class="btn btn-sm text-white font-weight-bold px-3" style="background-color: #3bae9c">Tambah Agenda</button>
                </form>
            </li>
        </ul>
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-light">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classes as $kelas)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kelas->nama }}</td>
                        <td>
                            <form action="/agenda/kelas/{{ $kelas->id }}" method="get">
                                @include('mypartials.tahunajaran')
                                <button type="submit" class="btn btn-sm btn-warning text-white font-weight-bold">Show Jadwal</button>
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