@extends('mylayouts.main')

@section('tambahcss')
    <style>
        @media screen and (max-width: 400px){
            .select{
                width: 100%;
            }

            .simpan{
                display: flex;
                justify-content: center;
                align-items: center;
                border-top: 1.5px solid rgb(213, 213, 213);
                padding: 10px;
            }
        }

        .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
            background-color: #3bae9c;
        }
    </style>
@endsection

@section('container')
    <div class="card">
        <div class="card-body">
            <div class="title d-flex justify-content-between">
                <h4 class="card-title">Jam Pelajaran</h4>
            </div>
            <div class="card text-center">
                <div class="card-header">
                  <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                      <a class="nav-link jamPelt active" style="cursor: pointer; font-size: 15px; color: white;">Jam Pelajaran</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link jamIstt" style="cursor: pointer; font-size: 15px; color: #3bae9c;">Jam Istirahat</a>
                    </li>
                  </ul>
                </div>
                <div class="card-body text-left jamPel">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-sm text-white btn-warning editJamPel" style="min-width: 5vw; margin: 2px;border-radius: 5px;font-weight: 500;">Edit</button>
                        <button type="button" class="btn btn-sm text-white btn-danger batal-edit-jam-pel" style="min-width: 5vw; margin: 2px;display: none;border-radius: 5px;font-weight: 500;">Batal</button>
                    </div>
                    <form action="{{ route('jam-pelajaran.store') }}" method="post">
                        @csrf
                        <div class="table-responsive mt-3">
                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th>Jam Ke</th>
                                        <th>Jam Awal</th>
                                        <th>Jam Akhir</th>
                                        <th class="th-action" style="display: none;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jams as $key => $jam)
                                        @if ($jam)    
                                        <tr class="text-center">
                                            <td>{{ $key+1 }}</td>
                                            <td>
                                                <input type="time" class="input-awal" name="jam_awal_{{ $key+1 }}" id="jam-awal-{{ $key+1 }}" style="border: none;background: transparent;" disabled data-jam-ke="{{ $key+1 }}" value="{{ ($jam->jam_awal) ? $jam->jam_awal : "00:00" }}">
                                            </td>
                                            <td>
                                                <input type="time" class="input-akhir" name="jam_akhir_{{ $key+1 }}" id="jam-akhir-{{ $key+1 }}" style="border: none;background: transparent;" disabled data-jam-ke="{{ $key+1 }}" value="{{ ($jam->jam_akhir) ? $jam->jam_akhir : "00:00" }}">
                                            </td>
                                            <td class="td-kosongkan" style="display: none;">
                                                <button type="button" class="btn btn-sm text-white btn-danger button-reset" style="min-width: 5vw; margin: 2px;font-weight: 500;"data-id="{{ $jam->id }}">Reset</button>
                                            </td>
                                        </tr>
                                        @else
                                        <tr class="text-center">
                                            <td>{{ $key+1 }}</td>
                                            <td>    
                                                <input type="time" class="input-awal" name="jam_awal_{{ $key+1 }}" id="jam-awal-{{ $key+1 }}" style="border: none;background: transparent;" disabled data-jam-ke="{{ $key+1 }}">
                                            </td>
                                            <td>
                                                <input type="time" class="input-akhir" name="jam_akhir_{{ $key+1 }}" id="jam-akhir-{{ $key+1 }}" style="border: none;background: transparent;" disabled data-jam-ke="{{ $key+1 }}">
                                            </td>
                                            <td class="td-kosongkan" style="display: none;">
                                                <form action="" method="get">
                                                    @include('mypartials.tahunajaran')
                                                    <button type="button" class="btn btn-sm text-white btn-danger" style="min-width: 5vw; margin: 2px;border-radius: 5px;font-weight: 500;" disabled>Reset</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center"><button type="submit" class="btn text-white simpanJamPel" style="background-color: #3bae9c; display: none;">Simpan</button></div>
                        </div>
                    </form>
                </div>
                <div class="card-body jamIst" style="display: none;">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-sm text-white float-right" data-bs-toggle="modal" data-bs-target="#modalJamIst" style="background-color: #3bae9c;border-radius: 5px;font-weight: 500;">Create</button>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table">
                            <thead>
                                <tr class="text-center">
                                    <th>Setelah Jam Ke</th>
                                    <th>Jam Awal</th>
                                    <th>Jam Akhir</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($waktu_istirahats as $key => $waktu_istirahat)    
                                <tr class="text-center">
                                    <td>{{ $waktu_istirahat->waktu_pelajaran->jam_ke }}</td>
                                    <td class="jam-awal-istirahat-{{ $key+1 }}">{{ $waktu_istirahat->jam_awal }}</td>
                                    <td class="jam-akhir-istirahat-{{ $key+1 }}">{{ $waktu_istirahat->jam_akhir }}</td>
                                    <td>
                                        @include('mypartials.tahunajaran')
                                        <button class="btn btn-sm text-white btn-warning edit-jam-istirahat" style="min-width: 5vw; margin: 2px;" type="button" data-loop="{{ $key+1 }}" data-jam-ke={{ $waktu_istirahat->waktu_pelajaran->id }} data-bs-toggle="modal" data-bs-target="#modalEditJamIst" data-id="{{ $waktu_istirahat->id }}">Edit</button>
                                        <form action="" method="get">
                                            @include('mypartials.tahunajaran')
                                            <button class="btn btn-sm text-white btn-danger" style="min-width: 5vw; margin: 2px;">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- modal jam istirahat --}}
                <div class="modal fade" id="modalJamIst" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <form action="{{ route('jam-istirahat.store') }}" method="post">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Jam Istirahat</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            @if (count($jam_pelajaran_for_istirahat) > 0)    
                            <div class="modal-body text-left">
                                <div class="bawah mb-3">
                                    <label for="labelJam" class="form-label">Setelah jam Ke</label>
                                    <select class="form-select" name="waktu_pelajaran_id" id="labelJam">
                                        @foreach ($jams as $jam)
                                            @if ($jam)
                                                <option value="{{ $jam->id }}">{{ $jam->jam_ke }} ({{ $jam->jam_awal }} - {{ $jam->jam_akhir }})</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="bawah mb-3">
                                    <div class="jam d-flex justify-content-between align-items-center gap-3">
                                        <input type="time" class="form-control" name="jam_awal">
                                        <span>s.d.</span>
                                        <input type="time" class="form-control" name="jam_akhir">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn text-white" style="background-color: #3bae9c">Simpan</button>
                            </div>
                            @else
                            <div class="alert alert-primary" role="alert">
                                Tidak ada jam pelajaran ditemukan
                            </div>
                            @endif
                        </form>
                        </div>
                    </div>              
                </div>

                <div class="modal fade" id="modalEditJamIst" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <form action="" method="post" class="form-edit-waktu-istirahat">
                            @csrf
                            @method('patch')
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Jam Istirahat</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-left">
                                <div class="bawah mb-3">
                                    <label for="wapel_edit" class="form-label">Setelah jam Ke</label>
                                    <select class="form-select select-wapel-edit" name="waktu_pelajaran_id" id="wapel_edit">
                                        @foreach ($japel as $jam)
                                            <option value="{{ $jam->id }}">{{ $jam->jam_ke }} ({{ $jam->jam_awal }} - {{ $jam->jam_akhir }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="bawah mb-3">
                                    <div class="jam d-flex justify-content-between align-items-center gap-3">
                                        <input type="time" class="form-control edit-istirahat-jam-awal" name="jam_awal">
                                        <span>s.d.</span>
                                        <input type="time" class="form-control edit-istirahat-jam-akhir" name="jam_akhir">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn text-white" style="background-color: #3bae9c">Simpan</button>
                            </div>
                        </form>
                        </div>
                    </div>              
                </div>
            </div>
        </div>
    </div>
@endsection

@section('tambahjs')
    <script>
        const jamPelt = document.querySelector('.jamPelt');
        const jamIstt = document.querySelector('.jamIstt');
        const jamPel = document.querySelector('.jamPel');
        const jamIst = document.querySelector('.jamIst');

        jamPelt.addEventListener('click', () => {
            jamIstt.style.background = 'none';
            jamIstt.style.color  = '#3bae9c';
            jamPelt.style.background = '#3bae9c';
            jamPelt.style.color = 'white';
            jamPel.style.display = 'block';
            jamIst.style.display = 'none';
        })

        jamIstt.addEventListener('click', () => {
            jamIstt.style.background = '#3bae9c';
            jamIstt.style.color  = 'white';
            jamPelt.style.background = 'none';
            jamPelt.style.color = '#3bae9c';
            jamIst.style.display = 'block';
            jamPel.style.display = 'none';
        })
    </script>

    <script>
        const editJamPel = document.querySelector('.editJamPel');
        const batalEditJamPel = document.querySelector('.batal-edit-jam-pel');
        const inputAwal = document.querySelectorAll('.input-awal');
        const inputAkhir = document.querySelectorAll('.input-akhir');
        const simpanJamPel = document.querySelector('.simpanJamPel');
        const thAction = document.querySelector('.th-action');
        const tdKosongkan = document.querySelectorAll('.td-kosongkan');
        const edit_jam_istirahat = document.querySelectorAll('.edit-jam-istirahat');
        const select_wapel_edit = document.querySelector('.select-wapel-edit');
        const edit_istirahat_jam_awal = document.querySelector('.edit-istirahat-jam-awal');
        const edit_istirahat_jam_akhir = document.querySelector('.edit-istirahat-jam-akhir');
        const formEditWaktuIstirahat = document.querySelector('.form-edit-waktu-istirahat');

        function edit(data){
            data.forEach(e => {
                e.removeAttribute('disabled');
                e.style.border = '1px solid black';
                e.style.borderRadius = '3px';
            });
        }

        function batalEdit(data){
            data.forEach(e => {
                e.setAttribute('disabled', 'disabled');
                e.style.border = 'none';
                e.style.borderRadius = '3px';
            });
        }

        editJamPel.addEventListener('click', function(){
            edit(inputAwal);
            edit(inputAkhir);
            this.style.display = 'none';
            batalEditJamPel.style.display = 'block';
            simpanJamPel.style.display = 'block';
            thAction.style.display = 'block';
            tdKosongkan.forEach(e => {
                e.style.display = 'block';
            });
        })

        batalEditJamPel.addEventListener('click', function(){
            batalEdit(inputAwal);
            batalEdit(inputAkhir);
            this.style.display = 'none';
            editJamPel.style.display = 'block';
            simpanJamPel.style.display = 'none';
            thAction.style.display = 'none';
            tdKosongkan.forEach(e => {
                e.style.display = 'none';
            });
        })

        inputAwal.forEach(e => {
            e.addEventListener('change', function(){
                if (this.value != '') {
                    document.querySelector('#jam-akhir-' + this.getAttribute('data-jam-ke')).setAttribute('required', 'required')
                }else{
                    document.querySelector('#jam-akhir-' + this.getAttribute('data-jam-ke')).removeAttribute('required', 'required')
                }
            })
        });

        inputAkhir.forEach(e => {
            e.addEventListener('change', function(){
                if (this.value != '') {
                    document.querySelector('#jam-awal-' + this.getAttribute('data-jam-ke')).setAttribute('required', 'required')
                }else{
                    document.querySelector('#jam-awal-' + this.getAttribute('data-jam-ke')).removeAttribute('required', 'required')
                }
            })
        });

        document.querySelectorAll('.button-reset').forEach(e => {
            e.addEventListener('click', function(){
                if (confirm('Apakah anda yakin akan mereset ini?')) {
                    reset(this.getAttribute('data-id'));
                }
            })
        });

        function reset(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            return $.ajax({
                type: "DELETE",
                url: "/jam-pelajaran/" + id,
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    location.reload();
                },
                error: function(response) {
                    alert('Gagal Menghapus');
                }
            });
        }

        edit_jam_istirahat.forEach(e => {
            e.addEventListener('click', function(){
                select_wapel_edit.value = this.getAttribute('data-jam-ke');
                edit_istirahat_jam_awal.value = document.querySelector('.jam-awal-istirahat-' + this.getAttribute('data-loop')).innerHTML; 
                edit_istirahat_jam_akhir.value = document.querySelector('.jam-akhir-istirahat-' + this.getAttribute('data-loop')).innerHTML;
                formEditWaktuIstirahat.setAttribute('action', '/jam-istirahat/' + this.getAttribute('data-id'));
            })
        });
    </script>
@endsection