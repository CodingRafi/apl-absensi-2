@extends('mylayouts.main')

@section('container')
    <div class="container-xxl flex-grow-1 container-p-y mt-4">
        <div class="row">
            <form action="{{ route('status-kehadiran.update', $statusKehadiran->id) }}" method="POST">
                @csrf
                @method('patch')
                <div class="col-xl-12">
                    <div class="card mb-4">
                        <h5 class="card-header bg-transparent" style="padding: 1rem 2rem;">Ubah Status Kehadiran</h5>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ $statusKehadiran->nama, old('nama') }}">
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="color" class="form-label">color</label>
                                <input type="color" class="form-control @error('color') is-invalid @enderror" id="color" name="color" value="{{ $statusKehadiran->color, old('color') }}">
                                @error('color')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
