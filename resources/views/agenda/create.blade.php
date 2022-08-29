@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Create Jadwal</h4>
        <form action="/agenda" method="POST">
            @csrf
            @include('mypartials.tahunajaran')
            <input type="hidden" name="kelas_id" value="{{ request('idk') }}">
            <div class="mb-3">
                <label for="kompetensi" class="form-label">Guru</label>
                <select class="form-select select-guru @error('user_id') is-invalid @enderror" name="user_id" value="{{ old('user_id') }}">
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
                <select class="form-select select-mapel @error('mapel_id') is-invalid @enderror" name="mapel_id" value="{{ old('mapel_id') }}">
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
                <select class="form-select @error('hari') is-invalid @enderror" name="hari" value="{{ old('hari') }}">
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
                <input type="time" class="form-control @error('jam_awal') is-invalid @enderror" id="jam_awal" name="jam_awal" value="{{ old('jam_awal') }}">
                @error('jam_awal')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="jam_akhir" class="form-label">Jam Akhir</label>
                <input type="time" class="form-control @error('jam_akhir') is-invalid @enderror" id="jam_akhir" name="jam_akhir" value="{{ old('jam_akhir') }}">
                @error('jam_akhir')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="kompetensi" class="form-label">Urutan</label>
                <select class="form-select" name="urutan">
                    @for($i = 1; $i <= 15; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <button type="submit" class="btn text-white" style="background-color: #3bae9c">Simpan</button>
        </form>
    </div>
</div>
@endsection

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