@extends('mylayouts.main')

@section('tambahancss')
    <style>
        .accordion.accordion-without-arrow .accordion-button::after {
            background-image: url("data:image/svg+xml,%3Csvg width='12' height='12' viewBox='0 0 12 12' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'%3E%3Cdefs%3E%3Cpath id='a' d='m1.532 12 6.182-6-6.182-6L0 1.487 4.65 6 0 10.513z'/%3E%3C/defs%3E%3Cg transform='translate%282.571%29' fill='none' fill-rule='evenodd'%3E%3Cuse fill='%23435971' xlink:href='%23a'/%3E%3Cuse fill-opacity='.1' fill='%23566a7f' xlink:href='%23a'/%3E%3C/g%3E%3C/svg%3E%0A") !important;
        }

    </style>
@endsection

@section('container')

    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="card">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-10">
                            <h5 class="card-header">Users</h5>
                        </div>
                        <div class="col-md-2 d-flex justify-center align-items-center">
                            @can('add_roles')
                                <button type="button" class="btn btn-primary tombol-buat-user" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Create Role
                                </button>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="container" style="height: 65vh;overflow: auto;">
                    <div id="accordionIcon" class="accordion mt-3 accordion-without-arrow">
                        @foreach ($roles as $key => $role)
                            <div class="accordion-item card mb-3">
                                <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionIconOne">
                                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#accordionIcon-{{ $loop->iteration }}"
                                        aria-controls="accordionIcon-{{ $loop->iteration }}">
                                        {{ $loop->iteration }}. Role {{ $role->name }}
                                    </button>
                                </h2>

                                <div id="accordionIcon-{{ $loop->iteration }}" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionIcon">
                                    <div class="accordion-body">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <h5 class="card-header ps-0">Hak akses untuk role {{ $role->name }}</h5>
                                                </div>
                                                <div class="col-md-2">
                                                    @can('edit_roles')
                                                        @if ($role->name == 'admin')
                                                            <a href="{{ route('roles.edit', $role->id) }}"
                                                                class="btn btn-warning disabled">Update</a>
                                                        @else
                                                            <a href="{{ route('roles.edit', $role->id) }}"
                                                                class="btn btn-warning">Update</a>
                                                        @endif
                                                    @endcan
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <p>{{ $rolePermission->name }}</p> --}}
                                        <div class="container-fluid">
                                            <div class="row flex-wrap">
                                                @foreach ($rolePermissions[$key] as $rolePermission)
                                                    <div class="col-md-3 mb-2 mt-2">{{ $rolePermission->name }}</div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>

        </div>
        <!-- / Content -->
        <!-- Modal -->

        @can('add_roles')
            <div class="modalkey modal fade @error('name') show @enderror @error('email') show @enderror @error('password') show @enderror"
                id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                @error('name') style="display: block;background: rgba(69,90,100, .5);" @enderror
                @error('email') style="display: block;background: rgba(69,90,100, .5);" @enderror
                @error('password') style="display: block;background: rgba(69,90,100, .5);" @enderror>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('roles.store') }}" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Create Role</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @csrf
                                <div class="mb-3 row">
                                    <label for="html5-text-input" class="col-md-3 col-form-label">Name Role</label>
                                    <div class="col-md-9">
                                        <input class="form-control @error('name') is-invalid @enderror" type="text"
                                            id="html5-text-input" placeholder="Name Role" name="name"
                                            value="{{ old('name') }}" />
                                        @error('name')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                @foreach ($permissions as $permission)
                                    <div class="form-check mt-3">
                                        <input class="form-check-input" type="checkbox" value="{{ $permission->id }}"
                                            id="{{ $permission->name }}" name="permission[]" />
                                        <label class="form-check-label"
                                            for="{{ $permission->name }}">{{ $permission->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary tombol-close-bawah"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Create Role</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endcan

        <div class="content-backdrop fade"></div>
    </div>
@endsection

@section('tambahanjs')
    <script>
        const modal = document.querySelector('.modalkey');
        const btnClose = document.querySelector('.btn-close');
        const tombolCloseBawah = document.querySelector('.tombol-close-bawah');

        btnClose.addEventListener('click', function() {
            modal.classList.remove('show');
            modal.style.display = 'none';
            modal.style.background = 'none';
        })

        tombolCloseBawah.addEventListener('click', function() {
            modal.classList.remove('show');
            modal.style.display = 'none';
            modal.style.background = 'none';
        })
    </script>
@endsection
