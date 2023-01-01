<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css"
    integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"
    integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js">
</script>
<style>
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        margin-top: -14px;
        margin-left: -16px;
    }

    .select2-container {
        width: 100% !important;
    }
</style>
<script>
    function showAlert(message, type) {
        if (type == 'success') {
            iziToast.success({
                title: 'Success',
                message: message,
                position: 'topRight'
            });
        } else {
            iziToast.error({
                title: 'Failed',
                message: message,
                position: 'topRight'
            });
        }
    }
    @if (session()->has('msg_success')) showAlert("{{ session('msg_success') }}", 'success')
    @elseif(session()->has('msg_error')) showAlert("{{ session('msg_error') }}", 'error')
    @endif

    $('.between-input-item-select').select2();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    function start_loading() {
        $.LoadingOverlay("show");
    }

    function stop_loading(){
        $.LoadingOverlay("hide");
    }

    $(document).ajaxStop(function(){
        stop_loading();
    });

    $(document).on('change', '#ref_provinsi_id', function() {
        kabupaten_list(this);
    });

    $(document).on('change', '#ref_kabupaten_id', function() {
        kecamatan_list(this);
    });

    $(document).on('change', '#ref_kecamatan_id', function() {
        kelurahan_list(this);
    });

    function kabupaten_list(el, value = null) {
        start_loading();
        let provinsi = $(el);
        let kabupaten = $('#ref_kabupaten_id');
        let kecamatan = $('#ref_kecamatan_id');
        let kelurahan = $('#ref_kelurahan_id');
        provinsi.prop("disabled", true);
        kabupaten.prop("disabled", true);
        kecamatan.prop("disabled", true);
        kelurahan.prop("disabled", true);
        kabupaten.empty();
        kecamatan.empty();
        kelurahan.empty();
        kecamatan.append(
            $("<option>", {
                value: "",
                text: "Pilih Kecamatan",
            })
        );
        kelurahan.append(
            $("<option>", {
                value: "",
                text: "Pilih Kelurahan",
            })
        );
        return $.ajax({
            type: "POST",
            url: "/data-master/kabupaten",
            data: {
                provinsi_id: provinsi.val(),
            },
            dataType: "json",
            beforeSend: function (e) {
                if (e && e.overrideMimeType) {
                    e.overrideMimeType("application/json;charset=UTF-8");
                }
            },
            success: function (response) {
                kabupaten.append(
                    $("<option>", {
                        value: "",
                        text: "Pilih Kabupaten/Kota",
                    })
                );
                $.each(response.data, function (index, row) {
                    kabupaten.append(
                        $("<option>", {
                            value: row.id,
                            text: row.nama,
                        })
                    );
                });

                if (value !== null && value !== "") {
                    kabupaten.val(value);
                }

                provinsi.removeAttr("disabled");
                kabupaten.removeAttr("disabled");
                kecamatan.removeAttr("disabled");
                kelurahan.removeAttr("disabled");
                kabupaten.select2("destroy").select2();
                stop_loading();
            },
            error: function (response) {
                kabupaten.append(
                    $("<option>", {
                        value: "",
                        text: "Pilih Kabupaten/Kota",
                    })
                );

                provinsi.removeAttr("disabled");
                kabupaten.removeAttr("disabled");
                kecamatan.removeAttr("disabled");
                kelurahan.removeAttr("disabled");
                kabupaten.select2("destroy").select2();
                stop_loading();
            },
        });
    }

    function kecamatan_list(el, value = null) {
        start_loading();
        let kabupaten = $(el);
        let kecamatan = $('#ref_kecamatan_id');
        let kelurahan = $('#ref_kelurahan_id');
        kabupaten.prop("disabled", true);
        kecamatan.prop("disabled", true);
        kecamatan.empty();
        kelurahan.prop("disabled", true);
        kelurahan.empty();
        return $.ajax({
            type: "POST",
            url: "/data-master/kecamatan",
            data: {
                kabupaten_id: kabupaten.val(),
            },
            dataType: "json",
            beforeSend: function (e) {
                if (e && e.overrideMimeType) {
                    e.overrideMimeType("application/json;charset=UTF-8");
                }
            },
            success: function (response) {
                kecamatan.append(
                    $("<option>", {
                        value: "",
                        text: "Pilih Kecamatan",
                    })
                );
                $.each(response.data, function (index, row) {
                    kecamatan.append(
                        $("<option>", {
                            value: row.id,
                            text: row.nama,
                        })
                    );
                });
                if (value !== null && value !== "") {
                    kecamatan.val(value);
                }
                kabupaten.removeAttr("disabled");
                kecamatan.removeAttr("disabled");
                kecamatan.select2("destroy").select2();
                kelurahan.append(
                    $("<option>", {
                        value: "",
                        text: "Pilih Kelurahan",
                    })
                );
                kelurahan.removeAttr("disabled");
                kelurahan.select2("destroy").select2();
                stop_loading();
            },
            error: function (response) {
                kabupaten.removeAttr("disabled");
                kecamatan.append(
                    $("<option>", {
                        value: "",
                        text: "Pilih Kecamatan",
                    })
                );
                kecamatan.removeAttr("disabled");
                kecamatan.select2("destroy").select2();
                kelurahan.append(
                    $("<option>", {
                        value: "",
                        text: "Pilih Kelurahan",
                    })
                );
                kelurahan.removeAttr("disabled");
                kelurahan.select2("destroy").select2();

                stop_loading();
            },
        });
    }

    function kelurahan_list(el, value = null) {
        start_loading();
        let kecamatan = $(el);
        let kelurahan = $("#ref_kelurahan_id");
        kecamatan.prop("disabled", true);
        kelurahan.prop("disabled", true);
        kelurahan.empty();
        return $.ajax({
            type: "POST",
            url: "/data-master/kelurahan",
            data: {
                kecamatan_id: kecamatan.val(),
            },
            dataType: "json",
            beforeSend: function (e) {
                if (e && e.overrideMimeType) {
                    e.overrideMimeType("application/json;charset=UTF-8");
                }
            },
            success: function (response) {
                kelurahan.append(
                    $("<option>", {
                        value: "",
                        text: "Pilih Kelurahan",
                    })
                );
                $.each(response.data, function (index, row) {
                    kelurahan.append(
                        $("<option>", {
                            value: row.id,
                            text: row.nama,
                        })
                    );
                });
                if (value !== null && value !== "") {
                    kelurahan.val(value);
                }
                kecamatan.removeAttr("disabled");
                kelurahan.removeAttr("disabled");
                kelurahan.select2("destroy").select2();
                stop_loading();
            },
            error: function (response) {
                kecamatan.removeAttr("disabled");
                kelurahan.append(
                    $("<option>", {
                        value: "",
                        text: "Pilih Kelurahan",
                    })
                );
                kelurahan.removeAttr("disabled");
                kelurahan.select2("destroy").select2();

                stop_loading();
            },
        });
    }
@if (isset($data) ? $data->ref_provinsi_id : old('ref_provinsi_id'))
        kabupaten_list($('#ref_provinsi_id'), "{{ isset($data) ? $data->ref_kabupaten_id : old('ref_kabupaten_id') }}")
            .then(function(d) {
                @if (isset($data) ? $data->ref_kecamatan_id : old('ref_kecamatan_id'))
                    kecamatan_list($('#ref_kabupaten_id'), "{{ isset($data) ? $data->ref_kecamatan_id : old('ref_kecamatan_id') }}")
                        .then(function(d) {
                            @if (isset($data) ? $data->ref_kelurahan_id : old('ref_kelurahan_id'))
                                kelurahan_list($('#ref_kecamatan_id'), "{{ isset($data) ? $data->ref_kelurahan_id : old('ref_kelurahan_id') }}");
                            @endif
                        });
                @endif
            });
    @endif
</script>