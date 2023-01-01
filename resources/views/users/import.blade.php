@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 style="display: inline">Import</h4>
        <form action="/users/{{ $role }}" method="get" style="display: inline">
            @include('mypartials.tahunajaran')
            <button
                class="nav-link {{ Request::is('dashboard') ? 'active' : '' }} btn btn-sm btn-danger float-right text-white"
                style="display: inline; border-radius: 5px; font-weight: 500;">Kembali</button>
        </form>
        <form action="/import/users/{{ $role }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('mypartials.tahunajaran')
            
            @if (count($errors) > 0)
            <div class="row mt-3">
                <div class="col-md-8 col-md-offset-1">
                  <div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-ban"></i> Error!</h4>
                      @foreach($errors->all() as $error)
                      {{ $error }} <br>
                      @endforeach      
                  </div>
                </div>
            </div>
            @endif
            <div class="mb-3 mt-4">
                <label for="formFile" class="form-label">Pilih File</label>
                <input class="form-control" type="file" id="formFile" style="height: 37px" name="file" required>
            </div>
            @if ($role == 'siswa')
                <div class="mb-3 mt-4">
                    <label for="formFile" class="form-label">Kelas</label>
                    <select class="form-select" name="kelas_id">
                        @foreach ($kelas as $row)
                            <option value="{{ $row->id }}">{{ $row->nama }}</option>
                        @endforeach
                    </select>
                </div>
                @if ( Auth::user()->sekolah->tingkat == 'smk' )     
                <div class="mb-3 mt-4">
                    <label for="formFile" class="form-label">Jurusan</label>
                    <select class="form-select" name="kompetensi_id">
                        @foreach ($kompetensis as $kompetensi)
                            <option value="{{ $kompetensi->id }}">{{ $kompetensi->kompetensi }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
            @endif
            <button class="btn btn-sm text-white px-3" style="background-color: #3bae9c; border-radius: 5px; font-weight: 500;" type="submit">Import</button>
        </form>
    </div>
</div>
@endsection