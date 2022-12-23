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
                        @if (request('kelas'))
                            <input type="hidden" name="kelas" value="{{ request('kelas') }}">
                        @endif
                        @if (request('jurusan'))
                            <input type="hidden" name="jurusan" value="{{ request('jurusan') }}">
                        @endif
                        <input type="text" class="form-control" placeholder="Search" style="height: 1.9rem;" name="search"
                            value="{{ request('search') }}">
                        <button type="submit" class="btn" style="border: 1px solid rgb(205, 205, 205); height: 1.9rem; width: 2.5rem; padding: 0.1rem"><i class="bi bi-search"></i></button>
                    </form>
                </div>
            </li>
            @if ($role == 'siswa')
            @if (Auth::user()->sekolah->tingkat == 'sma' || Auth::user()->sekolah->tingkat == 'smk')
            <div class="dropdown">
                <button class="btn dropdown-toggle jurusan" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false" style="border: 1px solid rgb(205, 205, 205); height: 1.9rem; min-width: 6rem; padding: 0.1rem">
                    Jurusan
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    @foreach ($kompetensis as $kompetensi)
                    <li>
                        <form action="" method="get">
                            @include('mypartials.tahunajaran')
                            @if (request('kelas'))
                                <input type="hidden" name="kelas" value="{{ request('kelas') }}">
                            @endif
                            @if (request('search'))
                                <input type="hidden" name="search" value="{{ request('search') }}">
                            @endif
                            <input type="hidden" name="jurusan" value="{{ $kompetensi->id }}">
                            <button type="submit" class="dropdown-item">{{ $kompetensi->kompetensi }}</button>
                        </form>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="dropdown">
                <button class="btn dropdown-toggle kelas" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false" style="border: 1px solid rgb(205, 205, 205); height: 1.9rem; min-width: 5rem; padding: 0.1rem">
                    Kelas
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    @foreach ($kelas as $row)
                    <li>
                        <form action="" method="get">
                            @include('mypartials.tahunajaran')
                            @if (request('jurusan'))
                                <input type="hidden" name="jurusan" value="{{ request('jurusan') }}">
                            @endif
                            @if (request('search'))
                                <input type="hidden" name="search" value="{{ request('search') }}">
                            @endif
                            <input type="hidden" name="kelas" value="{{ $row->id }}">
                            <button type="submit" class="dropdown-item">{{ $row->nama }}</button>
                        </form>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if (auth()->user()->can('export_users')) 
            <li class="nav-item">
                <form action="/export/users/{{ $role }}" method="get">
                    @include('mypartials.tahunajaran')
                    @if (request('kelas'))
                        <input type="hidden" name="kelas" value="{{ request('kelas') }}">
                    @endif
                    @if (request('jurusan'))
                        <input type="hidden" name="jurusan" value="{{ request('jurusan') }}">
                    @endif
                    @if (request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    <button type="submit" class="btn btn-sm text-white px-3"
                        style="background-color: #3bae9c;border-radius: 5px;font-weight: 500;">Export</button>
                </form>
            </li>
            @endif
            @if (auth()->user()->can('import_users')) 
            <li class="nav-item">
                <form action="/import/users/{{ $role }}" method="get">
                    @include('mypartials.tahunajaran')
                    <button class="btn btn-sm text-white"
                        style="background-color: #3bae9c;border-radius: 5px;font-weight: 500;">Import</button>
                </form> 
            </li>
            @endif
            @if (auth()->user()->can('add_users'))
            <li class="nav-item">
                <form action="{{ route('users.create', [$role]) }}" method="get">
                    @include('mypartials.tahunajaran')
                    <button class="btn btn-sm text-white" style="background-color: #3bae9c;border-radius: 5px;font-weight: 500;">Tambah</button>
                </form>
            </li>
            @endif
        </ul>
        <div class="table table-responsive table-hover text-center">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Profil</th>
                        <th scope="col">Name</th>
                        @if (auth()->user()->can('edit_users') || auth()->user()->can('delete_users'))
                        <th scope="col">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>
                            <img src="{{ $user->profil == '/img/profil.png' ? $user->profil : asset('storage/' . $user->profil) }}" alt="" style="object-fit: cover; border-radius: 50%">
                        </td>
                    <td>{{ $role != 'siswa' ? ($user->profile_user ? $user->profile_user->name : '') : ($user->profile_siswa ? $user->profile_siswa->name : '') }}</td>
                        @if (auth()->user()->can('edit_users') || auth()->user()->can('delete_users'))      
                        <td>
                            <form action="{{ route('users.shows', ['role' => $role, 'id' => $user->id]) }}" method="get">
                                @include('mypartials.tahunajaran')
                                <button class="btn btn-sm btn-info text-white" style="width: 5rem; margin: 0.1rem;border-radius: 5px;font-weight: 500;">Show</button>
                            </form>
                            @if (auth()->user()->can('edit_users'))
                            <form action="{{ route('users.edit', ['role' => $role, 'id' => $user->id]) }}" method="get">
                                @include('mypartials.tahunajaran')
                                <button class="btn btn-sm btn-warning text-white" style="width: 5rem; margin: 0.1rem;border-radius: 5px;font-weight: 500;">Edit</button>
                            </form>
                            @endif
                            @if (auth()->user()->can('delete_user'))
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="deleteData('{{ route('user.destroy', [$user->id]) }}')" style="width: 5rem; margin: 0.1rem;border-radius: 5px;font-weight: 500;">Hapus</button>
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