@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        @can('add_agama')
        <div class="title d-flex justify-content-between">
            <h4 class="card-title">Agama</h4>
            <button type="button" class="btn btn-sm text-white float-right" data-bs-toggle="modal" data-bs-target="#tambah-agama" style="height: fit-content; background-color: #3bae9c;border-radius: 5px;font-weight: 500;">
                Tambah Agama
            </button>
        </div>
        @endcan
    </div>
    <div class="table table-responsive table-hover text-center">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    @can('edit_agama', 'hapus_agama')
                    <th scope="col">Options</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach ($agamas as $agama)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $agama->nama }}</td>
                        <td>
                            <a href="{{ route('agama.edit', [$agama->id]) }}" class="btn btn-sm btn-warning text-white" style="border-radius: 5px; font-weight: 500;">Edit</a>
                            @if (auth()->user()->can('delete_agama'))
                            <button type="submit" class="btn btn-sm btn-danger font-weight-bold"
                                onclick="deleteData('{{ route('agama.destroy', [$agama->id]) }}')" style="border-radius: 5px; font-weight: 500;">Hapus</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@can('add_agama')
<div class="modal fade" id="tambah-agama" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('agama.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Agama</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_agama" class="form-label">Nama Agama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama_agama"
                            name="nama" value="{{ old('nama') }}">
                        @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn text-white" style="background-color: #3bae9c;">Tambah</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endcan

@endsection
@push('js')
@if (count($errors->all()) > 0)
<script>
    $(document).ready(function(){
        $('#tambah-agama').modal('show');
    })
</script>
@endif
@endpush