@extends('mylayouts.main')

@section('tambahcss')
    <style>
        @media screen and (min-width: 900px) {
            .tengah{
                border-left: none;
            }
        }
    </style>
@endsection

@section('container')
    <div class="card" style=" background-color:#3bae9c; border-radius: 10px; padding: 3vw">
        <div class="card-body d-flex p-0">
            <div class="kiri" style="width: 20vw; display: flex; justify-content:center">
                <img src="/img/80010067.jpg" alt="image" style="width: 10rem; height: 10rem; border: 3px solid grey">
            </div>
            <div class="tengah" style="width: 25vw; border-left: 2px solid rgb(205, 205, 205)">
                <div class="wrap m-3">
                    <div style="margin: 10% auto">
                        <a class="btn" style="width: 20vw; text-align:left; color:white"><i class="bi bi-person-circle"></i> Dwi Nuryanto</a>
                    </div>
                    <div style="margin: 10% auto">
                        <a class="btn" style="width: 20vw; text-align:left; color:white"><i class="bi bi-envelope-paper-fill"></i> dwinuryanto@gmail.com</a>
                    </div>
                </div>
            </div>
            <div class="kanan" style="width: 25vw; border-left: 2px solid rgb(205, 205, 205)">
                <div class="wrap m-3">
                    <button type="submit" class="btn" style=" width: 15vw; background-color: white; color:#3bae9c; margin: 5%; text-align:center">Edit My Profile</button> <br>
                    <button type="submit" class="btn" style=" width: 15vw; background-color: red; color:#ffffff; margin: 5%; text-align:center">Back</button>
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