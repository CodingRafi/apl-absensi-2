@extends('mylayouts.main')

@section('container')
    <div class="container-xxl flex-grow-1 container-p-y">

            <div class="row">
                <form action="{{ route('roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="col-xl-12">
                        <div class="card mb-4">
                            <h5 class="card-title m-3">Edit Role {{ $role->name }}</h5>
                            <div class="card-body">
                                <div class="mb-3 row">
                                    <div class="col-md-12">
                                        <label for="namaRole" class="form-label">Nama Role</label>
                                        <input class="form-control @error('name') is-invalid @enderror" type="text"
                                            value="{{ isset($data) ? $data->name : old('name') }}" id="namaRole"
                                            placeholder="Name Role" name="name" />
                                        @error('name')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="hak_akses" class="form-label">Hak Akses</label>
                                        <select class="fstdropdown-select @error('hak_akses') is-invalid @enderror" name="hak_akses" id="hak_akses" value="{{ isset($data) ? $data->hak_akses : old('hak_akses') }}" required multiple>
                                            @foreach ($permissions as $permission)
                                            @if (in_array($permission->id, $rolePermissions))
                                            <option value="{{ $permission->id }}" selected>{{ str_replace('_', ' ', $permission->name) }}</option>
                                            @else
                                            <option value="{{ $permission->id }}">{{ str_replace('_', ' ', $permission->name) }}</option>
                                            @endif
                                            @endforeach
                                          </select>
                                          @error('hak_akses')
                                          <div class="invalid-feedback">
                                            {{ $message }}
                                          </div>
                                          @enderror
                                    </div>
                                </div>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button class="btn text-white" type="submit" style="background-color: #3bae9c">Simpan Perubahan</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
        <!-- / Content -->
@endsection
