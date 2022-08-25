@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Create Kompetensi</h4>
        <form action="/kompetensi" method="POST">
            @csrf
            <div class="mb-3">
                <label for="kompetensi" class="form-label">nama</label>
                <input type="text" class="form-control" id="kompetensi" name="kompetensi">
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>
@endsection