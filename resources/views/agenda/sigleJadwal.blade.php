@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title float-left">Jadwal {{ $kelas->nama }}</h4>
        <form action="/agenda/create" method="get">
            @include('mypartials.tahunajaran')
            <input type="hidden" name="idk" value="{{ $kelas->id }}">
            <button type="submit" class="btn btn-sm text-white font-weight-bold float-right" style="background-color: #3bae9c">Tambah Jadwal</button>
        </form>
        <form action="/agenda" method="get">
            @include('mypartials.tahunajaran')
            <input type="hidden" name="idk" value="{{ $kelas->id }}">
            <button type="submit" class="btn btn-sm text-white font-weight-bold float-right mr-2" style="background-color: red">Kembali</button>
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
                            <form action="/agenda/{{ $sigleJadwal->id }}" method="post">
                                @csrf
                                @method('delete')
                                @include('mypartials.tahunajaran')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('yakin ingin menghapus ini?')">Delete</button>
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