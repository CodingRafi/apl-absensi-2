@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <div style="display: flex; justify-content:space-between">
            <h4 class="card-title m-0">{{ isset($data) ? 'Update' : 'Create' }} Absensi Pelajaran</h4>
            <form action="{{ route('absensi-pelajaran.index') }}" method="get">
                @include('mypartials.tahunajaran')
                <button class="btn btn-sm btn-danger float-right text-white" type="submit"
                    style="border-radius: 5px; font-weight: 500;">Kembali</button>
            </form>
        </div>

        
        <form action="{{ isset($data) ? route('absensi-pelajaran.update', $data->id) : route('absensi-pelajaran.store') }}" method="POST">
            @csrf
            @if (isset($data))
                @method('patch')
            @endif
            @include('mypartials.tahunajaran')

            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                    name="nama" value="{{ isset($data) ? $data->nama : old('nama') }}"
                    style=" font-size: 15px; height: 6.5vh;" required>
                @error('nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="mapel" class="form-label">Mapel</label>
                <select class="form-select @error('mapel_id') is-invalid @enderror" name="mapel_id"
                    value="{{ isset($data) ? $data->mapel_id : old('mapel_id') }}"
                    style=" font-size: 15px; height: 6.5vh;" id="mapel">
                    <option value="">Pilih Mapel</option>
                    @foreach (Auth::user()->mapel as $mapel)
                    <option value="{{ $mapel->id }}" {{ isset($data) ? ($data->mapel_id == $mapel->id ? 'selected' : '') : '' }}>{{ $mapel->nama }}</option>
                    @endforeach
                </select>
                @error('mapel_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3 div-kelas" style="{{ old('kelas_id') ? '' : 'display: none;' }}">
                <label for="kelas" class="form-label">Kelas</label>
                <select class="form-select @error('kelas_id') is-invalid @enderror" name="kelas_id"
                    value="{{ isset($data) ? $data->kelas_id : old('kelas_id') }}"
                    style=" font-size: 15px; height: 6.5vh;" id="kelas">
                    <option value="">Pilih Kelas</option>
                </select>
                @error('kelas_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <button type="submit" class="btn text-white btn-simpan" style="background-color: #3bae9c" >Simpan</button>
        </form>
    </div>
</div>
@endsection

@section('tambahjs')
<script>
    function get_kelas(value, method = 'create', val_selected = null){
        $('.div-kelas select').empty();
        $('.div-kelas select').append($("<option>", {
                                            value: "",
                                            text: "Pilih Kelas",
                                        })
                                    )

        if (!value) {
            $('.div-kelas').css('display', 'none');
        }else{
            start_loading();
            $.post('{{ route("absensi-pelajaran.get-kelas") }}', {
                        mapel_id: value,
                        method: method,
                        tahun_awal: '{{ request("tahun_awal") }}',
                        tahun_akhir: '{{ request("tahun_akhir") }}',
                        semester: '{{ request("semester") }}',
                    }, function(response){
                        $('.div-kelas').css('display', 'block');
                        
                        $.each(response.datas, function(i,e){
                            $('.div-kelas select').append(`<option value="${e.id}">${e.nama}</option>`)
                        })

                        if (val_selected !== null && val_selected !== "") {
                            $('.div-kelas select').val(val_selected);
                        }
                    })
            stop_loading()
        }
    }

    $('#mapel').on('change', function(){get_kelas($(this).val())})

    @if (isset($data) && $data->mapel_id)
        get_kelas('{{ $data->mapel_id }}', 'update', '{{ $data->kelas_id }}')
        console.log($('form select'))
        $('form select').on('change', function(){
            if (!$('.btn-simpan').attr('onclick')) {
                $('.btn-simpan').attr('onclick', "return confirm('Apakah anda yakin? ini akan mereset presensi sebelumnya')");
            }
        })

    @endif
</script>
@endsection