@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
            @foreach (config('services.hari.value') as $key => $hari)
            <li class="nav-item">
                <a class="nav-link text-capitalize" href="#{{ $hari }}" role="tab" aria-controls="{{ $hari }}"
                    aria-selected="true">{{ $hari }}</a>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content mt-3">
            @foreach (config('services.hari.value') as $hari)
            <div class="tab-pane" id="{{ $hari }}" role="tabpanel">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th scope="col" rowspan="2" style="vertical-align: middle;">Jam Ke</th>
                                <th scope="col" rowspan="2" style="vertical-align: middle;">Waktu</th>
                                <th scope="col" rowspan="2" style="vertical-align: middle;">Kegiatan</th>
                                <th scope="col" rowspan="2" style="vertical-align: middle;">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($agendas[$hari] as $agenda)
                            <tr>
                                <th class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;">{{ $agenda->waktu_pelajaran->jam_ke }}</th>
                                <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;">{{ date('H.i', strtotime($agenda->waktu_pelajaran->jam_awal)) }} - {{ date('H.i', strtotime($agenda->waktu_pelajaran->jam_akhir)) }}</td>
                                <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;">{{ ($role != 'siswa' && $role != 'guru') ? $agenda->other : (($role == 'guru') ? ($agenda->mapel->nama . ' (' . $agenda->kelas->nama . ')') : ($agenda->mapel->nama . ' (' . $agenda->user->name . ')')) }}</td>
                                <td class="cell-table" style="height: 2rem;border: 1px solid grey;cursor: pointer;">
                                    <a href="{{ route('agenda.edit', ['role' => $role, 'id' => $agenda->id]) }}" class="btn btn-warning btn-sm rounded">Edit</a>
                                    @push('other_delete')
                                        <input type="hidden" name="role" value="{{ $role }}">
                                    @endpush
                                    <button type="submit" class="btn btn-sm btn-danger rounded"
                                    onclick="deleteData('{{ route('agenda.destroy', [$agenda->id]) }}')">Hapus</button>
                                </td>
                            </tr>
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

@push('js')
    <script>
        $('#bologna-list a').on('click', function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
    </script>
@endpush