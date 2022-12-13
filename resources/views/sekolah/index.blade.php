@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title float-left">Sekolah</h4>
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-light">
                    <tr class="text-center">
                        <th scope="col">No</th>
                        <th scope="col">Logo</th>
                        <th scope="col">Name</th>
                        <th scope="col">NPSN</th>
                        <th scope="col">Kepala Sekolah</th>
                        <th scope="col">Tingkat</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Instagram</th>
                        <th scope="col">Youtube</th>
                        @if (auth()->user()->can('edit_sekolah') || auth()->user()->can('delete_sekolah'))
                        <th scope="col">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($schools as $sekolah)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>
                            @if ($sekolah->logo != '/img/tutwuri.png')
                            <img src="{{ asset('storage/' . $sekolah->logo) }}" alt="" style="width: 50px;height:50px;object-fit: cover">
                            @else
                            <img src="{{ $sekolah->logo }}" alt="" style="width: 50px;height:50px;object-fit: cover">
                            @endif
                        </td>
                        <td>{{ $sekolah->nama }}</td>
                        <td>{{ $sekolah->npsn }}</td>
                        <td>{{ $sekolah->kepala_sekolah }}</td>
                        <td style="text-transform: uppercase;s">{{ $sekolah->tingkat }}</td>
                        <td>{{ $sekolah->alamat }}</td>
                        <td>{{ $sekolah->instagram }}</td>
                        <td>{{ $sekolah->youtube }}</td>
                        @if (auth()->user()->can('edit_sekolah') || auth()->user()->can('delete_sekolah')) 
                        <td>
                            @if (auth()->user()->can('delete_sekolah'))
                            <button type="submit" class="btn btn-sm btn-danger font-weight-bold"
                                onclick="deleteData('{{ route('sekolah.destroy', [$sekolah->id]) }}')" style="width: 5rem; margin: 0.1rem">Hapus</button>
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