<style>
  @media (min-width: 992px){
    .sidebar-icon-only .sidebar .nav:not(.sub-menu) .nav-item:hover .nav-link{
      border-radius: 10px 0px 0px 10px;
    }
  }
  ul.nav.flex-column.sub-menu{
    border-radius: 0px 0px 10px 10px;
  }
  .sidebar-icon-only .sidebar .nav .nav-item:hover{
    border-radius: 10px 0px 0px 10px !important;
  }
  .sidebar .nav:not(.sub-menu) > .nav-item > .nav-link {
    border-radius: 10px 10px 0px 0px;
  }
</style>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item" style="transition: none;">
      <form action="{{ route('dashboard') }}" method="get">
        @include('mypartials.tahunajaran')
        <button class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}"
          style="background-color: transparent; border: none; width: 100%;transition: none;">
          <i class="bi bi-columns-gap mr-3"></i>
          <span class="menu-title">Dashboard</span>
        </button>
      </form>
    </li>

    @if (auth()->user()->can('view_sekolah'))
    <li class="nav-item" style="transition: none;">
      <a href="/sekolah" class="nav-link {{ Request::is('sekolah') ? 'active' : '' }}" style="transition: none;">
        <i class="bi bi-building mr-3"></i>
        <span class="menu-title">Sekolah</span>
      </a>
    </li>
    @endif

    @if (auth()->user()->can('view_roles'))
    <li class="nav-item" style="transition: none;">
      <a href="/roles" class="nav-link {{ Request::is('roles') ? 'active' : '' }}" style="transition: none;">
        <i class="bi bi-person-rolodex mr-3"></i>
        <span class="menu-title">Role</span>
      </a>
    </li>
    @endif

    @can('view_kelompok')
    <li class="nav-item" style="transition: none;">
      <form action="/kelompok" method="get">
        @include('mypartials.tahunajaran')
        <button class="nav-link {{ Request::is('kelompok') ? 'active' : '' }}"
          style="background-color: transparent; border: none; width: 100%; transition: none;">
          <i class="bi bi-hourglass-split mr-3"></i>
          <span class="menu-title">Kelompok Jadwal</span>
        </button>
      </form>
    </li>
    @endcan

    @if (auth()->user()->can('view_presensi'))
    <li class="nav-item" style="transition: none;">
      <form action="/presensi-pelajaran" method="get">
        @include('mypartials.tahunajaran')
        <button class="nav-link {{ Request::is('presensi*') ? 'active' : '' }}"
          style="background-color: transparent; border: none;  width: 100%; transition: none;">
          <i class="bi bi-calendar3 mr-3"></i>
          <span class="menu-title">Presensi Pelajaran</span>
        </button>
      </form>
    </li>
    @endif

    @if (auth()->user()->can('view_tahun_ajaran') || auth()->user()->can('view_kompetensi') ||
    auth()->user()->can('view_kelas') || auth()->user()->can('view_mapel') ||
    auth()->user()->can('view_status_kehadiran') || auth()->user()->can('view_agama'))
    <li class="nav-item" style="transition: none;">
      <a class="nav-link {{ Request::is('data-master*') ? 'active' : '' }}" data-toggle="collapse" aria-expanded="false" aria-controls="data-master" style="background-color: transparent; border: none;  width: 100%; transition: none; cursor: pointer;">
        <i class="bi bi-collection-fill mr-4"></i>
        <span class="menu-title">Data Master</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="data-master">
        <ul class="nav flex-column sub-menu">
          @if (auth()->user()->can('view_tahun_ajaran'))
          <li class="nav-item" style="transition: none;">
            <form action="{{ route('tahun-ajaran.index') }}">
              @include('mypartials.tahunajaran')
              <button class="nav-link {{ Request::is('tahun-ajaran') ? 'active' : '' }}"
                style="background-color: #3bae9c; border: none; min-width: 150px;text-transform: capitalize; transition: none;">Tahun
                Ajaran</button>
            </form>
          </li>
          @endif
          @if ((Auth::user()->sekolah) ? Auth::user()->sekolah->tingkat == 'smk' : false &&
          auth()->user()->can('view_kompetensi'))
          <li class="nav-item" style="transition: none;">
            <form action="{{ route('kompetensi.index') }}" method="get">
              @include('mypartials.tahunajaran')
              <button class="nav-link {{ Request::is('kompetensi') ? 'active' : '' }}"
                style="background-color: #3bae9c; border: none; min-width: 150px;text-transform: capitalize; transition: none;">Kompetensi</button>
            </form>
          </li>
          @endif
          @if(auth()->user()->can('view_kelas'))
          <li class="nav-item" style="transition: none;">
            <form action="{{ route('kelas.index') }}" method="get">
              @include('mypartials.tahunajaran')
              <button class="nav-link {{ Request::is('kelas') ? 'active' : '' }}"
                style="background-color: #3bae9c; border: none; min-width: 150px;text-transform: capitalize; transition: none;">Kelas</button>
            </form>
          </li>
          @endif
          @if (auth()->user()->can('view_mapel'))
          <li class="nav-item" style="transition: none;">
            <form action="{{ route('mapel.index') }}" method="get">
              @include('mypartials.tahunajaran')
              <button class="nav-link {{ Request::is('mapel') ? 'active' : '' }}"
                style="background-color: #3bae9c; border: none; min-width: 150px;text-transform: capitalize; transition: none;">Mapel</button>
            </form>
          </li>
          @endif
          @if (auth()->user()->can('view_status_kehadiran'))
          <li class="nav-item" style="transition: none;">
            <form action="{{ route('status-kehadiran.index') }}" method="get">
              @include('mypartials.tahunajaran')
              <button class="nav-link {{ Request::is('status-kehadiran') ? 'active' : '' }}"
                style="background-color: #3bae9c; border: none; min-width: 150px;text-transform: capitalize; transition: none;">Status
                kehadiran</button>
            </form>
          </li>
          @endif
          @if (auth()->user()->can('view_agama'))
          <li class="nav-item" style="transition: none;">
            <form action="{{ route('agama.index') }}" method="get">
              @include('mypartials.tahunajaran')
              <button class="nav-link {{ Request::is('agama') ? 'active' : '' }}"
                style="background-color: #3bae9c; border: none; min-width: 150px;text-transform: capitalize; transition: none;">Agama</button>
            </form>
          </li>
          @endif
          @if (auth()->user()->can('view_waktu_pelajaran'))
          <li class="nav-item" style="transition: none;">
            <form action="{{ route('jam-pelajaran.index') }}" method="get">
              @include('mypartials.tahunajaran')
              <button class="nav-link {{ Request::is('jam-pelajaran') ? 'active' : '' }}"
                style="background-color: #3bae9c; border: none; min-width: 150px;text-transform: capitalize; transition: none;">Jam Pelajaran</button>
            </form>
          </li>
          @endif
        </ul>
      </div>
    </li>
    @endif

    @if (auth()->user()->can('view_users'))
    <li class="nav-item" style="transition: none;">
      <a class="nav-link {{ Request::is('users*') ? 'active' : '' }}{{ Request::is('siswa') ? 'active' : '' }}" data-toggle="collapse" aria-expanded="false" aria-controls="data-user" style="background-color: transparent; border: none;  width: 100%; transition: none; cursor: pointer;">
        <i class="bi bi-people-fill mr-4"></i>
        <span class="menu-title">Data User</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="data-user">
        <ul class="nav flex-column sub-menu">
          @if (auth()->user()->can('view_users'))
          @foreach ($roles as $role)
          @if ($role->name != 'yayasan' && $role->name != 'admin' && $role->name != 'super_admin')
          <li class="nav-item" style="transition: none;">
            <form action="/users/{{ $role->name }}" method="get">
              @include('mypartials.tahunajaran')
              <button class="nav-link"
                style="background-color: #3bae9c; border: none; min-width: 150px;text-transform: capitalize; transition: none;">Data
                {{
                str_replace("_", " ", $role->name) }}
              </button>
            </form>
          </li>
          @endif
          @endforeach
          @endif
        </ul>
      </div>
    </li>
    @endif

    @if (auth()->user()->can('view_agenda'))
    <li class="nav-item" style="transition: none;">
      <a class="nav-link {{ Request::is('agenda*') ? 'active' : '' }}" data-toggle="collapse" aria-expanded="false" aria-controls="data-agenda" style="background-color: transparent; border: none;  width: 100%; transition: none; cursor: pointer;">
        <i class="bi bi-calendar-week mr-4"></i>
        <span class="menu-title">Jadwal</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="data-agenda">
        <ul class="nav flex-column sub-menu">
          @foreach ($roles as $role)
          @if ($role->name != 'yayasan' && $role->name != 'admin' && $role->name != 'super_admin')
          <li class="nav-item" style="transition: none;">
            <form action="/agenda/{{ $role->name }}" method="get">
              @include('mypartials.tahunajaran')
              <button class="nav-link {{ Request::is('/') ? 'active' : '' }}"
                style="background-color: #3bae9c; border: none; border-radius: 10px; min-width: 150px;text-transform: capitalize; transition: none;">Jadwal
                {{
                str_replace("_", " ", $role->name) }}
              </button>
            </form>
          </li>
          @endif
          @endforeach
          <li class="nav-item" style="transition: none;">
            <form action="/agenda/siswa" method="get">
              @include('mypartials.tahunajaran')
              <button class="nav-link"
                style="background-color: #3bae9c; border: none; border-radius: 10px; min-width: 150px; transition: none;">Jadwal
                Siswa
              </button>
            </form>
          </li>
        </ul>
      </div>
    </li>
    @endif

    @if (auth()->user()->can('view_absensi'))
    <li class="nav-item" style="transition: none;">
      <a class="nav-link {{ Request::is('absensi*') ? 'active' : '' }}" data-toggle="collapse" aria-expanded="false" aria-controls="absensi" style="background-color: transparent; border: none;  width: 100%; transition: none; cursor: pointer;">
        <i class="bi bi-journal-check mr-4"></i>
        <span class="menu-title">Absensi</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="absensi">
        <ul class="nav flex-column sub-menu">
          @foreach ($roles as $role)
          @if ($role->name != 'yayasan' && $role->name != 'admin' && $role->name != 'super_admin')
          <li class="nav-item" style="transition: none;">
            <form action="/absensi/{{ $role->name }}" method="get">
              @include('mypartials.tahunajaran')
              <button class="nav-link {{ Request::is('/') ? 'active' : '' }}"
                style="background-color: #3bae9c; border: none; border-radius: 10px; min-width: 150px;text-transform: capitalize; transition: none;">Absensi
                {{
                str_replace("_", " ", $role->name) }}
              </button>
            </form>
          </li>
          @endif
          @endforeach
          <li class="nav-item" style="transition: none;">
            <form action="/absensi/siswa" method="get">
              @include('mypartials.tahunajaran')
              <button class="nav-link {{ Request::is('/absensi*') ? 'active' : '' }}"
                style="background-color: #3bae9c; border: none; border-radius: 10px; min-width: 150px; transition: none;">
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
