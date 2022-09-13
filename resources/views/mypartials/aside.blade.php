{{-- @dd(auth()->user()->getAllPermissions()) --}}

<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav" style="width: 85%;">

        <li class="nav-item" style="border-radius: 10px">
            <form action="/" method="get">
                @include('mypartials.tahunajaran')
                <button class="nav-link {{ Request::is('/') ? 'active' : '' }}"
                    style="background-color: transparent; border: none; border-radius: 10px; width: 100%;"><i class="bi bi-columns-gap mr-3"></i> <span>Dasboard</span></button>
            </form>
        </li>
        @if (auth()->user()->can('show_agenda_guru')) 
        <li class="nav-item" style="border-radius: 10px">
            <form action="/agenda-guru" method="get">
                @include('mypartials.tahunajaran')
                <button class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}"
                    style="background-color: transparent; border: none; border-radius: 10px; width: 100%;"><i
                        class="bi bi-calendar-week menu-icon"></i> Agenda</button>
            </form>
        </li>
        @endif
        @if (auth()->user()->can('view_roles') || auth()->user()->can('add_roles') || auth()->user()->can('edit_roles')) 
        <li class="nav-item" style="border-radius: 10px">
            <a href="/roles" class="nav-link {{ Request::is('roles') ? 'active' : '' }}" style=" border-radius: 10px;"><i class="bi bi-person-rolodex mr-3"></i> <span>Role</span></a>
        </li>
        @endif
        @if (auth()->user()->can('view_sekolah') || auth()->user()->can('delete_sekolah')) 
        <li class="nav-item" style="border-radius: 10px">
            <a href="/sekolah" class="nav-link {{ Request::is('sekolah') ? 'active' : '' }}" style=" border-radius: 10px;"><i class="bi bi-building mr-3"></i> <span>Sekolah</span></a>
        </li>
        @endif
        @if (auth()->user()->can('view_kompetensi') || auth()->user()->can('add_kompetensi') || auth()->user()->can('edit_kompetensi') || auth()->user()->can('delete_kompetensi')) 
        @if ( Auth::user()->sekolah->tingkat == 'smk' )
        <li class="nav-item" style="border-radius: 10px">
            <form action="/kompetensi" method="get">
                @include('mypartials.tahunajaran')
                <button class="nav-link {{ Request::is('kompetensi') ? 'active' : '' }}"
                    style="background-color: transparent; border: none; border-radius: 10px; width: 100%;"><i class="bi bi-award mr-3"></i> <span>Kompetensi</span></button>
            </form>
        </li>
        @endif
        @endif
        @if (auth()->user()->can('view_tahun_ajaran') || auth()->user()->can('add_tahun_ajaran') || auth()->user()->can('edit_tahun_ajaran') || auth()->user()->can('delete_tahun_ajaran'))      
        <li class="nav-item" style="border-radius: 10px">
            <a href="/tahun-ajaran" class="nav-link {{ Request::is('tahun-ajaran') ? 'active' : '' }}" style=" border-radius: 10px;"><i class="bi bi-calendar-date mr-3"></i> <span>Tahun Ajaran</span></a>
        </li>
        @endif
        @if (auth()->user()->can('view_kelas') || auth()->user()->can('add_kelas') || auth()->user()->can('edit_kelas') || auth()->user()->can('delete_kelas'))
        <li class="nav-item" style="border-radius: 10px">
            <form action="/kelas" method="get">
                @include('mypartials.tahunajaran')
                <button class="nav-link {{ Request::is('kelas') ? 'active' : '' }}"
                    style="background-color: transparent; border: none; border-radius: 10px; width: 100%;"><i class="bi bi-door-open mr-3"></i> <span>Kelas</span></button>
            </form>
        </li>
        @endif
        @if (auth()->user()->can('view_mapel') || auth()->user()->can('add_mapel') || auth()->user()->can('edit_mapel') || auth()->user()->can('delete_mapel'))
        <li class="nav-item" style="border-radius: 10px">
            <form action="/mapel" method="get">
                @include('mypartials.tahunajaran')
                <button class="nav-link {{ Request::is('mapel') ? 'active' : '' }}"
                    style="background-color: transparent; border: none; border-radius: 10px; width: 100%;"><i class="bi bi-book-half mr-3"></i> <span>Mapel</span></button>
            </form>
        </li>
        @endif

        @if (auth()->user()->can('view_users') || auth()->user()->can('add_users') || auth()->user()->can('edit_users') || auth()->user()->can('delete_users') || auth()->user()->can('import_users') || auth()->user()->can('export_users') || auth()->user()->can('view_siswa') || auth()->user()->can('add_siswa') || auth()->user()->can('edit_siswa') || auth()->user()->can('delete_siswa') || auth()->user()->can('import_siswa') || auth()->user()->can('export_siswa'))
        <li class="nav-item" style="border-radius: 10px">
            <a class="nav-link {{ Request::is('users*') ? 'active' : '' }}" data-toggle="collapse" href="#data-user" aria-expanded="false"
                aria-controls="data-user" style=" border-radius: 10px;">
                <i class="bi bi-person-lines-fill mr-3"></i>
                <span class="menu-title">Data User</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="data-user">
                <ul class="nav flex-column sub-menu">
                    @if (auth()->user()->can('view_users') || auth()->user()->can('add_users') || auth()->user()->can('edit_users') || auth()->user()->can('delete_users') || auth()->user()->can('import_users') || auth()->user()->can('export_users'))
                    @foreach ($roles as $role)
                    @if ($role->name != 'yayasan' && $role->name != 'admin' && $role->name != 'super_admin')
                    <li class="nav-item" style="border-radius: 10px">
                        <form action="/users/{{ $role->name }}" method="get">
                            @include('mypartials.tahunajaran')
                            <button class="nav-link"
                                style="background-color: #3bae9c; border: none; min-width: 150px;text-transform: capitalize;">Data {{
                                str_replace("_", " ", $role->name) }}
                            </button>
                        </form>
                    </li>
                    @endif
                    @endforeach                        
                    @endif

                    @if (auth()->user()->can('view_siswa') || auth()->user()->can('add_siswa') || auth()->user()->can('edit_siswa') || auth()->user()->can('delete_siswa') || auth()->user()->can('import_siswa') || auth()->user()->can('export_siswa'))
                    <li class="nav-item" style="border-radius: 10px">
                        <form action="/siswa" method="get">
                            @include('mypartials.tahunajaran')
                            <button class="nav-link {{ Request::is('siswa') ? 'active' : '' }}"
                                style="background-color: #3bae9c; border: none; min-width: 150px">Data Siswa</button>
                        </form>
                    </li>
                    @endif
                </ul>
            </div>
        </li>
        @endif
        @if (auth()->user()->can('view_absensi') || auth()->user()->can('add_absensi') || auth()->user()->can('edit_absensi') || auth()->user()->can('delete_absensi'))    
        <li class="nav-item" style="border-radius: 10px">
            <a class="nav-link {{ Request::is('absensi*') ? 'active' : '' }}" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic" style=" border-radius: 10px;">
                <i class="bi bi-journal-check mr-3"></i>
                <span class="menu-title">Absensi</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    @foreach ($roles as $role)
                    @if ($role->name != 'yayasan' && $role->name != 'admin' && $role->name != 'super_admin')
                    <li class="nav-item" style="border-radius: 10px">
                        <form action="/absensi/{{ $role->name }}" method="get">
                            @include('mypartials.tahunajaran')
                            <button class="nav-link {{ Request::is('/') ? 'active' : '' }}"
                                style="background-color: #3bae9c; border: none; border-radius: 10px; min-width: 150px">Absensi {{
                                str_replace("_", " ", $role->name) }}
                            </button>
                        </form>
                    </li>
                    @endif
                    @endforeach
                    <li class="nav-item" style="border-radius: 10px">
                        <form action="/absensi/siswa" method="get">
                            @include('mypartials.tahunajaran')
                            <button class="nav-link {{ Request::is('/') ? 'active' : '' }}"
                                style="background-color: #3bae9c; border: none; border-radius: 10px; min-width: 150px">Absensi Siswa</button>
                        </form>
                    </li>
                </ul>
            </div>
        </li>
        @endif
        @if (auth()->user()->can('view_agenda') || auth()->user()->can('add_agenda') || auth()->user()->can('edit_agenda') || auth()->user()->can('delete_agenda')) 
        <li class="nav-item" style="border-radius: 10px">
            <form action="/agenda" method="get">
                @include('mypartials.tahunajaran')
                <button class="nav-link {{ Request::is('agenda') ? 'active' : '' }}"
                    style="background-color: transparent; border: none; border-radius: 10px; width: 100%;"><i class="bi bi-calendar-week mr-3"></i> <span>Agenda</span></button>
            </form>
        </li>
        @endif
        @if (auth()->user()->can('view_presensi') || auth()->user()->can('add_presensi') || auth()->user()->can('edit_presensi') || auth()->user()->can('delete_presensi'))
        <li class="nav-item" style="border-radius: 10px">
            <form action="/presensi-pelajaran" method="get">
                @include('mypartials.tahunajaran')
                <button class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}"
                    style="background-color: transparent; border: none;  width: 100%;">
                    <i class="bi bi-calendar-week menu-icon"></i> Presensi Pelajaran</button>
            </form>
        </li>
        @endif
        <li class="nav-item" style="border-radius: 10px">
            <form action="/tenggat" method="get">
                @include('mypartials.tahunajaran')
                <button class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}"
                    style="background-color: transparent; border: none; width: 100%;"><i class="bi bi-clock-history menu-icon"></i> <span>Waktu Presensi</span></button>
            </form>
        </li>
    </ul>
</nav>