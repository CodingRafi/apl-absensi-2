<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        @if ( Auth::user()->hasRole('super_admin') )   
        <li class="nav-item">
            <a href="/roles" class="nav-link"><i class="icon-grid menu-icon"></i> Role</a>
        </li>
        @endif
        <li class="nav-item">
            <form action="/" method="get">
                @if (request('tahun_awal'))
                <input type="hidden" name="tahun_awal" value="{{ request('tahun_awal') }}">
                @endif
                @if (request('tahun_akhir'))
                <input type="hidden" name="tahun_akhir" value="{{ request('tahun_akhir') }}">
                @endif
                @if (request('semester'))
                <input type="hidden" name="semester" value="{{ request('semester') }}">
                @endif
                <button class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" style="background-color: #ffffff; border: none; min-width: 200px"><i class="icon-grid menu-icon"></i> Dasboard</button>
            </form>
        </li>
        <li class="nav-item">
            <form action="/kompetensi" method="get">
                @if (request('tahun_awal'))
                <input type="hidden" name="tahun_awal" value="{{ request('tahun_awal') }}">
                @endif
                @if (request('tahun_akhir'))
                <input type="hidden" name="tahun_akhir" value="{{ request('tahun_akhir') }}">
                @endif
                @if (request('semester'))
                <input type="hidden" name="semester" value="{{ request('semester') }}">
                @endif
                <button class="nav-link {{ Request::is('/') ? 'active' : '' }}" style="background-color: #ffffff; border: none; min-width: 200px"><i class="icon-grid menu-icon"></i> Kompetensi</button>
            </form>
        </li>
        @if ( Auth::user()->hasRole('super_admin') )   
        <li class="nav-item">
            <a href="/tahun-ajaran" class="nav-link"><i class="icon-grid menu-icon"></i> Tahun Ajaran</a>
        </li>
        @endif
        <li class="nav-item">
            <form action="/kelas" method="get">
                @if (request('tahun_awal'))
                <input type="hidden" name="tahun_awal" value="{{ request('tahun_awal') }}">
                @endif
                @if (request('tahun_akhir'))
                <input type="hidden" name="tahun_akhir" value="{{ request('tahun_akhir') }}">
                @endif
                @if (request('semester'))
                <input type="hidden" name="semester" value="{{ request('semester') }}">
                @endif
                <button class="nav-link {{ Request::is('/') ? 'active' : '' }}" style="background-color: #ffffff; border: none; min-width: 200px"><i class="icon-grid menu-icon"></i> Kelas</button>
            </form>
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
                        @if ($role->name != 'yayasan' && $role->name != 'admin' && $role->name != 'super_admin')
                        <li class="nav-item">
                            <form action="/users/{{ $role->name }}" method="get">
                                @if (request('tahun_awal'))
                                <input type="hidden" name="tahun_awal" value="{{ request('tahun_awal') }}">
                                @endif
                                @if (request('tahun_akhir'))
                                <input type="hidden" name="tahun_akhir" value="{{ request('tahun_akhir') }}">
                                @endif
                                @if (request('semester'))
                                <input type="hidden" name="semester" value="{{ request('semester') }}">
                                @endif
                                <button class="nav-link {{ Request::is('/') ? 'active' : '' }}" style="background-color: #3bae9c; border: none; min-width: 150px">Data {{ $role->name }}
                                </button>
                            </form>
                        </li>
                        @endif
                    @endforeach
                    <li class="nav-item">
                        <form action="/siswa" method="get">
                            @if (request('tahun_awal'))
                            <input type="hidden" name="tahun_awal" value="{{ request('tahun_awal') }}">
                            @endif
                            @if (request('tahun_akhir'))
                            <input type="hidden" name="tahun_akhir" value="{{ request('tahun_akhir') }}">
                            @endif
                            @if (request('semester'))
                            <input type="hidden" name="semester" value="{{ request('semester') }}">
                            @endif
                            <button class="nav-link {{ Request::is('/') ? 'active' : '' }}" style="background-color: #3bae9c; border: none; min-width: 150px">Data Siswa</button>
                        </form>
                    </li>
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
                    <li class="nav-item">
                        <form action="/absensi-guru" method="get">
                            @if (request('tahun_awal'))
                            <input type="hidden" name="tahun_awal" value="{{ request('tahun_awal') }}">
                            @endif
                            @if (request('tahun_akhir'))
                            <input type="hidden" name="tahun_akhir" value="{{ request('tahun_akhir') }}">
                            @endif
                            @if (request('semester'))
                            <input type="hidden" name="semester" value="{{ request('semester') }}">
                            @endif
                            <button class="nav-link {{ Request::is('/') ? 'active' : '' }}" style="background-color: #3bae9c; border: none; min-width: 150px">Absensi Guru</button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form action="/absensi-siswa" method="get">
                            @if (request('tahun_awal'))
                            <input type="hidden" name="tahun_awal" value="{{ request('tahun_awal') }}">
                            @endif
                            @if (request('tahun_akhir'))
                            <input type="hidden" name="tahun_akhir" value="{{ request('tahun_akhir') }}">
                            @endif
                            @if (request('semester'))
                            <input type="hidden" name="semester" value="{{ request('semester') }}">
                            @endif
                            <button class="nav-link {{ Request::is('/') ? 'active' : '' }}" style="background-color: #3bae9c; border: none; min-width: 150px">Absensi Siswa</button>
                        </form>
                    </li>
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
                    <li class="nav-item">
                        <form action="/agenda-guru" method="get">
                            @if (request('tahun_awal'))
                            <input type="hidden" name="tahun_awal" value="{{ request('tahun_awal') }}">
                            @endif
                            @if (request('tahun_akhir'))
                            <input type="hidden" name="tahun_akhir" value="{{ request('tahun_akhir') }}">
                            @endif
                            @if (request('semester'))
                            <input type="hidden" name="semester" value="{{ request('semester') }}">
                            @endif
                            <button class="nav-link {{ Request::is('/') ? 'active' : '' }}" style="background-color: #3bae9c; border: none; min-width: 150px">Agenda Guru</button>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form action="/agenda-siswa" method="get">
                            @if (request('tahun_awal'))
                            <input type="hidden" name="tahun_awal" value="{{ request('tahun_awal') }}">
                            @endif
                            @if (request('tahun_akhir'))
                            <input type="hidden" name="tahun_akhir" value="{{ request('tahun_akhir') }}">
                            @endif
                            @if (request('semester'))
                            <input type="hidden" name="semester" value="{{ request('semester') }}">
                            @endif
                            <button class="nav-link {{ Request::is('/') ? 'active' : '' }}" style="background-color: #3bae9c; border: none; min-width: 150px">Agenda Siswa</button>
                        </form>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</nav>