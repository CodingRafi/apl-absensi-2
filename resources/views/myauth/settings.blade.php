@extends('mylayouts.main')

@section('tambahcss')
    <style>
        @media screen and (max-width: 750px) {
            .card-body{
                display: block;
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
                    <form action="/edit-profile" method="get">
                        @include('mypartials.tahunajaran')
                        <button type="submit" class="btn" style=" width: 15vw; background-color: white; color:#3bae9c; margin: 1%; text-align:center">Edit My Profile</button>
                    </form>
                    <form action="/ubah-password" method="get">
                        @include('mypartials.tahunajaran')
                        <button type="submit" class="btn" style=" width: 15vw; background-color: white; color:#3bae9c; margin: 1%; text-align:center">Ubah Password</button>
                    </form>
                    <form action="/" method="get">
                        @include('mypartials.tahunajaran')
                        <button type="submit" class="btn" style=" width: 15vw; background-color: red; color:#ffffff; margin: 1%; text-align:center">Back</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection