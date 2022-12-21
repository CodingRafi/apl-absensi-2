@extends('mylayouts.main')

@section('container')
<div class="card">
  <div class="card-body">
    <h4 class="card-title float-left">Create Data Siswa</h4>
    <form action="{{ route('users.siswa.index') }}" method="get">
      @include('mypartials.tahunajaran')
      <button class="btn btn-sm btn-danger float-right text-white" type="submit"
        style="border-radius: 5px;font-weight: 500;">Kembali</button>
    </form>
    @include('siswa.form')
  </div>
</div>
@endsection