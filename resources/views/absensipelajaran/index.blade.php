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
                            <th>Mapel</th>
                            <th>Aksi</th> 
                        </tr> 
                    </thead> 
                    <tbody> 
                        @foreach ($absensi_pelajarans as $absensi_pelajaran)    
                        <tr class="text-center"> 
                            <td>{{ $loop->iteration }}</td> 
                            <td>{{ $absensi_pelajaran->kelas->nama }}</td>
                            <td>{{ $absensi_pelajaran->mapel->nama }}</td> 
                            <td> 
                                <form action="/presensi" method="get"> 
                                    @include('mypartials.tahunajaran') 
                                    <input type="hidden" name="idk" value="{{ $absensi_pelajaran->kelas->id }}">
                                    <button type="submit" class="btn btn-sm btn-success text-white font-weight-bold" style="margin: 0.1rem">Tambah Presensi</button> 
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


