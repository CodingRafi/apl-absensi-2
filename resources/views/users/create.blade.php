@extends('mylayouts.main')

@section('container')
<div class="card">
  <div class="card-body">
    <h4 class="card-title float-left">Create {{ $role }}</h4>
    <form action="{{ route('users.index', [$role]) }}" method="get">
      @include('mypartials.tahunajaran')
      <button class="btn btn-sm btn-danger float-right text-white" type="submit" style="border-radius: 5px;font-weight: 500;">Kembali</button>
    </form>
    @include('users.form')
  </div>
</div>
@endsection