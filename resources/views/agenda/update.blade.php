@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Update Jadwal</h4>
        <form action="/agenda/{{ $agenda->id }}" method="POST">
            @csrf
            @method('patch')
            <input type="hidden" name="role" value="{{ $role }}">
            @include('mypartials.tahunajaran')
            @if ($role == 'siswa' || $role == 'guru')    
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
                @else
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
                @endif
                @if (isset($user_query_mapel))    
                <div class="mb-3 div-mapel">
                    <label for="kompetensi" class="form-label">Mata Pelajaran</label>
                    <select class="form-select select-mapel" name="mapel_id" required>
                        <option value="">Pilih Mapel</option>
                        @foreach ($user_query_mapel->mapel as $mapel)
                            @if ($mapel->id == $agenda->mapel_id)
                            <option value="{{ $mapel->id }}" selected>{{ $mapel->nama }}</option>
                            @else
                            <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>   
                @else
                    @if ($agenda->user_id)
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
                    <div class="mb-3 div-mapel" style="display: none;">
                        <label for="kompetensi" class="form-label">Mata Pelajaran</label>
                        <select class="form-select select-mapel @error('mapel_id') is-invalid @enderror" name="mapel_id" value="{{ old('mapel_id') }}" style=" font-size: 15px; height: 6.5vh;">
                            <option value="">Pilih Mapel</option>
                        </select>
                        @error('mapel_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    @endif
                @endif
            @else
                <div class="mb-3">  
                    <label for="other" class="form-label">Kegiatan</label>
                    <input type="text" class="form-control @error('other') is-invalid @enderror" id="other" name="other" value="{{ $agenda->other, old('other') }}" style=" font-size: 15px; height: 6.5vh;" required>
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
                    <option value="senin" {{ ($agenda->hari =='senin' ) ? 'selected' : '' }}>Senin</option>
                    <option value="selasa" {{ ($agenda->hari =='selasa' ) ? 'selected' : '' }}>Selasa</option>
                    <option value="rabu" {{ ($agenda->hari =='rabu' ) ? 'selected' : '' }}>Rabu</option>
                    <option value="kamis" {{ ($agenda->hari =='kamis' ) ? 'selected' : '' }}>Kamis</option>
                    <option value="jumat" {{ ($agenda->hari =='jumat' ) ? 'selected' : '' }}>Jumat</option>
                    <option value="sabtu" {{ ($agenda->hari =='sabtu' ) ? 'selected' : '' }}>Sabtu</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="jam_awal" class="form-label">Jam Awal</label>
                <input type="time" class="form-control" id="jam_awal" name="jam_awal" value="{{ $agenda->jam_awal }}">
            </div>
            <div class="mb-3">
                <label for="jam_akhir" class="form-label">Jam Akhir</label>
                <input type="time" class="form-control" id="jam_akhir" name="jam_akhir"
                    value="{{ $agenda->jam_akhir }}">
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
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