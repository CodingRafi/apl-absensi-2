<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-3" href="index.html"><img src="/template/images/smkTarunaBhakti.png" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="/template/images/smkTarunaBhakti.png" alt="logo" /></a>
        <div class="brand-logo text-left">
            <p class="m-0 muted">SMK</p>
            TARUNA BHAKTI
        </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
            <li class="nav-item nav-search d-none d-lg-block">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Tahun Ajaran</label>
                    </div>
                    <select class="custom-select ml-4" id="inputGroupSelect01">
                        @foreach ($tahun_ajarans as $tahun)
                        <option selected>{{ $tahun->tahun_awal }}/{{ $tahun->tahun_akhir }} Semester {{ $tahun->semester }}</option>
                        @endforeach
                    </select>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                    <b class="mr-4">{{ Auth::user()->name }}</b>
                    <img src="/template/images/faces/defaultProfile.jpg" alt="profile" />
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item">
                        <i class="ti-settings text-primary"></i>
                        Settings
                    </a>
                    <a class="dropdown-item">
                        <i class="ti-power-off text-primary"></i>
                        Logout
                    </a>
                </div>
            </li>
            <li class="nav-item nav-settings d-none d-lg-flex">
                <a class="nav-link" href="#">
                    <i class="icon-ellipsis"></i>
                </a>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
    </div>
</nav>
