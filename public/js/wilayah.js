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
