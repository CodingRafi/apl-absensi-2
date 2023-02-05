@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-header">
        @can('add_agenda')
        <a class="btn btn-sm text-white float-right mt-2" href="{{ route('agenda.create', ['role' => $role, 'id' => $id ?? request('id')]) }}" style="background-color: #3bae9c; border-radius: 5px; font-weight: 500;">Create</a>
        @endcan

        <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
            @foreach (config('services.hari.value') as $key => $hari)
            <li class="nav-item">
                <a class="nav-link text-capitalize {{ $key < 1 ? 'active' : '' }}" href="#{{ $hari }}" role="tab" aria-controls="{{ $hari }}"
                    aria-selected="true">{{ $hari }}</a>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content mt-3">
            @foreach (config('services.hari.value') as $key => $hari)
            <div class="tab-pane {{ $key < 1 ? 'active' : '' }}" id="{{ $hari }}" role="tabpanel">
                <div class="table table-responsive table-hover text-center"> 
                    <table class="col-lg-12 table align-middle">
                        <thead>
                            <tr>
                                <th rowspan="2">Jam Ke</th>
                                <th rowspan="2">Waktu</th>
                                <th rowspan="2">Kegiatan</th>
                                @can('edit_agenda', 'delete_agenda')
                                <th rowspan="2">Option</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($agendas[$hari] as $agenda)
                            <tr>
                                <th class="cell-table" style="cursor: pointer;">{{ $agenda->waktu_pelajaran->jam_ke }}</th>
                                <td class="cell-table" style="cursor: pointer;">{{ date('H.i', strtotime($agenda->waktu_pelajaran->jam_awal)) }} - {{ date('H.i', strtotime($agenda->waktu_pelajaran->jam_akhir)) }}</td>
                                {{-- @dd($agenda->mapel) --}}
                                <td class="cell-table" style="cursor: pointer;">{{ ($role != 'siswa' && $role != 'guru') ? $agenda->other : (($role == 'guru') ? ($agenda->mapel->nama . ' (' . $agenda->kelas->tingkat->romawi . ' ' . $agenda->kelas->nama . ')') : ($agenda->mapel->nama . ' (' . $agenda->user->profile_user->name . ')')) }}</td>
                                @can('edit_agenda', 'delete_agenda')
                                <td class="cell-table" style="cursor: pointer;">
                                    @can('edit_agenda')
                                    <a href="{{ route('agenda.edit', ['role' => $role, 'id' => $agenda->id]) }}" class="btn btn-warning btn-sm rounded" style="font-weight: 500;">Edit</a>
                                    @endcan
                                    @can('delete_agenda')
                                    @push('other_delete')
                                        <input type="hidden" name="role" value="{{ $role }}">
                                    @endpush
                                    <button type="submit" class="btn btn-sm btn-danger rounded"
                                    onclick="deleteData('{{ route('agenda.destroy', [$agenda->id]) }}')" style="font-weight: 500;">Hapus</button>
                                    @endcan
                                </td>
                                @endcan
                            </tr>
                            @if ($agenda->waktu_pelajaran->waktu_istirahat)
                            <tr class="bg-info">
                                <td>
                                    <td>{{ date('H.i', strtotime($agenda->waktu_pelajaran->waktu_istirahat->jam_awal)) }} - {{ date('H.i', strtotime($agenda->waktu_pelajaran->waktu_istirahat->jam_akhir)) }}</td>
                                    <td colspan="3">Istirahat</td>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('tambahjs')
    <script>
        $('#bologna-list a').on('click', function (e) {
            e.preventDefault()
            $('#bologna-list a').removeClass('active');
            $('.tab-pane').removeClass('active');
            $(this).addClass('active');
            $(`.tab-pane${$(this).attr('href')}`).addClass('active');
        })
    </script>
@endsection