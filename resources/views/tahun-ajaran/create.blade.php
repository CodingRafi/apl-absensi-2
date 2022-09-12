@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Create Tahun Ajaran</h4>
        <form action="/tahun-ajaran" method="POST">
            @csrf
            <div class="mb-3">
                <label for="tahun_awal" class="form-label">Tahun Awal</label>
                <input type="number" min="1900" max="2099" step="1" value="2021" class="form-control" id="tahun_awal"
                    name="tahun_awal">
            </div>
            <div class="mb-3">
                <label for="tahun_akhir" class="form-label">Tahun Akhir</label>
                <input type="number" min="1900" max="2099" step="1" value="2021" class="form-control" id="tahun_akhir"
                    name="tahun_akhir">
            </div>
            <div class="mb-3">
                <label for="bidang" class="form-label">Semester</label>
                <select class="form-select" name="semester">
                    <option value="ganjil">Ganjil</option>
                    <option value="genap">Genap</option>
                </select>
            </div>
            <div class="mb-3 ml-4">
                <input class="form-check-input" type="checkbox" name="status" onclick="isChecked()">
                <label class="form-label message">Tidak Aktif</label>
            </div>
            <button type="submit" class="btn text-white" style="background-color: #3bae9c">Simpan</button>
        </form>
    </div>
</div>

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

@endsection