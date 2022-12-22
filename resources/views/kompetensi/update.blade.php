@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Update Kompetensi</h4>
        @include('kompetensi.form')
    </div>
</div>
@endsection