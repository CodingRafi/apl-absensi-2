@extends('mylayouts.main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Status Kehadiran</h1>
</div>

<div class="container">
    <div class="container p-0">
        @can('add_status_kehadiran')
        <div class="row">
            <div class="col-md d-flex justify-content-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah-status_kehadiran"
                    style="height: fit-content;">
                    Tambah Status Kehadiran
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
                    <th scope="col" class="text-center">Color</th>
                    @can('edit_status_kehadiran', 'hapus_status_kehadiran')
                    <th scope="col" class="text-center">Options</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach ($status_kehadirans as $status_kehadiran)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $status_kehadiran->nama }}</td>
                        <td><div style="width: 1rem;height: 1rem;background-color: {{ $status_kehadiran->color }}"></div></td>
                        <td>
                            <a href="{{ route('status-kehadiran.edit', [$status_kehadiran->id]) }}" class="btn btn-warning">Edit</a>
                            <button type="button" class="btn btn-danger" onclick="deleteData('{{ route('status-kehadiran.destroy', [$status_kehadiran->id]) }}')">Hapus</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@can('add_status_kehadiran')
<div class="modal fade" id="tambah-status_kehadiran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('status-kehadiran.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Status Kehadiran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_status_kehadiran" class="form-label">Nama Status Kehadiran</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama_status_kehadiran"
                            name="nama" value="{{ old('nama') }}">
                        @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="color" class="form-label">Color</label>
                        <input type="text" class="form-control @error('color') is-invalid @enderror" id="color"
                            name="color" value="{{ old('color') }}">
                        @error('color')
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
        $('#tambah-status_kehadiran').modal('show');
    })
</script>
@endif
@endpush