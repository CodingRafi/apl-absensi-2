@extends('mylayouts.main')

@section('tambahcss')
    <style>
        @media (max-width: 400px){
            .tanggal, .bulan, .tahun-ajaran, .create{
                width: 33vw;
            }
        }
    </style>
@endsection

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title float-left">jadwal Guru</h4>
        <ul class="nav float-right mb-4" style="gap: 1rem;">
            <form action="/agenda-create-guru" method="get">
                @include('mypartials.tahunajaran')
                <button class="btn btn-sm text-white font-weight-bold create" style="background-color: #3bae9c; min-width: 7vh">Create
                </button>
            </form>
        </ul>
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-light">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama</th>  
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection