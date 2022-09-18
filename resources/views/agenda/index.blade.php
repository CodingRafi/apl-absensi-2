@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title float-left">Agenda {{ $role }}</h4>
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-light">
                    <tr class="text-center">
                        <th>No</th>
                        @if ($role == 'siswa')
                        <th>Kelas</th>
                        @else
                        <th>Nama</th>
                        @endif
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($role == 'siswa')    
                        @foreach ($classes as $kelas)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kelas->nama }}</td>
                            <td>
                                <form action="/agenda/siswa/{{ $kelas->id }}" method="get">
                                    @include('mypartials.tahunajaran')
                                    <button type="submit" class="btn btn-sm text-white text-white font-weight-bold" style="background-color: #3bae9c">Show Jadwal</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        @foreach ($users as $user)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>
                                    <form action="/agenda/{{ $role }}/{{ $user->id }}" method="get">
                                        @include('mypartials.tahunajaran')
                                        <button type="submit" class="btn btn-sm text-white text-white font-weight-bold" style="background-color: #3bae9c">Show Jadwal</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection