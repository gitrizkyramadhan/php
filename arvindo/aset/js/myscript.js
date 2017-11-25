(function () {
    $.ajaxSetup({
        timeout: 60000,
        cache: false,
        error: function (x, e) {
            var msg = '';
            if (x.status == 0) {
                msg = 'Tidak tersambung koneksi internet!';
            } else if (x.status == 404) {
                msg = 'Permintaan URL tidak ditemukan!';
            } else if (x.status == 500) {
                msg = 'Internal Server Error!';
            } else if (e == 'parsererror') {
                msg = 'Error.\nParsing JSON Request failed!';
            } else if (e == 'timeout') {
                msg = 'Request Time out!';
            } else {
                msg = 'Error tidak diketahui: \n' + x.responseText;
            }
            addNotif(msg, 'important');
            $('body').removeClass("block-page");
            clearLoadingDialog();
        },
        complete: function () {
            $("#progress").width("101%").delay(200).fadeOut(400, function () {
                clearLoadingDialog();
            });
        }
    });
})();
var lasturl = "";
$(document).ready(function () {
    checkURL();
    
    setInterval("checkURL()", 250);
    
    $('.nemucurrent').click(function () {
        $(this).parent().children('li').removeClass('current');
        $(this).addClass('current');
    });
});
function formStyle() {
    $('[data-toggle=tooltip]').tooltip();
    $('[data-toggle=popover]').popover();
    $('[data-inputmask]').inputmask();
    $('.ebro_datepicker').datepicker();
    $('.s2_basic').select2();
}
function addNotif(msg, type) {
    close = 3000;
    if (type === 'important') {
        close = 0;
    }

    var defaults = {
        position: 'top-right', // top-left, top-right, bottom-left, or bottom-right
        speed: 'slow', // animations: fast, slow, or integer
        allowdupes: false, // true or false
        autoclose: close, // delay in milliseconds. Set to 0 to remain open.
        classList: 'stickyNote-' + type // arbitrary list of classes. Suggestions: success, warning, important, or info. Defaults to ''.
    };
    $.stickyNote(msg, $.extend({}, defaults));
}
function checkURL(d) {
    if (!d) {
        d = window.location.hash;
    }
    if (d != lasturl) {
            lasturl = d;
            loadPage(d);
    }
}   
function loadPage(e) {
    e = e.replace('#', '');
    if (e !== '') {
        $('body').addClass("block-page");
        if ($("#progress").length === 0) {
            $("body").append($("<div style='background:#fff'><dt/><dd/></div>").attr("id", "progress"));
            $("#progress").width((50 + Math.random() * 30) + "%");
        }
        $.ajax({
            type: "GET",
            url: base_url + e, // 
            complete: function () {
                $("#progress").width("101%").delay(200).fadeOut(400, function () {
                    clearLoadingDialog();
                });
            },
            success: function (data) {
                if (data !== 'backtohome') {
                    $("#progress").width("101%").delay(200).fadeOut(400, function () {
                        $(this).remove();
                        $('body').removeClass("block-page");
                        $('#main_content').html(data);
                    });
                } else {
                    window.location.href = base_url;
                }
            }
        });
    }
    return false;
}
function post(b, divcont, confirm) {
    var notvalid = 0;
    $.each($(b + " input:visible," + b + " select:visible," + b + " textarea:visible"), function () {
        if ($(this).attr('data-required')) {
            if ($(this).attr('data-required') && ($(this).val() === "" || $(this).val() === null)) {
                notvalid++;
                $(this).addClass('parsley-error isblank');
            }
        }
    });
    if (notvalid > 0) {
        addNotif('Ada ' + notvalid + ' kolom yang belum diisi/dipilih, mohon periksa kembali isian Anda pada kolom bertanda <b class="red">*</b>)');
    } else {
        if ($(b).attr("data-report")) {
            $(b).submit();
            return false;
        }
        var formId = ReplaceAll(b, '#', '');
        if (confirm) {
            BootstrapDialog.confirm('Apakah anda yakin dengan data yang Anda isikan ?', function (r) {
                if (r) {
                    prosesAjax(formId, divcont);
                }
            });
        } else {
            prosesAjax(formId, divcont);
        }
    }
}
function prosesAjax(formId, divcont) {
    if (divcont === '' || typeof (divcont) === 'undefined') {
        var divcont = 'main_content';
    }
    var act = $('#' + formId).attr('action');
    var arrform = new FormData(document.getElementById(formId));
    $.ajax({
        type: "POST",
        url: act + '/ajax',
        data: arrform,
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        beforeSend: function () {
            loadingDialog();
        },
        complete: function () {
            $("#progress").width("101%").delay(200).fadeOut(400, function () {
                clearLoadingDialog();
            });
        },
        success: function (data) {
            if (data !== 'backtohome') {
                var arrdata = data.split('|');
                if (arrdata[0].trim().toUpperCase() === 'MSG') {
                    if (arrdata[1].trim().toUpperCase() === 'OK') {
                        addNotif(arrdata[2], 'success');
                        if (arrdata.length > 3) {
                            call(arrdata[3], divcont);
                            if (arrdata[4] == 'closemsgbox') {
                                $('#msgbox').dialog('close');
                            }
                        }
                    } else if (arrdata[1].trim().toUpperCase() === 'DIRECT') {
                        addNotif(arrdata[2], 'info');
                        setTimeout(function () {
                            window.location.href = arrdata[3];
                        }, 1000);
                    } else if (arrdata[1].trim().toUpperCase() === 'HASH') {
                        addNotif(arrdata[2], 'info');
                        setTimeout(function () {
                            window.location.hash = arrdata[3];
                        }, 1000);
                    } else if (arrdata[1].trim().toUpperCase() === 'POP') {
                        $('.ja_wrap').remove();
                        $('body').attr('style', 'overflow: auto;');
                        addNotif(arrdata[2], 'info');
                        setTimeout(function () {
                            window.location.href = arrdata[3];
                        }, 1000);
                    } else if (arrdata[1].trim().toUpperCase() === 'VALIDASI') {
                        BootstrapDialog.alert({
                            title: 'Validasi Upload Excel',
                            message: arrdata[2],
                            type: BootstrapDialog.TYPE_DANGER
                        });
                    } else if (arrdata[1].trim().toUpperCase() === 'VALIDASIFORM') {
                        BootstrapDialog.alert({
                            title: 'Validasi Pelaporan',
                            message: arrdata[2],
                            type: BootstrapDialog.TYPE_DANGER
                        });
                    } else {
                        addNotif(arrdata[2], 'important');
                    }
                } else {
                    addNotif(data);
                }
            } else {
                window.location.href = base_url;
            }
        }
    });
}
function initialize(form) {
    $(form + " .datetime").datetimepicker({
        autoclose: true,
        format: $(this).attr('data-date-format')
    });
}
function loadingDialog() {
    if ($("#progress").length === 0) {
        $("body").append($("<div id=\"progress\"><dt/><dd/></div><div class=\"overlays\"></div>"));
        $('body').addClass("block-page");
        $('#progress').width((50 + Math.random() * 30) + "%");
        $('.overlays').css('width', $('body').css('width'));
        $('.overlays').css('height', $('body').css('height'));
    }
}
function clearLoadingDialog() {
    if ($("#progress").length > 0) {
        $('body').removeClass("block-page");
        $("#progress").remove();
        $(".overlays").remove();
    }
}
function Dialog(url, Divid, title, width, height) {
    //<div style="width: 100px;height: 100px"></div>
    c_dialog(Divid, '.: ' + title + ' :.', '<div id="idv_popup"></div>', width, height, "run-in", true, false);
    $("#" + Divid).html('<center><img src="' + base_url + '/aset/img/loading.gif" /> loading...</center>');
    $('#' + Divid).load(url);
}
function ReplaceAll(Source, stringToFind, stringToReplace) {
    var temp = Source;
    var index = temp.indexOf(stringToFind);
    while (index != -1) {
        temp = temp.replace(stringToFind, stringToReplace);
        index = temp.indexOf(stringToFind);
    }
    return temp;
}
function change_captcha(IDcaptcha) {
    document.getElementById(IDcaptcha).setAttribute("src", base_url + "aset/captcha/captcha.php?rnd=" + Math.random());
}
function setnextcb(obj, attr, target) {
    var next = obj.parent().parent().next().children().children().last();
    if (obj.attr('id') == 'negara') {
        var next = $('#propinsi');
    } else if (obj.attr('id') == 'propinsi') {
        var next = $('#kota');
    } else if (obj.attr('id') == 'propinsi2') {
        var next = $('#kota2');
    } else if (obj.attr('id') == 'kota') {
        var next = $('#kecamatan');
    } else if (obj.attr('id') == 'type') {
        var next = $('#propinsi');
    } else {
        var next = obj.parent().parent().next().children().children().last();
    }
    if (attr != null)
        next.attr(attr, obj.val());
    $.get(obj.attr('url') + obj.val(), function (hasil) {
        next.html(hasil);
    });
}
function setnextcb2(obj, attr, target) {
    var next = obj.parent().parent().next().children().children().last();
    if (obj.attr('id') == 'propinsi') {
        var next = $('#kota');
    } else if (obj.attr('id') == 'kota') {
        var next = $('#kecamatan');
    } else if (obj.attr('id') == 'type') {
        var next = $('#propinsi');
    } else {
        var next = obj.parent().parent().next().children().children().last();
    }
    if (attr != null)
        next.attr(attr, obj.val());
    if (obj.attr('id') == 'propinsi') {
        $.get(obj.attr('url') + obj.val() + '/' + $("#type").val(), function (hasil) {
            next.html(hasil);
        });
    } else {
        $.get(obj.attr('url') + obj.val(), function (hasil) {
            next.html(hasil);
        });
    }
}
function datepicker(id) {
    thn = new Date();
    $(id).datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        yearRange: "-100:+5"
    });
    $(id).datepicker('show');
}
function call(url, div) {
    if (div === '' || typeof (div) === 'undefined') {
        var div = 'main_content';
    }
    $('#' + div).html('<div id="loadingImg" style="margin-left: auto;"><img src="' + base_url + '/aset/img/loading.gif" /> loading...</div>');
    $.ajax({
        url: url,
        type: 'POST',
        timeout: 60000,
        cache: false,
        data: {
            keyoke: $.now()
        },
        success: function (data) {
            if (data !== 'backtohome') {
                $('#' + div).html(data);
                clearLoadingDialog();
            } else {
                window.location.href = base_url;
            }

        }
    });
}

function ShowDP(obj_date) {
    $("#" + obj_date).datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });

    return false;
}