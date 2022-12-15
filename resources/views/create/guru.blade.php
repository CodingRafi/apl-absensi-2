@extends('mylayouts.main')

@section('container')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title float-left">Create Data Guru</h4>
            <a href="" class="btn btn-sm btn-danger font-weight-bold float-right text-white">Kembali</a>
            <form class="mt-5">
                <div class="mb-3">
                  <label for="nip" class="form-label">NIP</label>
                  <input type="number" class="form-control @error('nip') is-invalid @enderror" placeholder="Masukan NIP" name="nip" id="nip" value="{{ old('nip') }}">
                  @error('nip')
                  <div class="invalid-feeedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="nama" class="form-label">Nama Lengkap</label>
                  <input type="text" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukan Nama" name="nama" id="nama" value="{{ old('nama') }}">
                  @error('nama')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                  <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" placeholder="Masukan Tempat Lahir" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir') }}">
                  @error('tempat_lahir')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                  <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" placeholder="Masukan Tanggal Lahir" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                  @error('tanggal_lahir')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="agama" class="form-label">Agama</label>
                  <input type="text" class="form-control @error('agama') is-invalid @enderror" placeholder="Masukan Agama" name="agama" id="agama" value="{{ old('agama') }}">
                  @error('agama')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="jk" class="form-label">Jenis Kelamin</label>
                  <select class="form-select @error('jk') is-invalid @enderror" aria-label="Default select example" name="jk" id="jk" value="{{ old('jk') }}">
                    <option selected></option>
                    <option value="1">Laki-laki</option>
                    <option value="2">Perempuan</option>
                  </select>
                  @error('jk')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="mb-3">
                    <label for="alamat">Alamat</label>
                    <div>
                      <textarea class="form-label @error('alamat') is-invalid @enderror" cols="102" rows="10" placeholder="Masukan Alamat" name="alamat" id="alamat">{{ old('alamat') }}</textarea>
                      @error('alamat')
                      {{ $message }}
                      @enderror
                    </div>
                </div>
                <button type="submit" class="btn text-white" style="background-color: #3bae9c">Simpan</button>
              </form>
        </div>
    </div>
@endsection