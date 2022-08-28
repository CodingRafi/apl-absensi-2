@extends('mylayouts.main')

@section('container')
    <div class="card">
        <div class="card-body d-flex p-0">
            <div class="kiri" style="background-color: #3bae9c; height: 25rem; width: 30rem;">
                <img src="/img/80010067.jpg" alt="image" style="width: 15rem; height: 15rem; margin: 2rem 7rem; border: 3px solid grey">
                <h5 class="text-white text-center">Dwi Nuryanto</h5>
            </div>
            <div class="kanan" style="height: 25rem; width: 30rem; 450px;">
                <div class="wrap m-3">
                    <div class="mb-2">
                        <a class="btn" style="width: 28rem; text-align: left;"><i class="bi bi-person-circle"></i> Ubah Avatar</a>
                        <hr>
                    </div>
                    <div class="mb-2">
                        <a href="" class="btn" style="width: 28rem; text-align: left;" data-toggle="modal"
                        data-target="#ubah-username"><i class="bi bi-pencil-square"></i> Ubah Username</a>
                        <hr>
                    </div>
                    <div class="mb-2">
                        <a href="" class="btn" style="width: 28rem; text-align: left;" data-toggle="modal"
                        data-target="#ubah-email"><i class="bi bi-envelope-open-fill"></i> Ubah Email</a>
                        <hr>
                    </div>
                    <div class="mb-2">
                        <a href="" class="btn" style="width: 28rem; text-align: left;" data-toggle="modal"
                        data-target="#ubah-password"><i class="bi bi-lock-fill"></i> Ubah Password</a>
                        <hr>
                    </div>
                    <button class="btn text-white" style="margin: 1rem 11rem; background-color: #3bae9c">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    {{-- modal username --}}
    <div class="modal fade" id="ubah-username">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Masukan Username Baru</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="bidang" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="bidang" name="nama" required>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn text-white float-right"
                            style="background-color: #3bae9c">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal username --}}
    {{-- modal email --}}
    <div class="modal fade" id="ubah-email">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Masukan Email Baru</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="bidang" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="bidang" name="nama" required>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn text-white float-right"
                            style="background-color: #3bae9c">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal email --}}
    {{-- modal password --}}
    <div class="modal fade" id="ubah-password">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Masukan Password Baru</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="bidang" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="bidang" name="nama" required>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn text-white float-right"
                            style="background-color: #3bae9c">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal password --}}
@endsection