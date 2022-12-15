@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        @can('add_status_kehadiran')
        <div class="title d-flex justify-content-between">
            <h4 class="card-title">Status Kehadiran</h4>
            <button type="button" class="btn btn-sm text-white float-right" data-bs-toggle="modal" data-bs-target="#tambah-status_kehadiran"
                style="height: fit-content; background-color: #3bae9c;border-radius: 5px;font-weight: 500;">
                Tambah Status Kehadiran
            </button>
        </div>
        @endcan
    </div>
    <div class="table table-responsive table-hover text-center">
        <table class="table align-middle">
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
                        <td><div style="margin:auto;width: 1rem;height: 1rem;background-color: {{ $status_kehadiran->color }}"></div></td>
                        <td>
                            <a href="{{ route('status-kehadiran.edit', [$status_kehadiran->id]) }}" class="btn btn-warning btn-sm" style="border-radius: 5px;font-weight: 500;">Edit</a>
                            @if (auth()->user()->can('delete_status_kehadiran'))
                            <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 5px;font-weight: 500;"
                                onclick="deleteData('{{ route('status-kehadiran.destroy', [$status_kehadiran->id]) }}')">Hapus</button>
                            @endif
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
                        <input type="color" class="form-control @error('color') is-invalid @enderror" id="color"
                            name="color" value="{{ old('color') }}">
                        @error('color')
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
        $('#tambah-status_kehadiran').modal('show');
    })
</script>
@endif
@endpush