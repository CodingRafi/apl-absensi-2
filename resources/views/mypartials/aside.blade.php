<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('kompetensi') ? 'active' : '' }}" href="/kompetensi">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Kompetensi</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('tahun-ajaran') ? 'active' : '' }}" href="/tahun-ajaran">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Tahun Ajaran</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#data-user" aria-expanded="false"
                aria-controls="data-user">
                <i class="bi bi-journal-text menu-icon"></i>
                <span class="menu-title">Data User</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="data-user">
                <ul class="nav flex-column sub-menu">
                    @foreach ($roles as $role)
                    @if ($role->name != 'yayasan' && $role->name != 'admin_smp' && $role->name != 'admin_smk' &&
                    $role->name != 'guru_piket')
                    <li class="nav-item"><a class="nav-link text-capitalize" href="/users/{{ $role->name }}">Data {{
                            $role->name }}</a></li>
                    @endif
                    @endforeach
                    <li class="nav-item"><a class="nav-link text-capitalize" href="/siswa">Data Siswa</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="bi bi-journal-text menu-icon"></i>
                <span class="menu-title">Absensi</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="absensi-guru">Absensi Guru</a></li>
                    <li class="nav-item"> <a class="nav-link" href="absensi-siswa">Absensi Siswa</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false"
                aria-controls="form-elements">
                <i class="bi bi-calendar-week menu-icon"></i>
                <span class="menu-title">Agenda</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="#">submenu</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">submenu</a></li>
                </ul>
            </div>
        </li>
    </ul>
</nav>