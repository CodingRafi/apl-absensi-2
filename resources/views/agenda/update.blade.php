@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Update Jadwal</h4>
        <form action="/agenda/{{ $agenda->id }}" method="POST">
            @csrf
            @method('patch')
            @include('mypartials.tahunajaran')
            <div class="mb-3">
                <label for="kompetensi" class="form-label">Guru</label>
                <select class="form-select select-guru" name="user_id">
                    <option value="">Pilih Guru</option>
                    @foreach ($gurus as $guru)
                    @if ($guru->id == $agenda->user_id)
                    <option value="{{ $guru->id }}" selected>{{ $guru->name }}</option>
                    @else
                    <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3 div-mapel">
                <label for="kompetensi" class="form-label">Mata Pelajaran</label>
                <select class="form-select select-mapel" name="mapel_id">
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
            <div class="mb-3">
                <label for="kompetensi" class="form-label">Hari</label>
                <select class="form-select" name="hari">
                    <option value="senin" {{ ($agenda=='senin' ) ? 'selected' : '' }}>Senin</option>
                    <option value="selasa" {{ ($agenda=='selasa' ) ? 'selected' : '' }}>Selasa</option>
                    <option value="rabu" {{ ($agenda=='rabu' ) ? 'selected' : '' }}>Rabu</option>
                    <option value="kamis" {{ ($agenda=='kamis' ) ? 'selected' : '' }}>Kamis</option>
                    <option value="jumat" {{ ($agenda=='jumat' ) ? 'selected' : '' }}>Jumat</option>
                    <option value="sabtu" {{ ($agenda=='sabtu' ) ? 'selected' : '' }}>Sabtu</option>
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
            <div class="mb-3">
                <label for="kompetensi" class="form-label">Urutan</label>
                <select class="form-select" name="urutan">
                    @for($i = 1; $i <= 15; $i++) 
                    @if ($i == $agenda->urutan)
                    <option value="{{ $i }}" selected>{{ $i }}</option>  
                    @else
                    <option value="{{ $i }}">{{ $i }}</option>
                    @endif
                    @endfor
                </select>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
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