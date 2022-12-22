@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Create Kelas</h4>
        @include('kelas.form')
    </div>
</div>
@endsection