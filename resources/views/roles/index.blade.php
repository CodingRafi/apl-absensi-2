@extends('mylayouts.main')

@section('tambahancss')
<style>
    .accordion.accordion-without-arrow .accordion-button::after {
        background-image: url("data:image/svg+xml,%3Csvg width='12' height='12' viewBox='0 0 12 12' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'%3E%3Cdefs%3E%3Cpath id='a' d='m1.532 12 6.182-6-6.182-6L0 1.487 4.65 6 0 10.513z'/%3E%3C/defs%3E%3Cg transform='translate%282.571%29' fill='none' fill-rule='evenodd'%3E%3Cuse fill='%23435971' xlink:href='%23a'/%3E%3Cuse fill-opacity='.1' fill='%23566a7f' xlink:href='%23a'/%3E%3C/g%3E%3C/svg%3E%0A") !important;
    }
</style>
@endsection

@section('container')
<div class="container-xxl flex-grow-1 container-p-y">

    <div class="card">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-md-10">
                    <h5 class="card-header" style="background-color: white">Users</h5>
                </div>
                <div class="col-md-2 d-flex justify-content-end align-items-center">
                    @can('add_roles')
                    <button type="button" class="btn btn-sm text-white tombol-buat-user"
                        style="background-color: #3bae9c; border-radius: 5px; font-weight: 500;" data-bs-toggle="modal"
                        data-bs-target="#modalRole">
                        Buat Role
                    </button>
                    @endcan
                </div>
            </div>
        </div>
        <div class="container" style="height: 65vh;overflow: auto;">
            <div id="accordionIcon" class="accordion accordion-flush mt-3 accordion-without-arrow">
                @foreach ($roles as $key => $role)
                @if ($role->name != 'super_admin')
                <div class="accordion-item">
                    <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionIconOne">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                            data-bs-target="#accordionIcon-{{ $loop->iteration }}"
                            aria-controls="accordionIcon-{{ $loop->iteration }}" style="text-transform: capitalize;">
                            {{ $loop->iteration - 1 }}. Role {{ $role->name }}
                        </button>
                    </h2>

                    <div id="accordionIcon-{{ $loop->iteration }}" class="accordion-collapse collapse"
                        data-bs-parent="#accordionIcon">
                        <div class="accordion-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-10">
                                        <h5 class="card-title ps-0">Hak akses untuk role {{ $role->name }}</h5>
                                    </div>
                                    <div class="col-md-2">
                                        @can('edit_roles')
                                        @if ($role->name == 'super_admin')
                                        <a href="{{ route('roles.edit', $role->id) }}"
                                            class="btn btn-sm btn-warning float-right disabled"
                                            style="border-radius: 5px; font-weight: 500;">Edit</a>
                                        @else
                                        <a href="{{ route('roles.edit', $role->id) }}"
                                            class="btn btn-sm btn-warning text-white float-right"
                                            style="border-radius: 5px; font-weight: 500;">Edit</a>
                                        @endif
                                        @endcan
                                    </div>
                                </div>
                            </div>
                            {{-- <p>{{ $rolePermission->name }}</p> --}}
                            <div class="container-fluid">
                                <div class="row flex-wrap">
                                    @foreach ($rolePermissions[$key] as $rolePermission)
                                    <div class="col-md-3 mb-2 mt-2" style="text-transform: capitalize;">{{
                                        str_replace("_", " ", $rolePermission->name) }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>

</div>

@can('add_roles')
<div class="modalkey modal fade" id="modalRole" tabindex="-1" aria-labelledby="role" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('roles.store') }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="role">Buat Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="name" class="form-label">Nama Role</label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" id="nama"
                                placeholder="Masukan nama Role" name="name" value="{{ old('name') }}" />
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="permission" class="form-label">Hak Akses</label>
                            <select class="fstdropdown-select @error('permission') is-invalid @enderror"
                                name="permission[]" id="permission" multiple>
                                @foreach ($permissions as $permission)
                                <option value="{{ $permission->id }}">{{ str_replace('_', ' ', $permission->name) }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @error('permission')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn text-white" style="background-color: #3bae9c">Buat Role</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endcan
@endsection

@section('tambahjs')
@if($errors->any())
<script>
    $(document).ready(function(){
        $('#modalRole').modal('show');
    })
</script>
@endif
@endsection