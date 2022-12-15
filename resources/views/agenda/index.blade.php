@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title float-left">Jadwal {{ $role }}</h4>
        <div class="table table-responsive table-hover text-center">
            <table class="table align-middle">
                <thead>
                    <tr>
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
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kelas->nama }}</td>
                            <td>
                                <form action="/agenda/siswa/{{ $kelas->id }}" method="get">
                                    @include('mypartials.tahunajaran')
                                    <button type="submit" class="btn btn-sm text-white text-white" style="background-color: #3bae9c;border-radius: 5px; 500;">Show Jadwal</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>
                                    <form action="/agenda/{{ $role }}/{{ $user->id }}" method="get">
                                        @include('mypartials.tahunajaran')
                                        <button type="submit" class="btn btn-sm text-white text-white" style="background-color: #3bae9c;border-radius: 5px;font-weight: 500;">Show Jadwal</button>
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