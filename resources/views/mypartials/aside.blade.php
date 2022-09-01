{{-- @dd(auth()->user()->getAllPermissions()) --}}

<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">

        <li class="nav-item">
            <form action="/" method="get">
                @include('mypartials.tahunajaran')
                <button class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}"
                    style="background-color: #ffffff; border: none; min-width: 200px"><i class="bi bi-house-fill mr-3"></i> Dasboard</button>
            </form>
        </li>
        @if (auth()->user()->can('show_agenda_guru')) 
        <li class="nav-item">
            <form action="/agenda-guru" method="get">
                @include('mypartials.tahunajaran')
                <button class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}"
                    style="background-color: #ffffff; border: none; min-width: 200px"><i
                        class="bi bi-calendar-week menu-icon"></i> Agenda</button>
            </form>
        </li>
        @endif
        @if (auth()->user()->can('view_roles') || auth()->user()->can('add_roles') || auth()->user()->can('edit_roles')) 
        <li class="nav-item">
            <a href="/roles" class="nav-link"><i class="icon-grid menu-icon"></i> Role</a>
        </li>
        @endif
        @if (auth()->user()->can('view_kompetensi') || auth()->user()->can('add_kompetensi') || auth()->user()->can('edit_kompetensi') || auth()->user()->can('delete_kompetensi')) 
        @if ( Auth::user()->sekolah->tingkat == 'smk' )
        <li class="nav-item">
            <form action="/kompetensi" method="get">
                @include('mypartials.tahunajaran')
                <button class="nav-link {{ Request::is('/') ? 'active' : '' }}"
                    style="background-color: #ffffff; border: none; min-width: 200px"><i
                        class="icon-grid menu-icon"></i> Kompetensi</button>
            </form>
        </li>
        @endif
        @endif
        @if (auth()->user()->can('view_tahun_ajaran') || auth()->user()->can('add_tahun_ajaran') || auth()->user()->can('edit_tahun_ajaran') || auth()->user()->can('delete_tahun_ajaran'))      
        <li class="nav-item">
            <a href="/tahun-ajaran" class="nav-link"><i class="icon-grid menu-icon"></i> Tahun Ajaran</a>
        </li>
        @endif
        @if (auth()->user()->can('view_kelas') || auth()->user()->can('add_kelas') || auth()->user()->can('edit_kelas') || auth()->user()->can('delete_kelas'))
        <li class="nav-item">
            <form action="/kelas" method="get">
                @include('mypartials.tahunajaran')
                <button class="nav-link {{ Request::is('/') ? 'active' : '' }}"
                    style="background-color: #ffffff; border: none; min-width: 200px"><i
                        class="icon-grid menu-icon"></i> Kelas</button>
            </form>
        </li>
        @endif
        @if (auth()->user()->can('view_mapel') || auth()->user()->can('add_mapel') || auth()->user()->can('edit_mapel') || auth()->user()->can('delete_mapel'))
        <li class="nav-item">
            <form action="/mapel" method="get">
                @include('mypartials.tahunajaran')
                <button class="nav-link {{ Request::is('mapel') ? 'active' : '' }}"
                    style="background-color: #ffffff; border: none; min-width: 200px"><i
                        class="icon-grid menu-icon"></i> Mapel</button>
            </form>
        </li>
        @endif

        @if (auth()->user()->can('view_users') || auth()->user()->can('add_users') || auth()->user()->can('edit_users') || auth()->user()->can('delete_users') || auth()->user()->can('import_users') || auth()->user()->can('export_users') || auth()->user()->can('view_siswa') || auth()->user()->can('add_siswa') || auth()->user()->can('edit_siswa') || auth()->user()->can('delete_siswa') || auth()->user()->can('import_siswa') || auth()->user()->can('export_siswa'))
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#data-user" aria-expanded="false"
                aria-controls="data-user">
                <i class="bi bi-journal-text menu-icon"></i>
                <span class="menu-title">Data User</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="data-user">
                <ul class="nav flex-column sub-menu">
                    @if (auth()->user()->can('view_users') || auth()->user()->can('add_users') || auth()->user()->can('edit_users') || auth()->user()->can('delete_users') || auth()->user()->can('import_users') || auth()->user()->can('export_users'))
                    @foreach ($roles as $role)
                    @if ($role->name != 'yayasan' && $role->name != 'admin' && $role->name != 'super_admin')
                    <li class="nav-item">
                        <form action="/users/{{ $role->name }}" method="get">
                            @include('mypartials.tahunajaran')
                            <button class="nav-link {{ Request::is('/') ? 'active' : '' }}"
                                style="background-color: #3bae9c; border: none; min-width: 150px">Data {{
                                str_replace("_", " ", $role->name) }}
                            </button>
                        </form>
                    </li>
                    @endif
                    @endforeach                        
                    @endif

                    @if (auth()->user()->can('view_siswa') || auth()->user()->can('add_siswa') || auth()->user()->can('edit_siswa') || auth()->user()->can('delete_siswa') || auth()->user()->can('import_siswa') || auth()->user()->can('export_siswa'))
                    <li class="nav-item">
                        <form action="/siswa" method="get">
                            @include('mypartials.tahunajaran')
                            <button class="nav-link {{ Request::is('/') ? 'active' : '' }}"
                                style="background-color: #3bae9c; border: none; min-width: 150px">Data Siswa</button>
                        </form>
                    </li>
                    @endif
                </ul>
            </div>
        </li>
        @endif
        @if (auth()->user()->can('view_absensi') || auth()->user()->can('add_absensi') || auth()->user()->can('edit_absensi') || auth()->user()->can('delete_absensi'))    
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="bi bi-journal-text menu-icon"></i>
                <span class="menu-title">Absensi</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    @foreach ($roles as $role)
                    @if ($role->name != 'yayasan' && $role->name != 'admin' && $role->name != 'super_admin')
                    <li class="nav-item">
                        <form action="/absensi/{{ $role->name }}" method="get">
                            @include('mypartials.tahunajaran')
                            <button class="nav-link {{ Request::is('/') ? 'active' : '' }}"
                                style="background-color: #3bae9c; border: none; min-width: 150px">Absensi {{
                                str_replace("_", " ", $role->name) }}
                            </button>
                        </form>
                    </li>
                    @endif
                    @endforeach
                    <li class="nav-item">
                        <form action="/absensi/siswa" method="get">
                            @include('mypartials.tahunajaran')
                            <button class="nav-link {{ Request::is('/') ? 'active' : '' }}"
                                style="background-color: #3bae9c; border: none; min-width: 150px">Absensi Siswa</button>
                        </form>
                    </li>
                </ul>
            </div>
        </li>
        @endif
        @if (auth()->user()->can('view_agenda') || auth()->user()->can('add_agenda') || auth()->user()->can('edit_agenda') || auth()->user()->can('delete_agenda')) 
        <li class="nav-item">
            <form action="/agenda" method="get">
                @include('mypartials.tahunajaran')
                <button class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}"
                    style="background-color: #ffffff; border: none; min-width: 200px"><i
                        class="bi bi-calendar-week menu-icon"></i> Agenda</button>
            </form>
        </li>
        @endif
        @if (auth()->user()->can('view_presensi') || auth()->user()->can('add_presensi') || auth()->user()->can('edit_presensi') || auth()->user()->can('delete_presensi'))
        <li class="nav-item">
            <form action="/presensi-pelajaran" method="get">
                @include('mypartials.tahunajaran')
                <button class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}"
                    style="background-color: #ffffff; border: none; min-width: 200px"><i
                        class="bi bi-calendar-week menu-icon"></i> Presensi Pelajaran</button>
            </form>
        </li>
        @endif
    </ul>
</nav>