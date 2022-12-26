@extends('mylayouts.main')

@section('tambahcss')
    <style>
        @media (min-width: 894px) {
            .card-body{
                display: flex;
            }
        }

        @media (max-width: 660) {
            .kiri{
                margin: auto;
            }
        }

        @media (min-width: 1020px) {
            .tengah, .kanan{
                border-left: 2px solid rgb(205, 205, 205);
            }
        }

        @media (max-width: 894px) {
            .data-profile, .btn{
                width: 100%;
            }
        }

        @media (max-width: 510px) {
            .judul{
                width: 50%;
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
                    <div class="data-profile mb-2" style="background-color: #3bae9c; padding: 10px; box-shadow: 0px 0px 5px grey; border-radius: 5px;">
                        <div class="d-flex justify-content-center" style="min-width: 20vw;">
                            <div>
                                <i class="bi bi-person-circle text-white"></i>
                                <a class="judul" style="min-width: 5vw; text-decoration: none; margin: 10px; color:white">Nama</a>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center" style="min-width: 20vw;">
                            <div>
                                <a class="btn py-0" style="text-align:left; color:white">{{ Auth::user()->name }}</a>
                            </div>
                        </div>
                    </div>
                    @if ( Auth::user()->email )  
                    <div class="data-profile" style="background-color: #3bae9c; padding: 10px; box-shadow: 0px 0px 5px grey; border-radius: 5px;">
                        <div class="d-flex justify-content-center" style="min-width: 20vw;">
                            <div>
                                <i class="bi bi-envelope-paper-fill text-white"></i>
                                <a class="judul" style="text-align:left; min-width: 5vw; text-decoration: none; margin: 10px; color:white">Email</a>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center" style="min-width: 20vw;">
                            <div>
                                <a class="btn" style="text-align:left; color:white">{{ Auth::user()->email }}</a>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if (Auth::user()->getTable() == 'users') 
                        @if (Auth::user()->hasRole('guru') || Auth::user()->hasRole('karyawan'))
                            @if (Auth::user()->nip)
                            <div class="data-profile" style="background-color: #3bae9c; padding: 10px; box-shadow: 0px 0px 5px grey; border-radius: 5px;">
                                <div class="d-flex justify-content-center" style="min-width: 20vw;">
                                    <div>
                                        <i class="bi bi-envelope-paper-fill text-white"></i>
                                        <a class="judul" style="text-align:left; min-width: 5vw; text-decoration: none; margin: 10px; color:white">NIP</a>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center" style="min-width: 20vw;">
                                    <div>
                                        <a class="btn" style="text-align:left; color:white">{{ Auth::user()->nip }}</a>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endif   
                    @else
                        @if ( Auth::user()->nipd )  
                        <div class="data-profile" style="background-color: #3bae9c; padding: 10px; box-shadow: 0px 0px 5px grey; border-radius: 5px;">
                                <div class="d-flex justify-content-center" style="min-width: 20vw;">
                                    <div>
                                        <i class="bi bi-envelope-paper-fill text-white"></i>
                                        <a class="judul" style="text-align:left; min-width: 5vw; text-decoration: none; margin: 10px; color:white">NIPD</a>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center" style="min-width: 20vw;">
                                    <div><a class="btn" style="text-align:left; color:white">{{ Auth::user()->nipd }}</a></div>
                                </div>
                        </div>
                        @endif
                        <div class="data-profile" style="background-color: #3bae9c; padding: 10px; box-shadow: 0px 0px 5px grey; border-radius: 5px;">
                            <div class="d-flex justify-content-center" style="min-width: 20vw;">
                                <div>
                                    <i class="bi bi-door-open text-white"></i>
                                    <a class="judul" style="text-align:left; min-width: 5vw; text-decoration: none; margin: 10px; color:white">Kelas</a>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center" style="min-width: 20vw;">
                                <div>
                                    <a class="btn" style="text-align:left; color:white">{{ Auth::user()->kelas->nama }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="data-profile" style="background-color: #3bae9c; padding: 10px; box-shadow: 0px 0px 5px grey; border-radius: 5px;">
                            <div class="d-flex justify-content-center" style="min-width: 20vw;">
                                <div>
                                    <i class="bi bi-award text-white"></i>
                                    <a class="judul" style="text-align:left; min-width: 5vw; text-decoration: none; margin: 10px; color:white">Jurusan</a>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center" style="min-width: 20vw;">
                                <div>
                                    <a class="btn" style="text-align:left; color:white;">{{ Auth::user()->kompetensi->kompetensi }}</a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="kanan" style="min-width: 25vw;">
                <div class="wrap m-3">
                    <form action="/edit-profile" method="get">
                        @include('mypartials.tahunajaran')
                        <button type="submit" class="btn" style=" min-width: 10rem; background-color: white; color:#3bae9c; margin: 2%; text-align:center">Edit Profil Saya</button>
                    </form>
                    @if ( Auth::user()->email) 
                    <form action="/ubah-password" method="get">
                        @include('mypartials.tahunajaran')
                        <button type="submit" class="btn" style=" min-width: 10rem; background-color: white; color:#3bae9c; margin: 2%; text-align:center">Ubah Password</button>
                    </form>
                    @endif
                    <form action="/dashboard" method="get">
                        @include('mypartials.tahunajaran')
                        <button type="submit" class="btn" style=" min-width: 10rem; background-color: red; color:#ffffff; margin: 2%; text-align:center">Kembali</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection