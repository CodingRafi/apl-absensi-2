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
                <select class="form-select select-guru" name="user_id">
                    <option value="">Pilih Guru</option>
                    @foreach ($gurus as $guru)
                    <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 div-mapel" style="display: none;">
                <label for="kompetensi" class="form-label">Mata Pelajaran</label>
                <select class="form-select select-mapel" name="mapel_id">
                    <option value="">Pilih Mapel</option>
                    @foreach ($gurus as $guru)
                    <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="kompetensi" class="form-label">Hari</label>
                <select class="form-select" name="hari">
                    <option value="senin">Senin</option>
                    <option value="selasa">Selasa</option>
                    <option value="rabu">Rabu</option>
                    <option value="kamis">Kamis</option>
                    <option value="jumat">Jumat</option>
                    <option value="sabtu">Sabtu</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="jam_awal" class="form-label">Jam Awal</label>
                <input type="time" class="form-control" id="jam_awal" name="jam_awal">
            </div>
            <div class="mb-3">
                <label for="jam_akhir" class="form-label">Jam Akhir</label>
                <input type="time" class="form-control" id="jam_akhir" name="jam_akhir">
            </div>
            <div class="mb-3">
                <label for="kompetensi" class="form-label">Urutan</label>
                <select class="form-select" name="urutan">
                    @for($i = 1; $i <= 15; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
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