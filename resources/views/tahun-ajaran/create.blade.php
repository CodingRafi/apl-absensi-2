@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Create Tahun Ajaran</h4>
        <form action="{{ route('tahun-ajaran.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="tahun_awal" class="form-label">Tahun Awal</label>
                <input type="number" min="1900" max="2099" step="1" value="{{ date('Y', strtotime(now())) }}" class="form-control @error('tahun_awal') is-invalid @enderror" id="tahun_awal"
                    name="tahun_awal">
                @error('tahun_awal')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tahun_akhir" class="form-label">Tahun Akhir</label>
                <input type="number" min="1900" max="2099" step="1" value="{{ date('Y', strtotime(now())) + 1}}" class="form-control @error('tahun_akhir') is-invalid @enderror" id="tahun_akhir"
                    name="tahun_akhir">
                @error('tahun_akhir')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="semester" class="form-label">Semester</label>
                <select class="form-select @error('semester') is-invalid @enderror" name="semester" id="semester">
                    <option value="ganjil">Ganjil</option>
                    <option value="genap">Genap</option>
                </select>
                @error('semester')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3 ml-4">
                <input class="form-check-input" type="checkbox" name="status" onclick="isChecked()">
                <label class="form-label message">Tidak Aktif</label>
            </div>
            <button type="submit" class="btn text-white" style="background-color: #3bae9c">Simpan</button>
        </form>
    </div>
</div>
@endsection

@section('tambahjs')
    <script>

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