@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title float-left">Jadwal {{ ($role == 'siswa') ? $data->nama : $data->name}}</h4>
        @if (auth()->user()->can('add_agenda'))
        <form action="{{ route('agenda.create', ['role' => $role, 'id' => $data->id]) }}" method="get">
            @include('mypartials.tahunajaran')
            <button type="submit" class="btn btn-sm text-white float-right" style="background-color: #3bae9c; border-radius: 5px; font-weight: 500;">Tambah</button>
        </form>
        @endif
        <form action="{{ route('agenda.index', [$role]) }}" method="get">
            @include('mypartials.tahunajaran')
            <button type="submit" class="btn btn-sm text-white float-right mr-2" style="background-color: red; border-radius: 5px; font-weight: 500;">Kembali</button>
        </form>

        <div class="table-responsive">
            @foreach (config('services.hari.value') as $hari)
                <h6 class="text-capitalize">{{ $hari }}</h6>
                <table class="table text-center mb-5">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" rowspan="2" style="vertical-align: middle;">Jam Ke</th>
                            <th scope="col" rowspan="2" style="vertical-align: middle;">Waktu</th>
                            <th scope="col" rowspan="2" style="vertical-align: middle;">Kegiatan</th>
                            <th scope="col" rowspan="2" style="vertical-align: middle;">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($agendas[$hari] as $agenda)
                        <tr>
                            <th class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;">{{ $agenda->waktu_pelajaran->jam_ke }}</th>
                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;">{{ date('H.i', strtotime($agenda->waktu_pelajaran->jam_awal)) }} - {{ date('H.i', strtotime($agenda->waktu_pelajaran->jam_akhir)) }}</td>
                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;">{{ ($role != 'siswa' && $role != 'guru') ? $agenda->other : (($role == 'guru') ? ($agenda->mapel->nama . ' (' . $agenda->kelas->nama . ')') : ($agenda->mapel->nama . ' (' . $agenda->user->name . ')')) }}</td>
                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;">
                                <a href="{{ route('agenda.edit', ['role' => $role, 'id' => $agenda->id]) }}">Edit</a>
                                @push('other_delete')
                                    <input type="hidden" name="role" value="{{ $role }}">
                                @endpush
                                <button type="submit" class="btn btn-sm btn-danger"
                                onclick="deleteData('{{ route('agenda.destroy', [$agenda->id]) }}')" style="width: 5rem; margin: 0.1rem; border-radius: 5px; font-weight: 500;">Hapus</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach
        </div>

        {{-- <div class="container-fluid p-0 mt-5">
            @foreach ($agendas as $key => $agenda)
            <p style="color: #3bae9c; font-weight: 500;">{{ $key }}</p>
            <table class="table">
                <thead>
                    <tr class="text-center mt-3">
                        <th scope="col">Jam Ke</th>
                        <th scope="col">Waktu</th>
                        @if ($role == 'siswa' || $role == 'guru')    
                            <th scope="col">Mapel</th>
                            @if ($role == 'siswa')
                                <th scope="col">Guru</th>
                            @else
                                <th scope="col">Kelas</th>
                            @endif
                        @else
                            <th scope="col">Kegiatan</th>
                        @endif
                        @if (auth()->user()->can('edit_agenda') || auth()->user()->can('delete_agenda'))
                            <th scope="col">action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($agenda as $sigleJadwal) 
                    <tr class="text-center">
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $sigleJadwal->jam_awal }} - {{ $sigleJadwal->jam_akhir }}</td>
                        @if ($role == 'siswa' || $role == 'guru')   
                            <td>{{ $sigleJadwal->mapel->nama }}</td>
                            @if ($role == 'siswa')
                                @if ($sigleJadwal->user)
                                <td>{{ $sigleJadwal->user->name }}</td>
                                @else
                                <td><span class="badge bg-danger">Tidak ada guru</span></td>
                                @endif
                            @else
                            <td>{{ $sigleJadwal->kelas->nama }}</td>
                            @endif
                        @else
                            <td>{{ $sigleJadwal->other }}</td>
                        @endif
                        @if (auth()->user()->can('edit_agenda') || auth()->user()->can('delete_agenda'))     
                        <td>
                            @if (auth()->user()->can('edit_agenda'))
                            <form action="/agenda/{{ $role }}/{{ $sigleJadwal->id }}/edit" method="get">
                                @include('mypartials.tahunajaran')
                                <button type="submit" class="btn btn-sm btn-warning text-white font-weight-bold" style="min-width: 5vw; margin:2px;">Edit</button>
                            </form>
                            @endif
                            @if (auth()->user()->can('delete_agenda'))
                            <form action="/agenda/{{ $sigleJadwal->id }}" method="post">
                                @csrf
                                @method('delete')
                                @include('mypartials.tahunajaran')
                                <input type="hidden" name="role" value="{{ $role }}">
                                <button type="submit" class="btn btn-sm btn-danger text-white font-weight-bold" onclick="return confirm('yakin ingin menghapus ini?')" style="min-width: 5vw; margin:2px;">Delete</button>
                            </form>
                            @endif
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endforeach
        </div> --}}
    </div>
</div>
@endsection