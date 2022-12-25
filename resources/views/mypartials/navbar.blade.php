<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <form action="/" method="get">
            @include('mypartials.tahunajaran')
            <button class="navbar-brand brand-logo" href="/" style="width: 3rem; height: 3rem; border: none; border-radius: 50px; background: none">
                @if (Auth::user()->sekolah)
                    @if ( Auth::user()->sekolah->logo != '/img/tutwuri.png' )    
                        <img src="{{ asset('storage/' . Auth::user()->sekolah->logo) }}" alt="logo" />
                    @else
                        <img src="{{ Auth::user()->sekolah->logo }}" alt="logo" />
                    @endif
                @else 
                    <img src="/img/tutwuri.png" alt="logo" />
                @endif
            </button>
        </form>
        <form action="/" method="get">
            @include('mypartials.tahunajaran')
            <button class="navbar-brand brand-logo-mini" href="/" style="border: none; border-radius: 50px; background: none; ">
                @if (Auth::user()->sekolah)
                    @if ( Auth::user()->sekolah->logo != '/img/tutwuri.png' )    
                        <img src="{{ asset('storage/' . Auth::user()->sekolah->logo) }}" alt="logo" style="object-fit: contain;width: 2rem;"/>
                    @else
                        <img src="{{ Auth::user()->sekolah->logo }}" alt="logo" style="object-fit: contain;width: 2rem;"/>
                    @endif
                @else 
                    <img src="/img/tutwuri.png" alt="logo" />
                @endif
            </button>
        </form>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>
        @if ( !Auth::user()->hasRole('super_admin') && !Auth::user()->nisn && !Auth::user()->nipd)  
            @if (count($tahun_ajarans) > 0)    
            <div class="dropdown">
                <button class="btn dropdown-toggle ml-3" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false" style="border: none">
                    <span class="tahun-ajaran-navbar">Tahun Ajaran</span>
                </button>
                <ul class="dropdown-menu ml-1" aria-labelledby="dropdownMenuButton1">
                    @foreach ($tahun_ajarans as $tahun_ajaran)
                    <li>
                        <form action="" method="get">
                            <input type="hidden" name="tahun_awal" value="{{ $tahun_ajaran->tahun_awal }}">
                            <input type="hidden" name="tahun_akhir" value="{{ $tahun_ajaran->tahun_akhir }}">
                            <input type="hidden" name="semester" value="{{ $tahun_ajaran->semester }}">
                            <button type="submit" class="dropdown-item text-dark">{{ $tahun_ajaran->tahun_awal }}/{{ $tahun_ajaran->tahun_akhir }} Semester {{ $tahun_ajaran->semester }}</button>
                        </form>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
        @endif
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <div class="mr-3">
                    <div class="d-flex justify-content-end">
                        <b class="d-block">{{ Auth::user()->name }}</b>
                    </div>
                    <span class="text-white badge text-user d-block" style="background-color:#3bae9ddc; border:1.5px solid #308b7d; font-weight: 600; display:flex;justify-content:center; width:fit-content !important; text-transform: capitalize; float: right"><i class="bi bi-info-circle mr-2"></i><span class="text-user" style="font-size: 12px; margin-top:1px; display: inline-block;">Masuk Sebagai {{ (Auth::user()->getTable() == 'users') ? str_replace("_", " ", Auth::user()->getRoleNames()->first())  : 'Siswa' }}</span>
                    </span>
                </div>
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" id="profileDropdown">
                    @if (Auth::user()->profil != '/img/profil.png')
                    <img src="{{ asset('storage/' . Auth::user()->profil) }}" alt="profile" />
                    @else
                    <img src="/template/images/faces/defaultProfile.jpg" alt="profile" />
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown" id="profil">
                    <form action="/user-settings" method="get">
                        @include('mypartials.tahunajaran')
                        <button class="dropdown-item" tabindex="-1" type="submit"
                            style="border: none; background: none; color: grey;">
                            <i class="bi bi-person-circle"></i>
                        Profile
                        </button>
                    </form>
                    <form action="/logout" method="post">
                        @csrf
                        <button class="dropdown-item text-danger" tabindex="-1" type="submit"
                            style="border: none; background: none; color: grey;">
                            <i class="ti-power-off text-primary"></i>
                        Logout
                        </button>
                    </form>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
    </div>
</nav>
