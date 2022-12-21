@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Update Jadwal</h4>
        <form action="{{ route('agenda.update', [$agenda->id]) }}" method="POST">
            @csrf
            @method('patch')
            @include('mypartials.tahunajaran')
            <input type="hidden" name="role" value="{{ $role }}">

            @if ($role == 'siswa')
            <div class="mb-3">
                <label for="kompetensi" class="form-label">Guru</label>
                <select class="form-select select-guru" name="user_id" required>
                    <option value="">Pilih Guru</option>
                    @foreach ($gurus as $guru)
                    @if ($guru->id == $agenda->user_id)
                    <option value="{{ $guru->id }}" selected>{{ $guru->name }}</option>
                    @elseif(isset($user_query_mapel))
                    @if ($guru->id == $user_query_mapel->id)
                    <option value="{{ $user_query_mapel->id }}" selected>{{ $user_query_mapel->name }}</option>
                    @else
                    <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                    @endif
                    @else
                    <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            @elseif($role == 'guru')
            <div class="mb-3">
                <label for="kompetensi" class="form-label">Kelas</label>
                <select class="form-select" name="kelas_id" required>
                    <option value="">Pilih Kelas</option>
                    @foreach ($classes as $kelas)
                    @if ($kelas->id == $agenda->kelas_id)
                    <option value="{{ $kelas->id }}" selected>{{ $kelas->nama }}</option>
                    @else
                    <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3 div-mapel">
                <label for="kompetensi" class="form-label">Mata Pelajaran</label>
                <select class="form-select select-mapel" name="mapel_id" required>
                    <option value="">Pilih Mapel</option>
                    @foreach ($agenda->user->mapel as $mapel)
                    @if ($mapel->id == $agenda->mapel_id)
                    <option value="{{ $mapel->id }}" selected>{{ $mapel->nama }}</option>
                    @else
                    <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            @else
            <div class="mb-3">
                <label for="other" class="form-label">Kegiatan</label>
                <textarea class="form-control @error('other') is-invalid @enderror" id="other" rows="3" name="other">{{ $agenda->other, old('other') }}</textarea>
                @error('other')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            @endif
            
            <div class="mb-3">
                <label for="kompetensi" class="form-label">Hari</label>
                <select class="form-select" name="hari">
                    <option value="">Pilih Hari</option>
                    @foreach (config('services.hari.value') as $hari)
                    <option value="{{ $hari }}" {{ $hari == $agenda->hari ? 'selected' : '' }}>{{ $hari }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="waktu_pelajaran" class="form-label">Jam Pelajaran</label>
                <select class="form-select select-guru @error('waktu_pelajaran_id') is-invalid @enderror"
                    name="waktu_pelajaran_id" value="{{ isset($data) ? $data->waktu_pelajaran_id : old('waktu_pelajaran_id') }}"
                    style=" font-size: 15px; height: 6.5vh;" id="waktu_pelajaran">
                    <option value="">Pilih Jam Pelajaran</option>
                    @foreach ($jam_pelajarans as $jam)
                    <option value="{{ $jam->id }}" {{ ($jam->id == $agenda->waktu_pelajaran_id) ? 'selected' : '' }}>({{ $jam->jam_ke }}) {{ $jam->jam_awal }} - {{ $jam->jam_akhir }}
                    </option>
                    @endforeach
                </select>
                @error('waktu_pelajaran_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
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
                                console.log(e)
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