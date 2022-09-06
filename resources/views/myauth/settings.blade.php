@extends('mylayouts.main')

@section('tambahcss')
    <style>
        @media (min-width: 660px) {
            .card-body{
                display: flex;
            }
        }

        @media (max-width: 660) {
            .kiri{
                margin: auto;
            }
        }

        @media (min-width: 810px) {
            .tengah, .kanan{
                border-left: 2px solid rgb(205, 205, 205);
            }
        }

        @media (max-width: 660px) {
            .btn{
                width: 100%;
            }
        }

    </style>
@endsection

@section('container')
    <div class="card" style=" background-color:#3bae9c; border-radius: 10px; padding: 3vw">
        <div class="card-body p-0">
            <div class="kiri" style="min-width: 20vw; display: flex; justify-content:center">
                @if (Auth::user()->profil != '/img/profil.png')
                <img src="{{ asset('storage/' . Auth::user()->profil) }}" alt="image" style="width: 10rem; height: 10rem; border: 3px solid white; border-radius: 50%; object-fit: cover">
                @else 
                <img src="{{ Auth::user()->profil }}" alt="image" style="width: 10rem; height: 10rem; border: 3px solid grey;border-radius: 50%;">   
                @endif
            </div>
            <div class="tengah" style="min-width: 25vw;">
                <div class="wrap m-3">
                    <div style="margin: 10% auto">
                        <a class="btn" style="width: 20vw; text-align:left; color:white"><i class="bi bi-person-circle"></i> {{ Auth::user()->name }}</a>
                    </div>
                    <div style="margin: 10% auto">
                        <a class="btn" style="width: 20vw; text-align:left; color:white"><i class="bi bi-envelope-paper-fill"></i> {{ Auth::user()->email }}</a>
                    </div>
                </div>
            </div>
            <div class="kanan" style="min-width: 25vw;">
                <div class="wrap m-3">
                    <form action="/edit-profile" method="get">
                        @include('mypartials.tahunajaran')
                        <button type="submit" class="btn" style=" min-width: 10rem; background-color: white; color:#3bae9c; margin: 1%; text-align:center">Edit My Profile</button>
                    </form>
                    <form action="/ubah-password" method="get">
                        @include('mypartials.tahunajaran')
                        <button type="submit" class="btn" style=" min-width: 10rem; background-color: white; color:#3bae9c; margin: 1%; text-align:center">Ubah Password</button>
                    </form>
                    <form action="/" method="get">
                        @include('mypartials.tahunajaran')
                        <button type="submit" class="btn" style=" min-width: 10rem; background-color: red; color:#ffffff; margin: 1%; text-align:center">Back</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection