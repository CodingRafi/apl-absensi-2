@extends('mylayouts.main')

@section('container')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Kelas</th>
                            <th>User</th>
                            <th>Mapel</th>
                            <th>Tahun ajaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td>No</td>
                            <td>Kelas</td>
                            <td>User</td>
                            <td>Mapel</td>
                            <td>Tahun ajaran</td>
                            <td>
                                <form action="" method="get">
                                    @include('mypartials.tahunajaran')
                                    <button type="submit" class="btn btn-sm btn-warning text-white font-weight-bold" style="width: 5rem; margin: 0.1rem">Edit</button>
                                </form>
                                <form action="" method="post">
                                    @csrf
                                    @method('delete')
                                    @include('mypartials.tahunajaran')
                                    <button type="submit" class="btn btn-sm btn-danger font-weight-bold"
                                        onclick="return confirm('apakah anda yakin akan menghapus jurusan ini? maka semua siswa pada jurusan ini akan terhapus')" style="width: 5rem; margin: 0.1rem">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection