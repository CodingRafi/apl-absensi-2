<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <form action="{{ route('dashboard') }}" method="get">
            @include('mypartials.tahunajaran')
            <button class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}"
                style="background-color: transparent; border: none; width: 100%;transition: none;">
                <i class="bi bi-columns-gap mr-3"></i> 
                <span class="menu-title">Dashboard</span>
            </button>
        </form>
      </li>

      {{-- @if (auth()->user()->can('view_sekolah'))
        <li class="nav-item">
            <a href="/sekolah" class="nav-link {{ Request::is('sekolah') ? 'active' : '' }}">
                <i class="bi bi-building mr-3"></i>
                <span class="menu-title">Sekolah</span>
            </a>
        </li>
      @endif

      @if (auth()->user()->can('view_roles'))
        <li class="nav-item">
            <a href="/roles" class="nav-link {{ Request::is('roles') ? 'active' : '' }}">
                <i class="bi bi-person-rolodex mr-3"></i>
                <span class="menu-title">Role</span>
            </a>
        </li>
      @endif --}}

      <li class="nav-item">
        <form action="{{ route('jam-pelajaran.index') }}" method="get">
            @include('mypartials.tahunajaran')
            <button class="nav-link {{ Request::is('jam-pelajaran') ? 'active' : '' }}"
                style="background-color: transparent; border: none; width: 100%;transition: none;">
                <i class="bi bi-clock-fill mr-3"></i> 
                <span class="menu-title">Jam Pelajaran</span>
            </button>
        </form>
      </li>

      <li class="nav-item">
        <form action="/kelompok" method="get">
            @include('mypartials.tahunajaran')
            <button class="nav-link {{ Request::is('kelompok') ? 'active' : '' }}"
                style="background-color: transparent; border: none; width: 100%;">
                <i class="bi bi-hourglass-split mr-3"></i> 
                <span class="menu-title">Kelompok Jadwal</span>
            </button>
        </form>
      </li>

      @if (auth()->user()->can('view_presensi'))
      <li class="nav-item">
        <form action="/presensi-pelajaran" method="get">
            @include('mypartials.tahunajaran')
            <button class="nav-link {{ Request::is('presensi*') ? 'active' : '' }}"
                style="background-color: transparent; border: none;  width: 100%;">
                <i class="bi bi-calendar3 mr-3"></i> 
                <span class="menu-title">Presensi Pelajaran</span>
            </button>
        </form>
      </li>
      @endif

      @if (auth()->user()->can('view_users'))
      <li class="nav-item">
        <a class="nav-link {{ Request::is('data-master*') ? 'active' : '' }}" data-toggle="collapse"
            href="#data-master" aria-expanded="false" aria-controls="data-master">
            <i class="bi bi-collection-fill mr-4"></i>
            <span class="menu-title">Data Master</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="data-master">
          <ul class="nav flex-column sub-menu">
            @if (auth()->user()->can('view_tahun_ajaran'))
            <li class="nav-item">
                <form action="{{ route('tahun-ajaran.index') }}">
                    @include('mypartials.tahunajaran')
                    <button class="nav-link {{ Request::is('tahun-ajaran') ? 'active' : '' }}"
                        style="background-color: #3bae9c; border: none; min-width: 150px;text-transform: capitalize;">Tahun Ajaran</button>
                </form>
            </li>
            @endif
            @if ( Auth::user()->sekolah->tingkat == 'smk' && auth()->user()->can('view_kompetensi'))
            <li class="nav-item">
                <form action="{{ route('kompetensi.index') }}" method="get">
                    @include('mypartials.tahunajaran')
                    <button class="nav-link {{ Request::is('kompetensi') ? 'active' : '' }}"
                        style="background-color: #3bae9c; border: none; min-width: 150px;text-transform: capitalize;">Kompetensi</button>
                </form>
            </li>
            @endif
            @if(auth()->user()->can('view_kelas'))
            <li class="nav-item">
                <form action="{{ route('kelas.index') }}" method="get">
                    @include('mypartials.tahunajaran')
                    <button class="nav-link {{ Request::is('kelas') ? 'active' : '' }}"
                        style="background-color: #3bae9c; border: none; min-width: 150px;text-transform: capitalize;">Kelas</button>
                </form>
            </li>
            @endif
            @if (auth()->user()->can('view_mapel'))
            <li class="nav-item">
                <form action="{{ route('mapel.index') }}" method="get">
                    @include('mypartials.tahunajaran')
                    <button class="nav-link {{ Request::is('mapel') ? 'active' : '' }}"
                        style="background-color: #3bae9c; border: none; min-width: 150px;text-transform: capitalize;">Mapel</button>
                </form>
            </li>
            @endif
          </ul>
        </div>
      </li>
      @endif

      @if (auth()->user()->can('view_users'))
      <li class="nav-item">
        <a class="nav-link {{ Request::is('users*') ? 'active' : '' }}{{ Request::is('siswa') ? 'active' : '' }}" data-toggle="collapse" href="#data-user" aria-expanded="false" aria-controls="data-user">
            <i class="bi bi-people-fill mr-4"></i>
            <span class="menu-title">Data User</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="data-user">
          <ul class="nav flex-column sub-menu">
            @if (auth()->user()->can('view_users'))
            @foreach ($roles as $role)
            @if ($role->name != 'yayasan' && $role->name != 'admin' && $role->name != 'super_admin')
            <li class="nav-item">
                <form action="/users/{{ $role->name }}" method="get">
                    @include('mypartials.tahunajaran')
                    <button class="nav-link"
                        style="background-color: #3bae9c; border: none; min-width: 150px;text-transform: capitalize;">Data
                        {{
                        str_replace("_", " ", $role->name) }}
                    </button>
                </form>
            </li>
            @endif
            @endforeach
            @endif
            @if (auth()->user()->can('view_siswa'))
            <li class="nav-item">
                <form action="/siswa" method="get">
                    @include('mypartials.tahunajaran')
                    <button class="nav-link {{ Request::is('siswa.*') ? 'active' : '' }}"
                        style="background-color: #3bae9c; border: none; min-width: 150px">Data Siswa</button>
                </form>
            </li>
            @endif
          </ul>
        </div>
      </li>
      @endif

      @if (auth()->user()->can('view_agenda'))
      <li class="nav-item">
        <a class="nav-link {{ Request::is('agenda*') ? 'active' : '' }}" data-toggle="collapse" href="#data-agenda"
                aria-expanded="false" aria-controls="data-agenda">
            <i class="bi bi-calendar-week mr-4"></i>
            <span class="menu-title">Jadwal</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="data-agenda">
          <ul class="nav flex-column sub-menu">
            @foreach ($roles as $role)
            @if ($role->name != 'yayasan' && $role->name != 'admin' && $role->name != 'super_admin')
            <li class="nav-item">
                <form action="/agenda/{{ $role->name }}" method="get">
                    @include('mypartials.tahunajaran')
                    <button class="nav-link {{ Request::is('/') ? 'active' : '' }}"
                        style="background-color: #3bae9c; border: none; border-radius: 10px; min-width: 150px;text-transform: capitalize;">Jadwal
                        {{
                        str_replace("_", " ", $role->name) }}
                    </button>
                </form>
            </li>
            @endif
            @endforeach
            <li class="nav-item">
                <form action="/agenda/siswa" method="get">
                    @include('mypartials.tahunajaran')
                    <button class="nav-link"
                        style="background-color: #3bae9c; border: none; border-radius: 10px; min-width: 150px">Jadwal
                        Siswa
                    </button>
                </form>
            </li>
          </ul>
        </div>
      </li>
      @endif

      @if (auth()->user()->can('view_absensi'))
      <li class="nav-item">
        <a class="nav-link {{ Request::is('absensi*') ? 'active' : '' }}" data-toggle="collapse" href="#absensi"
            aria-expanded="false" aria-controls="absensi">
            <i class="bi bi-journal-check mr-4"></i>
            <span class="menu-title">Absensi</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="absensi">
          <ul class="nav flex-column sub-menu">
            @foreach ($roles as $role)
            @if ($role->name != 'yayasan' && $role->name != 'admin' && $role->name != 'super_admin')
            <li class="nav-item">
                <form action="/absensi/{{ $role->name }}" method="get">
                    @include('mypartials.tahunajaran')
                    <button class="nav-link {{ Request::is('/') ? 'active' : '' }}"
                        style="background-color: #3bae9c; border: none; border-radius: 10px; min-width: 150px;text-transform: capitalize;">Absensi
                        {{
                        str_replace("_", " ", $role->name) }}
                    </button>
                </form>
            </li>
            @endif
            @endforeach
            <li class="nav-item">
                <form action="/absensi/siswa" method="get">
                    @include('mypartials.tahunajaran')
                    <button class="nav-link {{ Request::is('/absensi*') ? 'active' : '' }}"
                        style="background-color: #3bae9c; border: none; border-radius: 10px; min-width: 150px">
                        Absensi Siswa
                    </button>
                </form>
            </li>
          </ul>
        </div>
      </li>
      @endif
    </ul>
  </nav>