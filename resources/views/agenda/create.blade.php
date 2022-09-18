@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <div style="display: flex; justify-content:space-between">
            <h4 class="card-title m-0">Create Agenda</h4>
            <form action="/agenda/{{ $role }}/{{ request('idk') ?? request('idu') }}" method="get">
                @include('mypartials.tahunajaran')
                <button class="btn btn-sm btn-danger font-weight-bold float-right text-white" type="submit">Kembali</button>
            </form>
        </div>

        @if ($role == 'siswa')
            @if (count($gurus)>0)
                <form action="/agenda" method="POST">
                    @csrf
                    @include('mypartials.tahunajaran')
                    <input type="hidden" name="role" value="{{ $role }}">
                    <input type="hidden" name="kelas_id" value="{{ request('idk') }}">
                    <div class="mb-3">
                        <label for="kompetensi" class="form-label">Guru</label>
                        <select class="form-select select-guru @error('user_id') is-invalid @enderror" name="user_id" value="{{ old('user_id') }}" style=" font-size: 15px; height: 6.5vh;">
                            <option value="">Pilih Guru</option>
                            @foreach ($gurus as $guru)
                            <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>      
                        @enderror
                    </div>
                    <div class="mb-3 div-mapel" style="display: none;">
                        <label for="kompetensi" class="form-label">Mata Pelajaran</label>
                        <select class="form-select select-mapel @error('mapel_id') is-invalid @enderror" name="mapel_id" value="{{ old('mapel_id') }}" style=" font-size: 15px; height: 6.5vh;">
                            <option value="">Pilih Mapel</option>
                            @foreach ($gurus as $guru)
                            <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                            @endforeach
                        </select>
                        @error('mapel_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="kompetensi" class="form-label">Hari</label>
                        <select class="form-select @error('hari') is-invalid @enderror" name="hari" value="{{ old('hari') }}" style=" font-size: 15px; height: 6.5vh;">
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
                        <label for="jam_awal" class="form-label">Jam Awal</label>
                        <input type="time" class="form-control @error('jam_awal') is-invalid @enderror" id="jam_awal" name="jam_awal" value="{{ old('jam_awal') }}" style=" font-size: 15px; height: 6.5vh;">
                        @error('jam_awal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="jam_akhir" class="form-label">Jam Akhir</label>
                        <input type="time" class="form-control @error('jam_akhir') is-invalid @enderror" id="jam_akhir" name="jam_akhir" value="{{ old('jam_akhir') }}" style=" font-size: 15px; height: 6.5vh;">
                        @error('jam_akhir')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn text-white" style="background-color: #3bae9c">Simpan</button>
                </form>
            @else
            <div class="alert alert-success d-flex mt-5" role="alert">
                <div>
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/>
                    </svg>
                </div>
                <div>Data guru belum tersedia, silahkan input data guru pada laman "Data User/ Data Guru".</div>
            </div>
            @endif
        @elseif($role == 'guru')
            @if (count($classes) > 0)
            <form action="/agenda" method="POST">
                @csrf
                @include('mypartials.tahunajaran')
                <input type="hidden" name="role" value="{{ $role }}">
                <input type="hidden" name="user_id" value="{{ request('idu') }}">
                <div class="mb-3 div-mapel">
                    <label for="kompetensi" class="form-label">Mata Pelajaran</label>
                    <select class="form-select select-mapel @error('mapel_id') is-invalid @enderror" name="mapel_id" style=" font-size: 15px; height: 6.5vh;">
                        <option value="">Pilih Mapel</option>
                        @foreach ($user->mapel as $mapel)
                        <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
                        @endforeach
                    </select>
                    @error('mapel_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 div-mapel">
                    <label for="kompetensi" class="form-label">Kelas</label>
                    <select class="form-select select-mapel @error('kelas_id') is-invalid @enderror" name="kelas_id" style=" font-size: 15px; height: 6.5vh;">
                        <option value="">Pilih Kelas</option>
                        @foreach ($classes as $kelas)
                        <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                        @endforeach
                    </select>
                    @error('kelas_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="kompetensi" class="form-label">Hari</label>
                    <select class="form-select @error('hari') is-invalid @enderror" name="hari" value="{{ old('hari') }}" style=" font-size: 15px; height: 6.5vh;">
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
                    <label for="jam_awal" class="form-label">Jam Awal</label>
                    <input type="time" class="form-control @error('jam_awal') is-invalid @enderror" id="jam_awal" name="jam_awal" value="{{ old('jam_awal') }}" style=" font-size: 15px; height: 6.5vh;">
                    @error('jam_awal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="jam_akhir" class="form-label">Jam Akhir</label>
                    <input type="time" class="form-control @error('jam_akhir') is-invalid @enderror" id="jam_akhir" name="jam_akhir" value="{{ old('jam_akhir') }}" style=" font-size: 15px; height: 6.5vh;">
                    @error('jam_akhir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn text-white" style="background-color: #3bae9c">Simpan</button>
            </form>
            @else
            <div class="alert alert-success d-flex mt-5" role="alert">
                <div>
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/>
                    </svg>
                </div>
                <div>Data kelas belum tersedia, silahkan input data kelas pada laman "Kelas".</div>
            </div>   
            @endif
        @else
        <form action="/agenda" method="POST">
            @csrf
            @include('mypartials.tahunajaran')
            <input type="hidden" name="role" value="{{ $role }}">
            <input type="hidden" name="user_id" value="{{ request('idu') }}">
            <div class="mb-3">
                <label for="other" class="form-label">Kegiatan</label>
                <input type="text" class="form-control @error('other') is-invalid @enderror" id="other" name="other" value="{{ old('other') }}" style=" font-size: 15px; height: 6.5vh;">
                @error('other')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="kompetensi" class="form-label">Hari</label>
                <select class="form-select @error('hari') is-invalid @enderror" name="hari" value="{{ old('hari') }}" style=" font-size: 15px; height: 6.5vh;">
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
                <label for="jam_awal" class="form-label">Jam Awal</label>
                <input type="time" class="form-control @error('jam_awal') is-invalid @enderror" id="jam_awal" name="jam_awal" value="{{ old('jam_awal') }}" style=" font-size: 15px; height: 6.5vh;">
                @error('jam_awal')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="jam_akhir" class="form-label">Jam Akhir</label>
                <input type="time" class="form-control @error('jam_akhir') is-invalid @enderror" id="jam_akhir" name="jam_akhir" value="{{ old('jam_akhir') }}" style=" font-size: 15px; height: 6.5vh;">
                @error('jam_akhir')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn text-white" style="background-color: #3bae9c">Simpan</button>
        </form>
        @endif

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