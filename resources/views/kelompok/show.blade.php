@extends('mylayouts.main')

@section('container')
{{-- @dd($user) --}}
<div class="card">
    <div class="card-body">
        <form action="{{ route('kelompok.index') }}" method="get">
            @include('mypartials.tahunajaran')
            <button class="btn btn-sm btn-danger float-right text-white" type="submit"
                style="border-radius: 5px;font-weight: 500;">Kembali</button>
        </form>
        <form action="{{ route('kelompok-jadwal.create', [$kelompok->id]) }}" method="get">
            @include('mypartials.tahunajaran')
            <button class="btn btn-sm mr-2 float-right text-white" type="submit"
                style="background-color: #3bae9c; border-radius: 5px;font-weight: 500;">Create</button>
        </form>
        <h5 class="card-title">Detail</h5>
        <div class="table table-responsive table-borderless table-hover text-center d-flex" style="overflow-x: hidden;">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Hari</th>
                        <th>Jam Masuk</th>
                        <th>Jam Pulang</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @foreach ($agendas as $agenda)
                <tr>
                    <td>{{ $agenda['hari'] }}</td>
                    <td>{{ $agenda['jam_masuk'] }}</td>
                    <td>{{ $agenda['jam_pulang'] }}</td>
                    @if ($agenda['id'])
                    <td>
                        @if (auth()->user()->can('edit_kelompok_jadwal'))
                        <form action="{{ route('kelompok-jadwal.edit', [$agenda['id']]) }}" method="get">
                            @include('mypartials.tahunajaran')
                            <button type="submit" class="btn btn-sm btn-warning text-white"
                                style="width: 5rem; margin: 0.1rem; border-radius: 5px; font-weight: 500;">Edit</button>
                        </form>
                        @endif
                        @if (auth()->user()->can('delete_kelompok_jadwal'))
                        <button type="submit" class="btn btn-sm btn-danger"
                            onclick="deleteData('{{ route('kelompok-jadwal.destroy', [$agenda['id']]) }}')"
                            style="width: 5rem; margin: 0.1rem; border-radius: 5px; font-weight: 500;">Hapus</button>
                        @endif
                    </td>
                    @else
                    <td></td>
                    @endif
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection