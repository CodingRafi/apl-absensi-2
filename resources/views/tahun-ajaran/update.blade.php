@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Update Tahun Ajaran</h4>
        <form action="{{ route('tahun-ajaran.update', [$tahun_ajaran->id]) }}" method="POST">
            @csrf
            @method('patch')
            <div class="mb-3">
                <label for="tahun_awal" class="form-label">Tahun Awal</label>
                <input type="number" min="1900" max="2099" step="1" class="form-control" id="tahun_awal"
                    name="tahun_awal" value="{{ $tahun_ajaran->tahun_awal, old('tahun_awal') }}">
            </div>
            <div class="mb-3">
                <label for="tahun_akhir" class="form-label">Tahun Akhir</label>
                <input type="number" min="1900" max="2099" step="1" class="form-control" id="tahun_akhir"
                    name="tahun_akhir" value="{{ $tahun_ajaran->tahun_akhir, old('tahun_akhir') }}">
            </div>
            <div class="mb-3">
                <label for="bidang" class="form-label">Semester</label>
                <select class="form-select" name="semester">
                    <option value="ganjil" {{ ($tahun_ajaran->semester == 'ganjil' || old('semester') == 'ganjil') ? 'selected' : '' }}>Ganjil</option>
                    <option value="genap" {{ ($tahun_ajaran->semester == 'genap' || old('semester') == 'genap') ? 'selected' : '' }}>Genap</option>
                </select>
            </div>
            <div class="mb-3 ml-4">
                <input class="form-check-input" type="checkbox" name="status" onclick="isChecked()" {{ $tahun_ajaran->status == 'aktif' ? 'checked' : '' }}>
                <label class="form-label message">Tidak Aktif</label>
            </div>
            <button type="submit" class="btn text-white" style="background-color: #3bae9c">Simpan</button>
        </form>
    </div>
</div>
@endsection

@section('tambahjs')
    <script>

        document.addEventListener('load', isChecked());

        function isChecked(){
            if(document.querySelector('.form-check-input').
            checked){
                document.querySelector('.message').
                textContent = 'Aktif';
            }else{
                document.querySelector('.message').
                textContent = 'Tidak Aktif';
            }
        }


    </script>
@endsection