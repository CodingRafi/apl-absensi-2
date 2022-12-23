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
            <table>
                <tr>
                    <td>Nama:</td>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin:</td>
                    <td>{{ $user->jk == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                </tr>
                <tr>
                    <td>Tempat Lahir:</td>
                    <td>{{ $user->tempat_lahir }}</td>
                </tr>
                <tr>
                    <td>Tanggal Lahir:</td>
                    <td>{{ date('d F Y', strtotime($user->tanggal_lahir)) }}</td>
                </tr>
                <tr>
                    <td>Agama:</td>
                    <td>{{ $user->agama }}</td>
                </tr>
                <tr>
                    <td>Provinsi</td>
                    <td>{{ $user->provinsi }}</td>
                </tr>
                <tr>
                    <td>Kabupaten</td>
                    <td>{{ $user->kabupaten }}</td>
                </tr>
                <tr>
                    <td>Kecamatan</td>
                    <td>{{ $user->kecamatan }}</td>
                </tr>
                <tr>
                    <td>Kelurahan</td>
                    <td>{{ $user->kelurahan }}</td>
                </tr>
                <tr>
                    <td>Jalan</td>
                    <td>{{ $user->jalan }}</td>
                </tr>
                @if (isset($user->kelas))
                <tr>
                    <td>Kelas</td>
                    <td>{{ $user->kelas }}</td>
                </tr>
                @endif
                @if (isset($user->kompetensi))
                <tr>
                    <td>Kompetensi Keahlian :</td>
                    <td>{{ $user->kompetensi }}</td>
                </tr>
                @endif
            </table>
        </div>
    </div>
@endsection