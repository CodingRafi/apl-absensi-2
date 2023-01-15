@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Kelas</h4>
        @if (auth()->user()->can('add_kelas'))
        @if (count($tahun_ajarans) > 0)
        <form action="{{ route('kelas.create') }}" method="get">
            @include('mypartials.tahunajaran')
            <button type="submit" class="btn btn-sm text-white position-absolute px-3"
                style="top: .7rem; right: 1rem; background-color: #3bae9c;border-radius: 5px;font-weight: 500;">Tambah
                Kelas</button>
        </form>
        @endif
        @endif
        <table class="table">
            <thead>
                <tr class="text-center">
                    <th scope="col">No</th>
                    <th scope="col">Nama Kelas</th>
                    @if (auth()->user()->can('edit_kelas') || auth()->user()->can('delete_kelas'))
                    <th scope="col">Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach (Auth::user()->sekolah->kelas as $kelas)
                <tr class="text-center">
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $kelas->tingkat->romawi }} {{ $kelas->nama }}</td>
                    @if (auth()->user()->can('edit_kelas') || auth()->user()->can('delete_kelas') ||
                    auth()->user()->can('upgrade_kelas'))
                    <td>
                        @if (auth()->user()->can('upgrade_kelas'))
                        <button type="button" class="btn btn-sm btn-info text-white btn-upgrade"
                            style="width: 5rem; margin: 0.1rem; border-radius: 5px; font-weight: 500;" data-id="{{ $kelas->id }}">
                            Upgrade
                        </button>
                        @endif
                        @if (auth()->user()->can('edit_kelas'))
                        <form action="{{ route('kelas.edit', [$kelas->id]) }}" method="get">
                            @include('mypartials.tahunajaran')
                            <button type="submit" class="btn btn-sm btn-warning text-white"
                                style="width: 5rem; margin: 0.1rem; border-radius: 5px; font-weight: 500;">Edit</button>
                        </form>
                        @endif
                        @if (auth()->user()->can('delete_kelas'))
                        <button type="submit" class="btn btn-sm btn-danger"
                            onclick="deleteData('{{ route('kelas.destroy', [$kelas->id]) }}')"
                            style="width: 5rem; margin: 0.1rem; border-radius: 5px; font-weight: 500;">Hapus</button>
                        @endif
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="upgradeKelas" tabindex="-1" aria-labelledby="upgradeKelasLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('kelas.upgrade') }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="upgradeKelasLabel">Upgrade Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="tahun_ajaran_id" class="form-label">Tahun Ajaran</label>
                        <select class="form-select" name="tahun_ajaran_id">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kelas_id" class="form-label">Kelas</label>
                        <select class="form-select" name="kelas_id">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="to_kelas_id" class="form-label">Naik kelas ke</label>
                        <select class="form-select" name="to_kelas_id">
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('tambahjs')
<script>
    function open_modal(value_tahun_ajaran = null,  value_kelas = null, value_to_kelas = null, el = null){
        start_loading();
        $.post('{{ route("kelas.get_data") }}', {
                tahun_awal: '{{ request("tahun_awal") }}',
                tahun_akhir: '{{ request("tahun_akhir") }}',
                semester: '{{ request("semester") }}',
            }, function(response){
                $('#upgradeKelas select[name="tahun_ajaran_id"]').empty()

                $.each(response.tahun_ajarans, function(i,e){
                    $('#upgradeKelas select[name="tahun_ajaran_id"]').append(`<option value="${e.id}">${e.tahun_awal} - ${e.tahun_akhir} Semester ${e.semester}</option>`)
                })

                if (value_tahun_ajaran) {
                    $('#upgradeKelas select[name="tahun_ajaran_id"]').val(value_tahun_ajaran)
                }

                $('#upgradeKelas select[name="kelas_id"]').empty()

                $.each(response.kelas, function(i,e){
                    if (e.id == $(el).attr('data-id')) {
                        $('#upgradeKelas select[name="kelas_id"]').append(`<option value="${e.id}" selected>${e.romawi} ${e.nama}</option>`)
                    } else {
                        $('#upgradeKelas select[name="kelas_id"]').append(`<option value="${e.id}">${e.romawi} ${e.nama}</option>`)
                    }
                })

                if (value_kelas) {
                    $('#upgradeKelas select[name="kelas_id"]').val(value_kelas)
                }

                $('#upgradeKelas select[name="to_kelas_id"]').empty()
                
                $.each(response.to_kelas, function(i,e){
                    $('#upgradeKelas select[name="to_kelas_id"]').append(`<option value="${e.id}">${e.romawi} ${e.nama}</option>`)
                })

                if (value_to_kelas) {
                    $('#upgradeKelas select[name="to_kelas_id"]').val(value_to_kelas)
                }

                $('#upgradeKelas').modal('show')
            })
        stop_loading()
    }

    $('.btn-upgrade').on('click', function(){
        open_modal(null, null, null, this);
    })

    $('#upgradeKelas').on('hidden.bs.modal', function () {
        $('#upgradeKelas form')[0].reset()
    })
</script>
@if ($errors->any())
<script>
    $(document).ready(function(){
        $('#upgradeKelas').modal('show');
        showAlert("{{ $errors->first('msg_error') }}", 'error')
        open_modal('{{ old("tahun_ajaran_id") }}', '{{ old("kelas_id") }}', '{{ old("to_kelas_id") }}');
    })
</script>
@endif
@endsection