@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title float-left">Jadwal {{ $kelas->nama }}</h4>
        <form action="/agenda/create" method="get">
            @include('mypartials.tahunajaran')
            <input type="hidden" name="idk" value="{{ $kelas->id }}">
            <button type="submit" class="btn btn-success">Tambah Jadwal</button>
        </form>

        <div class="container-fluid p-0">
            @foreach ($agendas as $key => $agenda)
            <p>{{ $key }}</p>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Jam Ke</th>
                        <th scope="col">Waktu</th>
                        <th scope="col">Mapel</th>
                        <th scope="col">Guru</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($agenda as $sigleJadwal) 
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $sigleJadwal->jam_awal }} - {{ $sigleJadwal->jam_akhir }}</td>
                        <td>{{ $sigleJadwal->mapel->nama }}</td>
                        <td>{{ $sigleJadwal->user->name }}</td>
                        <td>
                            <form action="/agenda/{{ $sigleJadwal->id }}/edit" method="get">
                                @include('mypartials.tahunajaran')
                                <button type="submit" class="btn btn-warning">Edit</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endforeach
        </div>
    </div>
</div>
@endsection