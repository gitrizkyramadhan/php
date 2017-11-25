function tb_menu(formid, id) {
    //var xDialog = new BootstrapDialog({title: app_name});
    var checked = false;
    var url = '';
    var jml = '';
    var met = '';
    var con = '';
    var div = '';
    var valdata = '';
    var chk = $("#tb_chk" + formid + ":checked").length;
    id = typeof id !== 'undefined' ? id : '';
    if (id == '') {
        var isi = $("#tb_menu" + formid).val();
        $("#tb_menu" + formid + " option").each(function () {
            if ($(this).text().trim() == isi.trim()) {
                url = $(this).attr('url');
                jml = $(this).attr('jml');
                met = $(this).attr('met');
                con = $(this).attr('content');
                div = $(this).attr('div');
            }
        });
    } else {
        url = $('#' + id).attr('url');
        jml = $('#' + id).attr('jml');
        met = $('#' + id).attr('met');
        con = $('#' + id).attr('content');
        div = $('#' + id).attr('div');
    }
    if (url == '')
        return false;
    if (chk == 0 && jml != '0' && jml != 'N') {
            addNotif('Maaf, Data belum dipilih.', 'important');
            $("#tb_menu" + formid).val(0);
            return false;
    } 
    if ((jml == '1' || jml == 'N') && chk > 1) {
        addNotif('Maaf, Data yang bisa diproses hanya 1 (satu).', 'important');
        $("#tb_menu" + formid).val(0);
        return false;
    }
    if(chk>0){
        var val = $("#tb_chk" + formid + ":checked").val().toLowerCase().split("|");
        for (var a = 0; a < val.length; a++) {
            valdata = valdata + '/' + val[a];
        }
    }
    
    if (met == "GETHASH") {
        var hash = ReplaceAll(url, site_url + '/', '') + valdata;
        window.location.hash = hash;
    }
    else if (met == "POPUP") {
        var valdata = "";
        if (jml != '0') {
            var val = $("#tb_chk" + formid + ":checked").val().toLowerCase().split("|");
            for (var a = 0; a < val.length; a++) {
                valdata = valdata + '/' + val[a];
            }
        }
        var arrCon = con.split('|');
        $.jAlert({
            'title': arrCon[0],
            'content': '<center><img src="' + base_url + '/aset/img/loading.gif" /> loading...</center>',
            'ajax': url + valdata,
            'theme': 'dark_blue',
            'size': {'height': arrCon[2] + 'px', 'width': arrCon[1] + 'px'},
            'showAnimation': 'flipInX',
            'hideAnimation': 'flipOutX'
        });
    }
    else if (met == "PROSES") {
        jConfirm(
                'Proses data terpilih sekarang?',
                app_name,
                function () {
                    var val = $("#" + formid + " input").serialize();
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: val + '&act=proses&formid=' + formid,
                        success: function (data) {
                            if (data !== 'backtohome') {
                                var arrdata = data.split('|');
                                if (arrdata[0].trim() === 'MSG') {
                                    if (arrdata[1] === 'OK') {
                                        addNotif(arrdata[2]);
                                        if (arrdata.length > 3) {
                                            call(arrdata[3], arrdata[4]);
                                        }
                                    } else if (arrdata[1].trim().toUpperCase() === 'DIRECT') {
                                        addNotif(arrdata[2]);
                                        setTimeout(function () {
                                            window.location.href = arrdata[3];
                                        }, 1000);
                                    } else if (arrdata[1].trim().toUpperCase() === 'HASH') {
                                        addNotif(arrdata[2]);
                                        setTimeout(function () {
                                            window.location.hash = arrdata[3];
                                        }, 1000);
                                    }
                                } else {
                                    addNotif(data);
                                }
                            } else {
                                window.location.href = base_url;
                            }
                        }
                    });
                }, 
                function () {
                    return false;
                });
    }
    $("#tb_menu" + formid).val(0);
    //$("#msgConfirm").hide();
    return false;
}
function jConfirm(msg, title, confirmCallback, denyCallback) {
    $.jAlert({'type': 'confirm', 'title': title, 'content': msg,'size': {'height': '100px', 'width': '500px'},'theme':'green', 'onConfirm': confirmCallback, 'onDeny': denyCallback});
}
function tb_chkall(formid) {
    $("#" + formid).find(':checkbox').prop('checked', $("#tb_chkall" + formid).is(':checked'));
    $('#newtr').remove();
    if (!$("#tb_chkall" + formid).is(':checked')) {
        $("#" + formid + " input:checkbox:not(#tb_chkall" + formid + ")").parent().removeClass("selected");
    } else {
        $("#" + formid + " input:checkbox:not(#tb_chkall" + formid + ")").parent().addClass("selected");
    }
}
function tb_chk() {
    $('input:not(:checked)').parent().parent().removeClass("selected");
    $('input:checked').parent().parent().addClass("selected");
}
function tb_hals(formid, id) {
    form = $("#tb_menu" + formid).attr('formid');
    newhal = $(id).val();
    newhal++;
    redirect_url(newhal, form);
    return false;
}
function td_click(id) {
    $("#detils_bawah").html('<center><img src=\"' + base_url + 'img/_indicator.gif\" alt=\"\" /><br> Please wait ...</center>');
    $.ajax({
        type: 'POST',
        url: $(".tabelajax #bawah").attr('urldetil') + "/" + id,
        data: 'ajax=1',
        success: function (html) {
            $("#detils_bawah").html(html);
        }
    });
}
function redirect_url(newhal, formid) {
    newlocation = $("#" + formid).attr('action') + '/row/' + $("#tb_view").val() + '/page/' + newhal + '/order/' + $("#orderby").val() + '/' + $("#sortby").val();
    if ($("#tb_cari").val() != "")
        newlocation += '/search/' + $("#tb_keycari").val() + '/' + $("#tb_cari").val().replace('/', '');
    location.href = newlocation;
}
function tb_order(formid, divid, data, key, cari) {
    var action = $("#" + formid + " form").attr('action');
    if (!action) {
        var action = $("#" + formid + "hidden_action").val();
    }
    tb_pagging(action, divid, data, key, cari);
}
function tb_go(action, divid, hal, orderby, sortby, input, key, cari) {
    var value = $("#" + input).val();
    var data = "row|" + hal + '|page|' + value + '|order|' + orderby + '|' + sortby + '|';
   // alert(data + '|' + action);
    tb_pagging(action, divid, data, key, cari);
}
function tb_pagging(action, divid, data, key, cari) {
    var dtid = $("#" + key).find('option:selected').attr('tag');
    if (dtid == 'tag-tanggal') {
        var valueCari = 'Tag-Tanggal;' + $('#' + cari + '_tgl1').val() + ';' + $('#' + cari + '_tgl2').val();
    } else if (dtid == 'tag-tanggal-2field') {
        var valueCari = 'tag-tanggal-2field;' + $('#' + cari + '_tgl1').val() + ';' + $('#' + cari + '_tgl2').val();
    } else if (dtid == 'tag-select') {
        var valueCari = 'Tag-Select;' + $("#" + cari).val();
    } else {
        var valueCari = $("#" + cari).val();
    }
    
//    alert('ajax=1&uri=' + data + 'search|' + $("#" + key).val() + '|' + valueCari + '|');
    $.ajax({
        type: 'POST',
        url: action,
        data: 'ajax=1&uri=' + data + 'search|' + $("#" + key).val() + '|' + valueCari + '|',
        beforeSend: function () {
            loadingDialog();
        },
        complete: function () {
            clearLoadingDialog();
        },
        success: function (html) {
            $("#" + divid).html(html);
        }
    });
}
function tb_cari(action, divid, hal, orderby, sortby, input, cari, key) {
    var value = $("#" + input).val();
    var data = "row|" + hal + '|page|' + value + '|order|' + orderby + '|' + sortby + '|';
    tb_pagging(action, divid, data, key, cari);
}
function td_pilih(id) {
    var formName = $(id).attr('formField');//alert(arr[0]);
    var fIndexEdit = $(id).attr('keyPilih');
    var inputField = $(id).attr('field');
    var input = inputField.split(";");
    var val = fIndexEdit.split(";");
    for (var c = 0; c < (input.length) - 1; c++) {
        if (typeof ($("#" + input[c]).get(0)) == "undefined") {
            $.gritter.add({
                position: 'bottom-right',
                title: 'Error',
                text: 'Ada Elemen Form (' + input[c] + ') yang tak terdefinisi.\nMohon periksa script codenya.',
                class_name: 'clean'
            });
            return false;
            break;
        }
        var tipe = $("#" + input[c]).get(0).tagName;
        if (tipe === 'INPUT' || tipe === 'SELECT' || tipe === 'TEXTAREA') {
            $("#" + formName + " #" + input[c]).val(val[c]);
        } else if (tipe === 'SPAN') {
            $("#" + formName + " #" + input[c]).html(val[c]);
        } else {
            $("#" + formName + " #" + input[c]).val(val[c]);
        }
    }
    $('#Dialog-dokSRC').dialog('close');
    $("#" + input[0]).focus();
}
function pilih_page(urlChange, divId, divChange) {
    //alert(id);die();
    //alert(urlChange);return false;
    closedialog(divId);
    call(urlChange, divChange, '');
    return false;
}
function tb_search(tipe, inputField, title, formName, width, height, getelement) {
    var getdata = "";
    if (typeof (getelement) != "undefined") {
        var data = getelement.split(";");
        var arr = "";
        for (var a = 0; a < data.length - 1; a++) {
            if ($("#" + formName + " #" + data[a]).val() != "") {
                arr = arr + $("#" + formName + " #" + data[a]).val() + ";";
            }
        }
        if (arr != "")
            getdata = "/" + arr;
    }
    var dataAjax = tipe + "/" + inputField + "/" + formName + getdata;
    Dialog(site_url + '/search/getsearch/' + dataAjax, 'Dialog-dokSRC', title, width, height);
}
function td_detil_priview(id) {//alert(id);return false;
    var arr = id.split("|");
    var div = arr[0];
    var fIndexKey = arr[1];
    var val = fIndexKey.split(";");
    alert(div);
    return false;
    /*var val = fIndexEdit.split(";");*/
    if (div == "divmutasi_bb") {
        document.getElementById('frmLaporanMutBB').TANGGAL_AWAL.value = val[0];
        document.getElementById('frmLaporanMutBB').TANGGAL_AKHIR.value = val[1];
        LaporanList('frmLaporanMutBB', 'msg_laporan', 'divLapMutasiBB', 'divListMutasiBB', 'btnExitBB',
                '' + base_url + 'index.php/laporan/daftar_dok/mutasi_bb', 'laporan');
    } else if (div == "divmutasi_bj") {
        document.getElementById('frmLaporanMutBJ').TANGGAL_AWAL.value = val[0];
        document.getElementById('frmLaporanMutBJ').TANGGAL_AKHIR.value = val[1];
        LaporanList('frmLaporanMutBJ', 'msg_laporan', 'divLapMutasiBj', 'divListMutasiBj', 'btnExitBj',
                '' + base_url + 'index.php/laporan/daftar_dok/mutasi_bj', 'laporan');
    } else if (div == "divmutasi_bs") {
        document.getElementById('frmLaporanMutBS').TANGGAL_AWAL.value = val[0];
        document.getElementById('frmLaporanMutBS').TANGGAL_AKHIR.value = val[1];
        LaporanList('frmLaporanMutBS', 'msg_laporan', 'divLapMutasiBS', 'divListMutasiBS', 'btnExitBS',
                '' + base_url + 'index.php/laporan/daftar_dok/mutasi_bs', 'laporan');
    } else if (div == "divmutasi_ms") {
        document.getElementById('frmLaporanMutMS').TANGGAL_AWAL.value = val[0];
        document.getElementById('frmLaporanMutMS').TANGGAL_AKHIR.value = val[1];
        LaporanList('frmLaporanMutMS', 'msg_laporan', 'divLapMutasiMS', 'divListMutasiMS', 'btnExitMS',
                '' + base_url + 'index.php/laporan/daftar_dok/mutasi_bs', 'laporan');
    }
}
function td_detil_priview_bottom(id, thisid) {
    $("tr").removeClass("selected");
    $(thisid).addClass("selected");
    var obj = $(thisid).next().attr("id");
    if (obj == "newtr") {
        $('#newtr').remove();
        $(thisid).removeClass("selected");
    } else {
        if ($(thisid).attr('urldetil')) {
            if ($(thisid).attr('urldetil') != "") {
                $('#newtr').remove();
                var jmltd = $('td', $(thisid)).length;
                if ($(".tabelajax input:checkbox").length > 0) {
                    jmltd--;
                }
                $(thisid).after('<tr id="newtr"><td id="filltd" colspan="' + (jmltd + 1) + '"></td></tr>');
                call($(thisid).attr('urldetil'), 'filltd', '');
                //$('#filltd').html($(thisid).attr('urldetil'));
                //$('#filltd').load($(thisid).attr('urldetil'));
            }
        }
        return false;
    }
}
function td_detil_priview_blank(id, thisid) {
    var url = $(thisid).attr('urldetil');
    var key = $(thisid).attr('keyz');
    var id = multiReplaces(key, '.', '/');
    if ($(thisid).attr('urldetil')) {
        location.href = $(thisid).attr('urldetil') + '/' + id;
    }
    return false;
}
function multiReplaces(str, match, repl) {
    do {
        str = str.replace(match, repl);
    } while (str.indexOf(match) !== -1);
    return str;
}
function c_dialog(id, title, inner, width, height, clobtn, modal, resize) {
    $('#' + id).remove();
    c_div(id, '<div style="margin:10px;">' + inner + '</div>');
    $("#" + id).dialog({
        bgiframe: true,
        resizable: false,
        autoOpen: true,
        modal: modal,
        title: title,
        height: height,
        width: width,
        resize: resize,
        clobtn: clobtn,
        draggable: true,
        overlay: {backgroundColor: '#000', opacity: 0.1, height: '100%'},
        show: {effect: 'fade', direction: "up"},
        hide: {effect: 'fade', direction: "up"}
    });
}
function c_div(id, inner) {
    div = document.createElement("div");
    div.innerHTML = '<div id="' + id + '" style="display: none;">' + inner + '</div>';
    document.body.appendChild(div);
}
function ShowDP(obj_date) {
    if (!$("#" + obj_date).is('[readonly]')) {
        $("#" + obj_date).datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    }
    return false;
}