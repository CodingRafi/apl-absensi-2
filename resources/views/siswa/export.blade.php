<table>
    <thead>
        <tr>
            <th align="center">NO</th>
            <th align="center">NISN</th>
            <th align="center">NIPD</th>
            <th align="center">NIK</th>
            <th align="center">RFID</th>
            <th align="center">Status RFID</th>
            <th align="center">Nama Lengkap</th>
            <th align="center">Jenis Kelamin</th>
            <th align="center">Tempat Lahir</th>
            <th align="center">Tanggal Lahir</th>
            <th align="center">Kelas</th>
            <th align="center">Kompetensi</th>
            <th align="center">Agama</th>
            <th align="center">Jalan</th>
            <th align="center">Kelurahan</th>
            <th align="center">Kecamatan</th>
            <th align="center">Kota/Kabupaten</th>
            <th align="center">Provinsi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($siswas as $siswa)
            <tr>
                <td align="center">{{ $loop->iteration }}</td>
                <td align="center">{{ $siswa->nisn }}</td>
                <td align="center">{{ $siswa->nipd }}</td>
                <td align="center">{{ $siswa->nik }}</td>
                <td align="center">{{ $siswa->rfid ? $siswa->rfid->rfid_number : '' }}</td>
                <td align="center">{{ $siswa->rfid ? $siswa->rfid->status : '' }}</td>
                <td align="center">{{ $siswa->name }}</td>
                <td align="center">{{ $siswa->jk == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                <td align="center">{{ $siswa->tempat_lahir }}</td>
                <td align="center">{{ date('d F Y', strtotime($siswa->tanggal_lahir)) }}</td>
                <td align="center">{{ $siswa->kelas }}</td>
                <td align="center">{{ $siswa->kompetensi }}</td>
                <td align="center">{{ $siswa->agama }}</td>
                <td align="center">{{ $siswa->jalan }}</td>
                <td align="center">{{ $siswa->kelurahan }}</td>
                <td align="center">{{ $siswa->kecamatan }}</td>
                <td align="center">{{ $siswa->kota_kab }}</td>
                <td align="center">{{ $siswa->provinsi }}</td>
            </tr>
        @endforeach
    </tbody>
</table>