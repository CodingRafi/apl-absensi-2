<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-3" href="index.html"><img src="/template/images/smkTarunaBhakti.png"
                alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="/template/images/smkTarunaBhakti.png"
                alt="logo" /></a>
        <div class="brand-logo text-left">
            <p class="m-0 muted">SMK</p>
            TARUNA BHAKTI
        </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>
        <div class="dropdown">
            <button class="btn dropdown-toggle ml-3" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="border: none">
              Tahun Ajaran
            </button>
            <ul class="dropdown-menu ml-1" aria-labelledby="dropdownMenuButton1">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
            </ul>
          </div>
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