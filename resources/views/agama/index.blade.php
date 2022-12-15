@extends('mylayouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Agama</h1>
</div>

<div class="container">
    <div class="container p-0">
        @can('add_agama')
        <div class="row">
            <div class="col-md d-flex justify-content-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah-agama"
                    style="height: fit-content;">
                    Tambah Agama
                </button>
            </div>
        </div>
        @endcan
    </div>
    <div class="table-responsive p-3">
        <table class="table text-center">
            <thead>
                <tr>
                    <th scope="col" class="text-center">No</th>
                    <th scope="col" class="text-center">Nama</th>
                    @can('edit_agama', 'hapus_agama')
                    <th scope="col" class="text-center">Options</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach ($agamas as $agama)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $agama->nama }}</td>
                        <td>
                            <a href="{{ route('agama.edit', [$agama->id]) }}" class="btn btn-warning">Edit</a>
                            @if (auth()->user()->can('delete_agama'))
                            <button type="submit" class="btn btn-sm btn-danger font-weight-bold"
                                onclick="deleteData('{{ route('agama.destroy', [$agama->id]) }}')" style="width: 5rem; margin: 0.1rem">Hapus</button>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
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