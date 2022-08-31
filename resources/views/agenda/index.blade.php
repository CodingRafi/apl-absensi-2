@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title float-left">Agenda</h4>
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
                                <button type="submit" class="btn btn-sm text-white text-white font-weight-bold" style="background-color: #3bae9c">Show Jadwal</button>
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