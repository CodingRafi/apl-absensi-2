@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <div style="display: flex; justify-content:space-between">
            <h4 class="card-title m-0">Create Absensi Pelajaran</h4>
            <form action="{{ route('absensi-pelajaran.index') }}" method="get">
                @include('mypartials.tahunajaran')
                <button class="btn btn-sm btn-danger float-right text-white" type="submit"
                    style="border-radius: 5px; font-weight: 500;">Kembali</button>
            </form>
        </div>

        <form action="{{ route('absensi-pelajaran.store') }}" method="POST">
            @csrf
            @include('mypartials.tahunajaran')

            <span id="request" data-tahun-awal="{{ request('tahun_awal') }}"
                data-tahun-akhir="{{ request('tahun_akhir') }}" data-semester="{{ request('semester') }}"></span>

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
                    <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
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

            <button type="submit" class="btn text-white" style="background-color: #3bae9c">Simpan</button>
        </form>
    </div>
</div>
@endsection

@section('tambahjs')
<script>
    $('#mapel').on('change', function(){
            $('.div-kelas select').empty();
            $('.div-kelas select').append($("<option>", {
                                                value: "",
                                                text: "Pilih Kelas",
                                            })
                                        )

            if (!$(this).val()) {
                $('.div-kelas').css('display', 'none');
            }else{
                const request = $('#request');
    
                $.post('{{ route("absensi-pelajaran.get-kelas") }}', {
                    mapel_id: $(this).val(),
                    tahun_awal: request.attr('data-tahun-awal'),
                    tahun_akhir: request.attr('data-tahun-akhir'),
                    semester: request.attr('data-semester'),
                }, function(response){
                    $('.div-kelas').css('display', 'block');
                    
                    $.each(response.datas, function(i,e){
                        $('.div-kelas select').append(
                            $("<option>", {
                                value: e.id,
                                text: e.nama,
                            })
                        )
                    })
                })
            }
        })
</script>
@endsection