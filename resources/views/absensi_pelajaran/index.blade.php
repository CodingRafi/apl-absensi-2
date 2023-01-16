@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md">
                <h4 class="card-title">Absensi Pelajaran</h4>
            </div>
            @can('add_absensi_pelajaran')
            <div class="col-md-3 d-flex justify-content-end">
                <form action="{{ route('absensi-pelajaran.create') }}" method="get">
                    @include('mypartials.tahunajaran')
                    <button class="btn btn-sm text-white"
                        style="background-color: #3bae9c;border-radius: 5px;font-weight: 500;">Tambah Absensi
                        Pelajaran</button>
                </form>
            </div>
            @endcan
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-light">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Mapel</th>
                        @can('edit_absensi_pelajaran', 'delete_absensi_pelajaran')
                        <th>Aksi</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($absensi_pelajarans as $absensi_pelajaran)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $absensi_pelajaran->nama }}</td>
                        <td>{{ $absensi_pelajaran->kelas->tingkat->romawi }} {{ $absensi_pelajaran->kelas->nama }}</td>
                        <td>{{ $absensi_pelajaran->mapel->nama }}</td>
                        <td>
                            <form action="{{ route('absensi-pelajaran.show', [$absensi_pelajaran->id]) }}" method="get">
                                @include('mypartials.tahunajaran')
                                <button type="submit" class="btn btn-sm text-white mb-2"
                                    style="border-radius: 5px; font-weight: 500; background-color: #3bae9c">Tambah
                                    Presensi</button>
                            </form>
                            @can('edit_absensi_pelajaran', 'delete_absensi_pelajaran')
                            <div class="d-flex justify-content-center gap-3">
                                @can('edit_absensi_pelajaran')
                                <form action="{{ route('absensi-pelajaran.edit', [$absensi_pelajaran->id]) }}"
                                    method="get">
                                    @include('mypartials.tahunajaran')
                                    <button type="submit" class="btn btn-sm btn-warning text-white"
                                        style="border-radius: 5px; font-weight: 500;">Edit</button>
                                </form>
                                @endcan
                                @can('delete_absensi_pelajaran')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="deleteData('{{ route('absensi-pelajaran.destroy', [$absensi_pelajaran->id]) }}')"
                                    style="width: 5rem; margin: 0.1rem;border-radius: 5px;font-weight: 500;">Hapus</button>
                                @endcan
                            </div>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection