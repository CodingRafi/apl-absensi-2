@extends('mylayouts.main')

@section('container')
{{-- @dd($user) --}}
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.index', [$role]) }}" method="get">
                @include('mypartials.tahunajaran')
                <button class="btn btn-sm btn-danger float-right text-white" type="submit" style="border-radius: 5px;font-weight: 500;">Kembali</button>
              </form>
            <h5 class="card-title">Detail {{ $role }}</h5> 
            <div class="table table-responsive table-borderless table-hover d-flex" style="overflow-x: hidden;"> 
                <table class="table align-middle">
                    <tr class="row">
                        <td class="col-lg-2" style="font-weight: 600;">Nama</td>
                        <td class="col-lg-1">:</td>
                        <td class="col-lg-9">{{ $user->name }}</td>
                    </tr>
                    <tr class="row">
                        <td class="col-lg-2" style="font-weight: 600;">Email</td>
                        <td class="col-lg-1">:</td>
                        <td class="col-lg-9">{{ $user->email }}</td>
                    </tr>
                    <tr class="row">
                        <td class="col-lg-2" style="font-weight: 600;">Jenis Kelamin</td>
                        <td class="col-lg-1">:</td>
                        <td class="col-lg-9">{{ $user->jk == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                    </tr>
                    <tr class="row">
                        <td class="col-lg-2" style="font-weight: 600;">Tempat Lahir</td>
                        <td class="col-lg-1">:</td>
                        <td class="col-lg-9">{{ $user->tempat_lahir }}</td>
                    </tr>
                    <tr class="row">
                        <td class="col-lg-2" style="font-weight: 600;">Tanggal Lahir</td>
                        <td class="col-lg-1">:</td>
                        <td class="col-lg-9">{{ date('d F Y', strtotime($user->tanggal_lahir)) }}</td>
                    </tr>
                    <tr class="row">
                        <td class="col-lg-2" style="font-weight: 600;">Agama</td>
                        <td class="col-lg-1">:</td>
                        <td class="col-lg-9">{{ $user->agama }}</td>
                    </tr>
                    @if($role == 'guru')
                    <tr class="row">
                        <td class="col-lg-2" style="font-weight: 600;">Mata Pelajaran</td>
                        <td class="col-lg-1">:</td>
                        <td class="col-lg-9">{{ $user->mapel }}</td>
                    </tr>
                    @endif
                    <tr class="row">
                        <td class="col-lg-2" style="font-weight: 600;">Provinsi</td>
                        <td class="col-lg-1">:</td>
                        <td class="col-lg-9">{{ $user->provinsi }}</td>
                    </tr>
                    <tr class="row">
                        <td class="col-lg-2" style="font-weight: 600;">Kabupaten</td>
                        <td class="col-lg-1">:</td>
                        <td class="col-lg-9">{{ $user->kabupaten }}</td>
                    </tr>
                    <tr class="row">
                        <td class="col-lg-2" style="font-weight: 600;">Kecamatan</td>
                        <td class="col-lg-1">:</td>
                        <td class="col-lg-9">{{ $user->kecamatan }}</td>
                    </tr>
                    <tr class="row">
                        <td class="col-lg-2" style="font-weight: 600;">Kelurahan</td>
                        <td class="col-lg-1">:</td>
                        <td class="col-lg-9">{{ $user->kelurahan }}</td>
                    </tr>
                    <tr class="row">
                        <td class="col-lg-2" style="font-weight: 600;">Jalan</td>
                        <td class="col-lg-1">:</td>
                        <td class="col-lg-9">{{ $user->jalan }}</td>
                    </tr>
                    @if (isset($user->kelas))
                    <tr class="row">
                        <td class="col-lg-2" style="font-weight: 600;">Kelas</td>
                        <td class="col-lg-1">:</td>
                        <td class="col-lg-9">{{ $user->kelas }}</td>
                    </tr>
                    @endif
                    @if (isset($user->kompetensi))
                    <tr class="row">
                        <td class="col-lg-2" style="font-weight: 600;">Kompetensi Keahlian</td>
                        <td class="col-lg-1">:</td>
                        <td class="col-lg-9">{{ $user->kompetensi }}</td>
                    </tr>
                    @endif
                </table>
                <img class="" src="{{ $user->profil }}" alt="profil" style="max-height: 15rem;">
            </div>
        </div>
    </div>
@endsection