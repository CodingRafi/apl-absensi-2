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
    </style>
@endsection

@section('container')
    <div class="card">
        <div class="card-body">
            <div class="title d-flex justify-content-between">
                <h4 class="card-title">Jam Pelajaran</h4>
                <form action="/jamPelajaran">
                    <button class="btn btn-sm btn-danger text-white font-weight-bold" style="min-width: 5vw;">kembali</button>
                </form>
            </div>
            <div class="mt-2 mb-3">
                <div class="atas mb-3">
                    <label for="labelJam" class="form-label">Jam Ke 1</label>
                    <div class="jam d-flex justify-content-between align-items-center gap-3">
                        <input type="time" class="form-control" name="jamAwal" id="jamAwal">
                        <span>s.d.</span>
                        <input type="time" class="form-control" name="jamAkhir" id="jamAkhir">
                    </div>
                    {{-- <div class="notify" style="background-color: #ffc233a5; color: #695115;border-radius: 5px; border: 2px solid #e2af2d; padding: 5px; font-size: 12px; font-weight: bold; float: right;">Jam ke "" sudah tersedia, apakah anda tetap ingin memilihnya? hal ini akan menghapus data sebelumnya</div> --}}
                </div>
            </div>
            <div class="atas mb-3">
                <label for="labelJam" class="form-label">Jam Ke 2</label>
                <div class="jam d-flex justify-content-between align-items-center gap-3">
                    <input type="time" class="form-control" name="jamAwal" id="jamAwal">
                    <span>s.d.</span>
                    <input type="time" class="form-control" name="jamAkhir" id="jamAkhir">
                </div>
            </div>
            <div class="atas mb-3">
                <label for="labelJam" class="form-label">Jam Ke 3</label>
                <div class="jam d-flex justify-content-between align-items-center gap-3">
                    <input type="time" class="form-control" name="jamAwal" id="jamAwal">
                    <span>s.d.</span>
                    <input type="time" class="form-control" name="jamAkhir" id="jamAkhir">
                </div>
            </div>
            <div class="atas mb-3">
                <label for="labelJam" class="form-label">Jam Ke 4</label>
                <div class="jam d-flex justify-content-between align-items-center gap-3">
                    <input type="time" class="form-control" name="jamAwal" id="jamAwal">
                    <span>s.d.</span>
                    <input type="time" class="form-control" name="jamAkhir" id="jamAkhir">
                </div>
            </div>
            <div class="atas mb-3">
                <label for="labelJam" class="form-label">Jam Ke 5</label>
                <div class="jam d-flex justify-content-between align-items-center gap-3">
                    <input type="time" class="form-control" name="jamAwal" id="jamAwal">
                    <span>s.d.</span>
                    <input type="time" class="form-control" name="jamAkhir" id="jamAkhir">
                </div>
            </div>
            <div class="atas mb-3">
                <label for="labelJam" class="form-label">Jam Ke 6</label>
                <div class="jam d-flex justify-content-between align-items-center gap-3">
                    <input type="time" class="form-control" name="jamAwal" id="jamAwal">
                    <span>s.d.</span>
                    <input type="time" class="form-control" name="jamAkhir" id="jamAkhir">
                </div>
            </div>
            <div class="atas mb-3">
                <label for="labelJam" class="form-label">Jam Ke 7</label>
                <div class="jam d-flex justify-content-between align-items-center gap-3">
                    <input type="time" class="form-control" name="jamAwal" id="jamAwal">
                    <span>s.d.</span>
                    <input type="time" class="form-control" name="jamAkhir" id="jamAkhir">
                </div>
            </div>
            <div class="atas mb-3">
                <label for="labelJam" class="form-label">Jam Ke 8</label>
                <div class="jam d-flex justify-content-between align-items-center gap-3">
                    <input type="time" class="form-control" name="jamAwal" id="jamAwal">
                    <span>s.d.</span>
                    <input type="time" class="form-control" name="jamAkhir" id="jamAkhir">
                </div>
            </div>
            <div class="atas mb-3">
                <label for="labelJam" class="form-label">Jam Ke 9</label>
                <div class="jam d-flex justify-content-between align-items-center gap-3">
                    <input type="time" class="form-control" name="jamAwal" id="jamAwal">
                    <span>s.d.</span>
                    <input type="time" class="form-control" name="jamAkhir" id="jamAkhir">
                </div>
            </div>
            <div class="atas mb-3">
                <label for="labelJam" class="form-label">Jam Ke 10</label>
                <div class="jam d-flex justify-content-between align-items-center gap-3">
                    <input type="time" class="form-control" name="jamAwal" id="jamAwal">
                    <span>s.d.</span>
                    <input type="time" class="form-control" name="jamAkhir" id="jamAkhir">
                </div>
            </div>
            <div class="atas mb-3">
                <label for="labelJam" class="form-label">Jam Ke 11</label>
                <div class="jam d-flex justify-content-between align-items-center gap-3">
                    <input type="time" class="form-control" name="jamAwal" id="jamAwal">
                    <span>s.d.</span>
                    <input type="time" class="form-control" name="jamAkhir" id="jamAkhir">
                </div>
            </div>
            <div class="atas mb-3">
                <label for="labelJam" class="form-label">Jam Ke 12</label>
                <div class="jam d-flex justify-content-between align-items-center gap-3">
                    <input type="time" class="form-control" name="jamAwal" id="jamAwal">
                    <span>s.d.</span>
                    <input type="time" class="form-control" name="jamAkhir" id="jamAkhir">
                </div>
            </div>
            <div class="atas mb-3">
                <label for="labelJam" class="form-label">Jam Ke 13</label>
                <div class="jam d-flex justify-content-between align-items-center gap-3">
                    <input type="time" class="form-control" name="jamAwal" id="jamAwal">
                    <span>s.d.</span>
                    <input type="time" class="form-control" name="jamAkhir" id="jamAkhir">
                </div>
            </div>
            <div class="atas mb-3">
                <label for="labelJam" class="form-label">Jam Ke 14</label>
                <div class="jam d-flex justify-content-between align-items-center gap-3">
                    <input type="time" class="form-control" name="jamAwal" id="jamAwal">
                    <span>s.d.</span>
                    <input type="time" class="form-control" name="jamAkhir" id="jamAkhir">
                </div>
            </div>
            <div class="atas mb-3">
                <label for="labelJam" class="form-label">Jam Ke 15</label>
                <div class="jam d-flex justify-content-between align-items-center gap-3">
                    <input type="time" class="form-control" name="jamAwal" id="jamAwal">
                    <span>s.d.</span>
                    <input type="time" class="form-control" name="jamAkhir" id="jamAkhir">
                </div>
            </div>
            <div class="atas mb-5">
                <label for="labelJam" class="form-label">Jam Ke 16</label>
                <div class="jam d-flex justify-content-between align-items-center gap-3">
                    <input type="time" class="form-control" name="jamAwal" id="jamAwal">
                    <span>s.d.</span>
                    <input type="time" class="form-control" name="jamAkhir" id="jamAkhir">
                </div>
            </div>
            <hr>
            <div class="titles mt-3">
                <h4 class="card-title">Jam Istirahat</h4>
            </div>
            <div class="bawah mt-3 mb-3">
                <label for="labelJam" class="form-label">Istirahat 1</label>
                <div class="jam d-flex justify-content-between align-items-center gap-3">
                    <input type="time" class="form-control" name="jamAwal" id="jamAwal">
                    <span>s.d.</span>
                    <input type="time" class="form-control" name="jamAkhir" id="jamAkhir">
                </div>
            </div>
            <div class="bawah mb-3">
                <label for="labelJam" class="form-label">Istirahat 2</label>
                <div class="jam d-flex justify-content-between align-items-center gap-3">
                    <input type="time" class="form-control" name="jamAwal" id="jamAwal">
                    <span>s.d.</span>
                    <input type="time" class="form-control" name="jamAkhir" id="jamAkhir">
                </div>
            </div>
            <div class="bawah3 mb-3">
                <label for="labelJam" class="form-label">Istirahat 3</label>
                <div class="jam d-flex justify-content-between align-items-center gap-3">
                    <input type="time" class="form-control" name="jamAwal" id="jamAwal">
                    <span>s.d.</span>
                    <input type="time" class="form-control" name="jamAkhir" id="jamAkhir">
                </div>
            </div>
            <div class="simpan" style="width: 100%"><button class="btn text-white" style="background-color: #3bae9c; min-width: 6vw;">Simpan</button></div>
        </div>
    </div>
@endsection