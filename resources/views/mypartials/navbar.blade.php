<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center" style="width: 15.5rem;">
        <form action="/" method="get">
            @include('mypartials.tahunajaran')
            <button class="navbar-brand brand-logo mr-3" href="/" style="width: 3rem; height: 3rem; border: none; border-radius: 50px; background: none">
                @if ( Auth::user()->sekolah->logo != '/img/tutwuri.png' )    
                    <img src="{{ asset('storage/' . Auth::user()->sekolah->logo) }}" alt="logo" />
                @else
                    <img src="{{ Auth::user()->sekolah->logo }}" alt="logo" />
                @endif
            </button>
        </form>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end" style="width: calc(100% - 250px);">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>
        @if ( Auth::user()->hasRole('admin') )  
            @if (count($tahun_ajarans) > 0)    
            <div class="dropdown">
                <button class="btn dropdown-toggle ml-3" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                    aria-expanded="false" style="border: none">
                    Tahun Ajaran
                </button>
                <ul class="dropdown-menu ml-1" aria-labelledby="dropdownMenuButton1">
                    @foreach ($tahun_ajarans as $tahun_ajaran)
                    <li class="
                    ">
                        <form action="" method="get">
                            <input type="hidden" name="tahun_awal" value="{{ $tahun_ajaran->tahun_awal }}">
                            <input type="hidden" name="tahun_akhir" value="{{ $tahun_ajaran->tahun_akhir }}">
                            <input type="hidden" name="semester" value="{{ $tahun_ajaran->semester }}">
                            <button type="submit" class="dropdown-item">{{ $tahun_ajaran->tahun_awal }}/{{ $tahun_ajaran->tahun_akhir }} Semester {{ $tahun_ajaran->semester }}</button>
                        </form>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
        @endif
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                    <b class="mr-4">{{ Auth::user()->name }}</b>
                    <img src="/template/images/faces/defaultProfile.jpg" alt="profile" />
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
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
