@extends('mylayouts.main')

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
                            @can('add_users')
                                <button type="button" class="btn btn-primary tombol-buat-user" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Create User
                                </button>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="table-responsive" style="height: 65vh">
                    <table class="table" style="text-align: center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name User</th>
                                <th>Email User</th>
                                <th>Role</th>
                                @can('edit_users', 'delete_users')
                                <th>Actions</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($users as $user)
                                @if ($user->getRoleNames()[0] != 'admin')
                                    <tr>
                                        <td>{{ $loop->iteration - 1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if (!empty($user->getRoleNames()))
                                                @foreach ($user->getRoleNames() as $v)
                                                    {{ $v }}
                                                @endforeach
                                            @endif
                                        </td>
                                        @can('edit_users', 'delete_users')     
                                        <td>
                                            @can('edit_users')
                                            <a href="{{ route('users.edit', $user->id) }}"
                                                class="btn btn-warning">Update</a>
                                            @endcan
                                            @can('delete_users')    
                                            <form action="{{ route('users.destroy', $user->id) }}" method="post"
                                                class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Delete</button>
                                            </form>
                                            @endcan
                                        </td>
                                        @endcan
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <!-- / Content -->
        @can('add_users')
            <!-- Modal -->
            <div class="modalkey modal fade @error('name') show @enderror @error('email') show @enderror @error('password') show @enderror"
                id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                @error('name') style="display: block;background: rgba(69,90,100, .5);" @enderror
                @error('email') style="display: block;background: rgba(69,90,100, .5);" @enderror
                @error('password') style="display: block;background: rgba(69,90,100, .5);" @enderror>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('users.store') }}" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Create User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @csrf
                                <div class="mb-3 row">
                                    <label for="html5-text-input" class="col-md-3 col-form-label">Name</label>
                                    <div class="col-md-9">
                                        <input class="form-control @error('name') is-invalid @enderror" type="text"
                                            id="html5-text-input" placeholder="Name User" name="name"
                                            value="{{ old('name') }}" />
                                        @error('name')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="html5-email-input" class="col-md-3 col-form-label">Email User</label>
                                    <div class="col-md-9">
                                        <input class="form-control @error('email') is-invalid @enderror" type="email"
                                            placeholder="john@example.com" id="html5-email-input" name="email"
                                            value="{{ old('email') }}" />
                                        @error('email')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="html5-password-input" class="col-md-3 col-form-label">Password</label>
                                    <div class="col-md-9">
                                        <input class="form-control @error('password') is-invalid @enderror" type="password"
                                            placeholder="Password" id="html5-password-input" name="password" />
                                        @error('email')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="exampleDataList" class="col-form-label col-md-3">Role</label>
                                    <div class="col-md-9">

                                        <select name="roles" id="datalistOptions" class="form-select">
                                            @foreach ($roles as $role)
                                                @if ($role !== 'admin')
                                                    <option value="{{ $role }}">{{ $role }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary tombol-close-bawah"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Create User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endcan



        {{-- <div class="content-backdrop fade"></div> --}}
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
