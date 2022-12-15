@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <div style="display: flex; justify-content:space-between">
            <h4 class="card-title m-0">Create Jadwal</h4>
            <form action="{{ route('agenda.show', ['role' => $role, 'id' => $data->id]) }}" method="get">
                @include('mypartials.tahunajaran')
                <button class="btn btn-sm btn-danger font-weight-bold float-right text-white"
                    type="submit">Kembali</button>
            </form>
        </div>

        <form action="{{ route('agenda.store') }}" method="POST">
            @csrf
            @include('mypartials.tahunajaran')
            <input type="hidden" name="role" value="{{ $role }}">
            <input type="hidden" name="id" value="{{ $data->id }}">

            @if ($role == 'siswa')
            <div class="mb-3">
                <label for="guru" class="form-label">Guru</label>
                <select class="form-select select-guru @error('user_id') is-invalid @enderror" name="user_id"
                    value="{{ old('user_id') }}" style=" font-size: 15px; height: 6.5vh;" id="guru">
                    <option value="">Pilih Guru</option>
                    @if ($gurus)
                    @foreach ($gurus as $guru)
                    <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                    @endforeach
                    @endif
                </select>
                @error('user_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3 div-mapel" style="display: none;">
                <label for="mapel" class="form-label">Mata Pelajaran</label>
                <select class="form-select select-mapel @error('mapel_id') is-invalid @enderror" name="mapel_id" style=" font-size: 15px; height: 6.5vh;" id="mapel">
                    <option value="">Pilih Mapel</option>
                </select>
                @error('mapel_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            @endif
            
            @if ($role == 'guru')
            <div class="mb-3 div-mapel">
                <label for="mapel" class="form-label">Mata Pelajaran</label>
                <select class="form-select select-mapel @error('mapel_id') is-invalid @enderror" name="mapel_id" style=" font-size: 15px; height: 6.5vh;" id="mapel">
                    <option value="">Pilih Mapel</option>
                    @foreach ($data->mapel as $mapel)
                    <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
                    @endforeach
                </select>
                @error('mapel_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="kelas" class="form-label">Kelas</label>
                <select class="form-select select-guru @error('kelas_id') is-invalid @enderror" name="kelas_id"
                    value="{{ old('kelas_id') }}" style=" font-size: 15px; height: 6.5vh;" id="kelas">
                    <option value="">Pilih Kelas</option>
                    @if ($classes)
                    @foreach ($classes as $kelas)
                    <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                    @endforeach
                    @endif
                </select>
                @error('kelas_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            @endif

            <div class="mb-3">
                <label for="hari" class="form-label">Hari</label>
                <select class="form-select @error('hari') is-invalid @enderror" name="hari" value="{{ old('hari') }}"
                    style=" font-size: 15px; height: 6.5vh;" id="hari">
                    <option value="">Pilih Hari</option>
                    <option value="senin">Senin</option>
                    <option value="selasa">Selasa</option>
                    <option value="rabu">Rabu</option>
                    <option value="kamis">Kamis</option>
                    <option value="jumat">Jumat</option>
                    <option value="sabtu">Sabtu</option>
                </select>
                @error('hari')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="waktu_pelajaran" class="form-label">Jam Pelajaran</label>
                <select class="form-select select-guru @error('waktu_pelajaran_id') is-invalid @enderror"
                    name="waktu_pelajaran_id" value="{{ old('waktu_pelajaran_id') }}"
                    style=" font-size: 15px; height: 6.5vh;" id="waktu_pelajaran">
                    <option value="">Pilih Jam Pelajaran</option>
                    @if ($jam_pelajarans)
                    @foreach ($jam_pelajarans as $jam)
                    <option value="{{ $jam->id }}">({{ $jam->jam_ke }}) {{ $jam->jam_awal }} - {{ $jam->jam_akhir }}</option>
                    @endforeach
                    @endif
                </select>
                @error('waktu_pelajaran_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            @if ($role != 'siswa' && $role != 'guru')
            <div class="mb-3">
                <label for="other" class="form-label">Kegiatan</label>
                <textarea class="form-control" id="other" rows="3" name="other"></textarea>
            </div>
            @endif

            <button type="submit" class="btn text-white" style="background-color: #3bae9c">Simpan</button>
        </form>

    </div>
</div>
@endsection

@if ($role == 'siswa')
@section('tambahjs')
<script>
    const selectGuru = document.querySelector('.select-guru');
        selectGuru.addEventListener('change', function(e){
            if (e.target.value != '') {
                $.ajax('/get-mapel/' + e.target.value,  
                    {
                        success: function (data, status, xhr) {
                            document.querySelector('.div-mapel').style.display = 'block';
                            const select_mapel = document.querySelector('.select-mapel');
                            select_mapel.innerHTML = '';
        
                            data.forEach(e => {
                                select_mapel.innerHTML += `<option value="${e.id}">${e.nama}</option>`
                            });
                    }
                });
            }else{
                document.querySelector('.div-mapel').style.display = 'none';
            }
        })
</script>
@endsection
@endif