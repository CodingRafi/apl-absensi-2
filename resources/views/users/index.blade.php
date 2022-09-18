@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title float-left">Data {{ $role }}</h4>
        <ul class="nav float-right mb-4" style="gap: 1rem;">
            <li class="nav-item">
                <div class="input-group input-group-sm">
                    <form action="" method="get" style="display: flex; gap: 0.3rem;">
                        @include('mypartials.tahunajaran')
                        <input type="text" class="form-control" placeholder="Search" style="height: 1.9rem;" name="search"
                            value="{{ request('search') }}">
                        <button type="submit" class="btn" style="border: 1px solid rgb(205, 205, 205); height: 1.9rem; width: 2.5rem; padding: 0.1rem"><i class="bi bi-search"></i></button>
                    </form>
                </div>
            </li>
            @if (auth()->user()->can('export_users')) 
            <li class="nav-item">
                <form action="/export/users/{{ $role }}" method="get">
                    @include('mypartials.tahunajaran')
                    <button type="submit" class="btn btn-sm text-white font-weight-bold px-3"
                        style="background-color: #3bae9c">Export</button>
                </form>
            </li>
            @endif
            @if (auth()->user()->can('import_users')) 
            <li class="nav-item">
                <form action="/import/users/{{ $role }}" method="get">
                    @include('mypartials.tahunajaran')
                    <button class="btn btn-sm text-white font-weight-bold"
                        style="background-color: #3bae9c">Import</button>
                </form>
            </li>
            @endif
            @if (auth()->user()->can('add_users'))
            <li class="nav-item">
                <form action="/users/create/{{ $role }}" method="get">
                    @include('mypartials.tahunajaran')
                    <button class="btn btn-sm text-white font-weight-bold" style="background-color: #3bae9c">Tambah</button>
                </form>
            </li>
            @endif
        </ul>
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-light">
                    <tr class="text-center">
                        <th scope="col">No</th>
                        <th scope="col">Profil</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        @if ($role == 'guru')
                        <th scope="col">Mapel</th>
                        @endif
                        <th scope="col">NIP</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Tempat Lahir</th>
                        <th scope="col">Tanggal Lahir</th>
                        <th scope="col">Agama</th>
                        <th scope="col">Rfid</th>
                        <th scope="col">Status Rfid</th>
                        @if (auth()->user()->can('edit_users') || auth()->user()->can('delete_users'))
                        <th scope="col">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    {{-- @dd($user) --}}
                    <tr class="text-center">
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>
                            @if ($user->profil == '/img/profil.png')
                            <img src="{{ $user->profil }}" alt="" style="width: 50px;object-fit: contain">
                            @else
                            <img src="{{ asset('storage/' . $user->profil) }}" alt=""
                                style="width: 50px;object-fit: contain">
                            @endif
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        @if ($role == 'guru')
                        <td>
                            @foreach ($user->mapel as $mapel)
                            <p>{{ $loop->iteration }}. {{ $mapel->nama }}</p>
                            @endforeach
                        </td>
                        @endif
                        <td>{{ $user->nip }}</td>
                        <td>{{ $user->jk }}</td>
                        <td>{{ $user->tempat_lahir }}</td>
                        <td>{{ $user->tanggal_lahir }}</td>
                        <td>{{ $user->agama }}</td>
                        @if ($user->rfid)
                        <td>{{ $user->rfid->rfid_number }}</td>
                        @else
                        <td></td>
                        @endif
                        @if ($user->rfid)
                        <td>{{ $user->rfid->status }}</td>
                        @else
                        <td></td>
                        @endif
                        @if (auth()->user()->can('edit_users') || auth()->user()->can('delete_users'))      
                        <td>
                            @if (auth()->user()->can('edit_users'))
                            <form action="/users/{{ $user->id }}/edit" method="get">
                                @include('mypartials.tahunajaran')
                                <button class="btn btn-sm btn-warning text-white font-weight-bold" style="width: 5rem; margin: 0.1rem;">Edit</button>
                            </form>
                            @endif
                            @if (auth()->user()->can('delete_users'))
                            <form action="/users/{{ $user->id }}" method="post">
                                @csrf
                                @method('delete')
                                @include('mypartials.tahunajaran')
                                <button type="submit" class="btn btn-sm btn-danger font-weight-bold" style="width: 5rem; margin: 0.1rem;" onclick="return confirm('apakah anda yakin ingin menghapus user ini? data lainnya termasuk rfid, absensi, dan agenda juga akan terhapus.')">Hapus</button>
                            </form>
                            @endif
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection