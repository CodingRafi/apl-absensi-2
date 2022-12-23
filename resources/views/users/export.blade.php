<table>
    <thead>
        <tr>
            <th align="center">NO</th>
            <th align="center">Email</th>
            @if ($role == 'siswa')
            <th align="center">NISN</th>
            <th align="center">NIPD</th>
            <th align="center">NIK</th>
            @else
            <th align="center">NIP</th>
            @endif
            <th align="center">Nama Lengkap</th>
            <th align="center">Jenis Kelamin</th>
            <th align="center">Tempat Lahir</th>
            <th align="center">Tanggal Lahir</th>
            @if ($role == 'siswa')
            <th align="center">Kelas</th>
            @if ($role == 'siswa' && Auth::user()->sekolah->tingkat == 'sma' || Auth::user()->sekolah->tingkat == 'smk')
            <th align="center">Kompetensi</th>
            @endif
            @endif
            <th align="center">Agama</th>
            <th align="center">Provinsi</th>
            <th align="center">Kota/Kabupaten</th>
            <th align="center">Kecamatan</th>
            <th align="center">Kelurahan</th>
            <th align="center">Jalan</th>
            <th align="center">RFID</th>
            <th align="center">Status RFID</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td align="center">{{ $loop->iteration }}</td>
            <td align="center">{{ $user->email }}</td>
            @if ($role == 'siswa')
            <td align="center">{{ $user->nisn }}</td>
            <td align="center">{{ $user->nipd }}</td>
            <td align="center">{{ $user->nik }}</td>
            @else
            <th align="center">{{ $user->nip }}</th>
            @endif
            <td align="center">{{ $user->name }}</td>
            <td align="center">{{ $user->jk == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
            <td align="center">{{ $user->tempat_lahir }}</td>
            {{-- <td align="center">{{ date('d F Y', strtotime($user->tanggal_lahir)) }}</td> --}}
            <td align="center">{{ $user->tanggal_lahir }}</td>
            @if ($role == 'siswa')
            <td align="center">{{ $user->kelas }}</td>
            @if ($role == 'siswa' && Auth::user()->sekolah->tingkat == 'sma' || Auth::user()->sekolah->tingkat == 'smk')
            <td align="center">{{ $user->kompetensi }}</td>
            @endif
            @endif
            <td align="center">{{ $user->agama }}</td>
            <td align="center">{{ $user->provinsi }}</td>
            <td align="center">{{ $user->kabupaten }}</td>
            <td align="center">{{ $user->kecamatan }}</td>
            <td align="center">{{ $user->kelurahan }}</td>
            <td align="center">{{ $user->jalan }}</td>
            <td align="center">{{ $user->rfid ? $user->rfid->rfid_number : '' }}</td>
            <td align="center">{{ $user->rfid ? $user->rfid->status : '' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>