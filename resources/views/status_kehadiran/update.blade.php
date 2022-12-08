@extends('mylayouts.main')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y mt-4">
        <div class="row">
            <form action="{{ route('jenis-tinggal.update', $ref_jenis_tinggal->id) }}" method="POST">
                @csrf
                @method('patch')
                <div class="col-xl-12">
                    <div class="card mb-4">
                        <h5 class="card-header bg-transparent" style="padding: 1rem 2rem;">Ubah Jenis Tinggal</h5>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ $ref_jenis_tinggal->nama, old('nama') }}">
                                @error('nama')
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
