@extends('mylayouts.main') 
 
@section('container') 
    <div class="card"> 
        <div class="card-body"> 
            <div class="row">
                <div class="col-md">
                    <h4 class="card-title">Absensi Pelajaran</h4>
                </div>
                <div class="col-md-3 d-flex justify-content-end">
                    <form action="{{ route('absensi-pelajaran.create') }}" method="get">
                        @include('mypartials.tahunajaran')
                        <button class="btn btn-sm text-white" style="background-color: #3bae9c;border-radius: 5px;font-weight: 500;">Tambah Absensi Pelajaran</button>
                    </form>
                </div>
            </div>
            <div class="table-responsive"> 
                <table class="table"> 
                    <thead class="thead-light"> 
                        <tr class="text-center"> 
                            <th>No</th> 
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Mapel</th>
                            <th>Aksi</th> 
                        </tr> 
                    </thead> 
                    <tbody> 
                        @foreach ($absensi_pelajarans as $absensi_pelajaran)    
                        <tr class="text-center"> 
                            <td>{{ $loop->iteration }}</td> 
                            <td>{{ $absensi_pelajaran->nama }}</td>
                            <td>{{ $absensi_pelajaran->kelas->nama }}</td>
                            <td>{{ $absensi_pelajaran->mapel->nama }}</td> 
                            <td> 
                                <form action="{{ route('absensi-pelajaran.show', [$absensi_pelajaran->id]) }}" method="get"> 
                                    @include('mypartials.tahunajaran') 
                                    <button type="submit" class="btn btn-sm text-white font-weight-bold" style="margin: 0.1rem; background-color: #3bae9c">Tambah Presensi</button> 
                                </form>
                                <form action="{{ route('absensi-pelajaran.edit', [$absensi_pelajaran->id]) }}" method="get"> 
                                    @include('mypartials.tahunajaran') 
                                    <button type="submit" class="btn btn-sm btn-warning">Edit</button> 
                                </form>
                                <form action="{{ route('absensi-pelajaran.edit', [$absensi_pelajaran->id]) }}" method="get"> 
                                    @include('mypartials.tahunajaran') 
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button> 
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
