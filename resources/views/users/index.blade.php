@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title float-left">Data {{ $role }}</h4>
        <ul class="nav float-right mb-4" style="gap: 1rem;">
            <li class="nav-item">
                <div class="input-group input-group-sm">
                    <form action="" method="get">
                        @include('mypartials.tahunajaran')
                        <input type="text" class="form-control" placeholder="Search" style="height: 29px;" name="search"
                            value="{{ request('search') }}">
                        <button type="submit">Search</button>
                    </form>
                </div>
            </li>
            <li class="nav-item">
                <form action="/export/users/{{ $role }}" method="get">
                    @include('mypartials.tahunajaran')
                    <button type="submit" class="btn btn-sm text-white font-weight-bold px-3"
                        style="background-color: #3bae9c">Export</button>
                </form>
            </li>
            <li class="nav-item">
                <form action="/import/users/{{ $role }}" method="get">
                    @include('mypartials.tahunajaran')
                    <button class="btn btn-sm text-white font-weight-bold"
                        style="background-color: #3bae9c">Import</button>
                </form>
            </li>
            <li class="nav-item">
                <form action="/users/create/{{ $role }}" method="get">
                    @include('mypartials.tahunajaran')
                    <button class="btn btn-sm text-white font-weight-bold" style="background-color: #3bae9c">Tambah {{
                        $role }}</button>
                </form>
            </li>
        </ul>
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-light">
                    <tr>
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
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
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
                        <td>
                            <form action="/users/{{ $user->id }}/edit" method="get">
                                @include('mypartials.tahunajaran')
                                <button class="btn btn-warning">Edit</button>
                            </form>
                            <form action="/users/{{ $user->id }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Hapus</button>
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