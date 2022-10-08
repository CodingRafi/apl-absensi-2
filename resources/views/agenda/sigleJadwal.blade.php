@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        @if ($role == 'siswa')
        <h4 class="card-title float-left">Jadwal {{ $kelas->nama }}</h4>
        @else
        <h4 class="card-title float-left">Jadwal {{ $user->name }}</h4>
        @endif
        @if (auth()->user()->can('add_agenda'))
        <form action="/agenda/create/{{ $role }}" method="get">
            @include('mypartials.tahunajaran')
            @if ($role == 'siswa')
            <input type="hidden" name="idk" value="{{ $kelas->id }}">
            @else
            <input type="hidden" name="idu" value="{{ $user->id }}">
            @endif
            <button type="submit" class="btn btn-sm text-white font-weight-bold float-right" style="background-color: #3bae9c">Tambah</button>
        </form>
        @endif
        <form action="/agenda/{{ $role }}" method="get">
            @include('mypartials.tahunajaran')
            <button type="submit" class="btn btn-sm text-white font-weight-bold float-right mr-2" style="background-color: red">Kembali</button>
        </form>

        {{-- <div class="table-responsive">
            <div id='calendar'></div>
            <table class="table text-center">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" rowspan="2" style="vertical-align: middle;">No</th>
                        <th scope="col" rowspan="2" style="vertical-align: middle;">Nama</th>
                        <th scope="col" colspan="16">October</th>
                    </tr>
                    <tr>
                        <th scope="col">1</th>
                        <th scope="col">2</th>
                        <th scope="col">3</th>
                        <th scope="col">4</th>
                        <th scope="col">5</th>
                        <th scope="col">6</th>
                        <th scope="col">7</th>
                        <th scope="col">8</th>
                        <th scope="col">9</th>
                        <th scope="col">10</th>
                        <th scope="col">11</th>
                        <th scope="col">12</th>
                        <th scope="col">13</th>
                        <th scope="col">14</th>
                        <th scope="col">15</th>
                        <th scope="col">16</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row" rowspan="2" style="vertical-align: middle;">1</th>
                            <td rowspan="2" style="vertical-align: middle;">Guru</td>
                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        </tr>
                        <tr>
                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td> 
                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td> 
                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td> 
                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td> 
                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td> 
                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td> 
                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td> 
                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td> 
                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td> 
                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td> 
                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td> 
                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td> 
                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td> 
                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td> 
                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td> 
                            <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td> 
                        </tr>
                    
                </tbody>
            </table>
        </div> --}}

        <div class="table-responsive">
            <div id='calendar'></div>
            <table class="table text-center mt-3">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" rowspan="2" style="vertical-align: middle;">Jam Ke</th>
                        <th scope="col" rowspan="2" style="vertical-align: middle;">Waktu</th>
                        <th scope="col" rowspan="2" style="vertical-align: middle;">Senin</th>
                        <th scope="col" rowspan="2" style="vertical-align: middle;">Selasa</th>
                        <th scope="col" rowspan="2" style="vertical-align: middle;">Rabu</th>
                        <th scope="col" rowspan="2" style="vertical-align: middle;">Kamis</th>
                        <th scope="col" rowspan="2" style="vertical-align: middle;">Jumat</th>
                        <th scope="col" rowspan="2" style="vertical-align: middle;">Sabtu</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;">1</th>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;">07.00 - 08.00</td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;">
                            <span>Pemrograman Berorientasi Objek (PBO)</span> <br>
                            <span>XI RPL 2</span>
                        </td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                    </tr>
                    <tr>
                        <th class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;">2</th>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;">08.00 - 09.00</td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;">
                            <span>Pemrograman Berorientasi Objek (PBO)</span> <br>
                            <span>XI RPL 2</span>
                        </td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                    </tr>
                    <tr>
                        <th class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;">3</th> 
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;">09.00 - 10.00</td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;">
                            <span>Pemrograman Berorientasi Objek (PBO)</span> <br>
                            <span>XI RPL 2</span>
                        </td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                    </tr>
                    <tr>
                        <th class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;">4</th> 
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                    </tr>
                    <tr>
                        <th class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;">5</th> 
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                    </tr>
                    <tr>
                        <th class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;">6</th> 
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                    </tr>
                    <tr>
                        <th class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;">7</th> 
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                    </tr>
                    <tr>
                        <th class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;">8</th> 
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                    </tr>
                    <tr>
                        <th class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;">9</th> 
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                    </tr>
                    <tr>
                        <th class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;">10</th> 
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                    </tr>
                    <tr>
                        <th class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;">11</th> 
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                    </tr>
                    <tr>
                        <th class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;">12</th> 
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                    </tr>
                    <tr>
                        <th class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;">13</th> 
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                    </tr>
                    <tr>
                        <th class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;">14</th> 
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                    </tr>
                    <tr>
                        <th class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;">15</th> 
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                    </tr>
                    <tr>
                        <th class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;">16</th> 
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                        <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;"></td>
                    </tr>
                </tbody>
            </table>
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