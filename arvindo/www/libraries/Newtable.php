<?php

error_reporting(E_ERROR);
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Newtable {

    var $rows = array();
    var $columns = array();
    var $hiderows = array();
    var $keys = array();
    var $proses = array();
    var $keycari = array();
    var $heading = array();
    #var $align = array(); //akan di edit nanti sebagai align per row
    var $auto_heading = TRUE;
    var $show_chk = TRUE;
    var $show_menu = FALSE;
    var $show_no = TRUE;
    var $caption = NULL;
    var $template = NULL;
    var $newline = "\n";
    var $empty_cells = "";
    var $separator = "/";
    var $actions = "";
    var $detils = "";
    var $detils_tipe = "";
    var $td_click = "";
    var $baris = "AUTO";
    var $db = "";
    var $hal = "AUTO";
    var $uri = "";
    var $show_search = TRUE;
    var $orderby = 1;
    var $sortby = "ASC";
    var $formid = "tb_form";
    var $divid = "div_id";
    var $row_process = "";
    var $indexField = "";
    var $formField = "";
    var $get_where = "";
    var $tipe_proses = "";
    var $check = "checkbox";
    var $show_paging = TRUE;
    var $field_order = TRUE;
    var $tb_order = '';
    var $having = '';
    var $divChange = '';
    var $cmbJmlData = TRUE;

    function Newtable() {
        $this->hiderows[] = 'HAL';
    }

    function show_search($show) {
        $this->show_search = $show;
        return;
    }

    function show_paging($show) {
        $this->show_paging = $show;
        return;
    }

    function field_order($show) {
        $this->field_order = $show;
        return;
    }

    function having($statement) {
        $this->having = rtrim($statement);
    }

    function show_chk($show) {
        $this->show_chk = $show;
        return;
    }

    function show_menu($show) {
        $this->show_menu = $show;
        return;
    }

    function tipe_proses($show) {
        $this->tipe_proses = $show;
        return;
    }

    function show_no($show) {
        $this->show_no = $show;
        return;
    }

    function columns($col) {
        $this->columns = $col;
        return;
    }

    function orderby($order) {
        $this->orderby = $order;
        return;
    }

    function sortby($sort) {
        $this->sortby = $sort;
        return;
    }

    function topage($to) {
        $this->hal = (int) $to;
        return;
    }

    function cidb($db) {
        $this->db = $db;
        return;
    }

    function rowcount($row) {
        $this->baris = $row;
        return;
    }

    function ciuri($uri) {
        $this->uri = $uri;
        return;
    }

    function action($act) {
        $this->actions = $act;
        return;
    }

    function detail($act) {
        $this->detils = $act;
        return;
    }

    function detail_tipe($act, $td = '') {
        $this->detils_tipe = $act;
        $this->td_click = $td;
        return;
    }

    function formField($act) {
        $this->formField = $act;
        return;
    }

    function divChange($act) {
        $this->divChange = $act;
        return;
    }

    function indexField($row) {
        if (!is_array($row)) {
            $row = array($row);
        }
        foreach ($row as $a) {
            if (!in_array($a, $this->indexField))
                $this->indexField[] = $a;
        }
        return;
    }

    function hiddens($row) {
        if (!is_array($row)) {
            $row = array($row);
        }
        foreach ($row as $a) {
            if (!in_array($a, $this->hiderows))
                $this->hiderows[] = $a;
        }
        return;
    }

    function keys($row) {
        if (!is_array($row)) {
            $row = array($row);
        }
        foreach ($row as $a) {
            if (!in_array($a, $this->keys))
                $this->keys[] = $a;
        }
        return;
    }

    function group($row) {
        if (!is_array($row)) {
            $row = array($row);
        }
        foreach ($row as $a) {
            if (!in_array($a, $this->group))
                $this->group[] = $a;
        }
        return;
    }

    function menu($row) {
        if (!is_array($row)) {
            return FALSE;
        }
        $this->proses = $row;
        return;
    }

    function search($row) {
        if (!is_array($row)) {
            return FALSE;
        }
        $this->keycari = $row;
        return;
    }

    function tipe_check($type) {
        if ($type == "radio") {
            $this->check = "radio";
        }
        else {
            $this->check = "checkbox";
        }
        return;
    }

    function set_template($template) {
        if (!is_array($template))
            return FALSE;
        $this->template = $template;
    }

    function set_heading() {
        $args = func_get_args();
        $this->heading = (is_array($args[0])) ? $args[0] : $args;
    }

    function make_columns($array = array(), $col_limit = 0) {
        if (!is_array($array) OR count($array) == 0)
            return FALSE;
        $this->auto_heading = FALSE;
        if ($col_limit == 0)
            return $array;
        $new = array();
        while (count($array) > 0) {
            $temp = array_splice($array, 0, $col_limit);
            if (count($temp) < $col_limit) {
                for ($i = count($temp); $i < $col_limit; $i++) {
                    $temp[] = '&nbsp;';
                }
            }
            $new[] = $temp;
        }
        return $new;
    }

    function set_empty($value) {
        $this->empty_cells = $value;
    }

    function add_row() {
        $args = func_get_args();
        $this->rows[] = (is_array($args[0])) ? $args[0] : $args;
    }

    function set_caption($caption) {
        $this->caption = $caption;
    }

    function set_formid($formid) {
        if ($formid)
            $this->formid = $formid;
        else
            $this->formid = 'tb_form';
    }

    function set_divid($divid) {
        if ($divid)
            $this->divid = $divid;
        else
            $this->divid = 'div_id';
    }

    function set_align($align) {
        $this->align = $align;
    }

    function cmbJmlData($cmbJmlData) {
        $this->cmbJmlData = $cmbJmlData;
    }

    function generate($table_data = NULL) {
        if (!is_null($table_data)) {
            if (is_object($table_data)) {
                $this->_set_from_object($table_data);
            }
            elseif (is_array($table_data)) {
                $set_heading = (count($this->heading) == 0 AND $this->auto_heading == FALSE) ? FALSE : TRUE;
                $this->_set_from_array($table_data, $set_heading);
            }
            elseif ($table_data != "") {
                #echo $this->uri;
                if ($_SESSION['uri']['table'] == $this->formid) {
                    if ($this->uri == '') {
                        $this->uri = $_SESSION['uri']['uri'];
                    }
                    else {
                        $_SESSION['uri']['uri'] = $this->uri;
                    }
                }
                else {
                    unset($_SESSION['uri']);
                    $_SESSION['uri']['table'] = $this->formid;
                    $_SESSION['uri']['uri'] = $this->uri;
                }
                if (!is_array($this->uri)) {
                    $this->uri = explode("|", $this->uri);
                }
                if ($this->db == "" || !is_array($this->uri))
                    return 'Missing required params';
                $terkunci = "";
                $cari = "";
                if ($key = array_search('search', $this->uri)) {
                    $strKey = $this->uri[$key + 1];
                    $strCari = $this->uri[$key + 2];
                    $arrKey = explode('~', $strKey);
                    $arrCariAll = explode('~', $strCari);
                    $tercari = '';
                    $br = '';
                    foreach ($arrKey as $k => $v) {
                        $terkunci = $this->keycari[$v];
                        $arrCari = explode(';', str_replace("'", "''", $arrCariAll[$k]));
                        switch (strtolower($terkunci[2])) {
                            case'tag-select':
                                if ($arrCari[0] != '') {
                                    $tercari[] = $terkunci[0] . " = '" . $arrCari[1] . "'";
                                    $msgSrc .= $br . '<div class="label label-warning"><span class="icon-off" title="Hapus filter pencarian berdasarkan ' . $terkunci[1] . '" style="cursor: pointer; cursor: hand;" OnClick="tb_clearby(\'' . $this->actions . '\', \'' . $this->divid . '\', \'' . $this->baris . '\',\'' . $this->orderby . '\', \'' . $this->sortby . '\',\'tb_hal' . $this->formid . '\',\'tb_keycari' . $this->formid . '\',\'tb_cari' . $this->formid . '\',\'' . $k . '\');return false;"></span></div> "' . $terkunci[1] . '" dengan kata kunci "' . $terkunci[3][$arrCari[1]] . '"';
                                }

                                break;
                            case'tag-tanggal':
                                if ($arrCari[1] != '' && $arrCari[2] != '') {
                                    $tercari[] = "STR_TO_DATE(" . $terkunci[0] . ",'%Y-%m-%d') BETWEEN '" . $arrCari[1] . "' AND '" . $arrCari[2] . "'";
                                    $msgSrc .= $br . '<div class="label label-warning"><span class="icon-off" title="Hapus filter pencarian berdasarkan ' . $terkunci[1] . '" style="cursor: pointer; cursor: hand;" OnClick="tb_clearby(\'' . $this->actions . '\', \'' . $this->divid . '\', \'' . $this->baris . '\',\'' . $this->orderby . '\', \'' . $this->sortby . '\',\'tb_hal' . $this->formid . '\',\'tb_keycari' . $this->formid . '\',\'tb_cari' . $this->formid . '\',\'' . $k . '\');return false;"></span></div> "' . $terkunci[1] . '" dari "' . $arrCari[1] . '" s/d "' . $arrCari[2] . '"';
                                }
                                break;
                            case'tag-tanggal-2field':
                                if ($arrCari[0] != '' && $arrCari[1] != '') {
                                    $arrTerkunci = explode(";", $terkunci[0]);
                                    $tercari[] = "STR_TO_DATE(" . $arrTerkunci[0] . ",'%Y-%m-%d') > '" . $arrCari[0] . "' AND STR_TO_DATE(" . $arrTerkunci[1] . ",'%Y-%m-%d') < '" . $arrCari[1] . "'";
                                    $msgSrc .= $br . '<i class="fa fa-times-circle-o" style="cursor: pointer; cursor: hand;" OnClick="tb_clearby(\'' . $this->actions . '\', \'' . $this->divid . '\', \'' . $this->baris . '\',\'' . $this->orderby . '\', \'' . $this->sortby . '\',\'tb_hal' . $this->formid . '\',\'tb_keycari' . $this->formid . '\',\'tb_cari' . $this->formid . '\',\'' . $k . '\');return false;"></i> "' . $terkunci[1] . '" dari "' . $arrCari[0] . '" s/d "' . $arrCari[1] . '"';
                                }
                                break;
                            default :
                                if ($arrCari[0] != '') {
                                    $tercari[] = $terkunci[0] . " LIKE '%$arrCari[0]%'";
                                    $msgSrc .= $br . '<div class="label label-warning"><span class="icon-off" title="Hapus filter pencarian berdasarkan ' . $terkunci[1] . '" style="cursor: pointer; cursor: hand;" OnClick="tb_clearby(\'' . $this->actions . '\', \'' . $this->divid . '\', \'' . $this->baris . '\',\'' . $this->orderby . '\', \'' . $this->sortby . '\',\'tb_hal' . $this->formid . '\',\'tb_keycari' . $this->formid . '\',\'tb_cari' . $this->formid . '\',\'' . $k . '\');return false;"></span></div> <b>' . $terkunci[1] . '</b> dengan kata kunci <b>' . $arrCari[0] . '</b>';
                                }
                                break;
                        }
                        $br = '<p style="padding: 2px;"></p>';
                    }
                    $tercari = implode(' AND ', $tercari);
                    $arrCari0 = $arrCari[1];
                    $arrCari1 = $arrCari[2];
                    $kunci = $v;
                }
                if ($this->baris == "AUTO") {
                    $this->baris = $this->uri[(int) array_search('row', $this->uri) + 1];
                    if ($this->baris < 1)
                        $this->baris = 10;
                }
                if ($tercari != "") {
                    $ada = strpos(strtolower($table_data), "where");
                    if ($ada === false)
                        $table_data .= " WHERE $tercari";
                    else
                        $table_data .= " AND $tercari";
                }

                if ($this->group) {
                    $komax = "";
                    $group = "";
                    foreach ($this->group as $a) {
                        $group .= $komax . $a;
                        $komax = ",";
                    }
                    $table_data .= " GROUP BY " . $group;
                }

                if ($this->having != '') {
                    $table_data .= ' ' . $this->having;
                }


                $total_record = 0;
                $table_count = $this->db->query("SELECT COUNT(*) AS JML FROM ($table_data) AS TBL");
                if ($table_count) {
                    $table_count = $table_count->row();
                    $total_record = $table_count = $table_count->JML;
                }
                else {
                    $total_record = 0;
                }

                if ($this->baris != "ALL") {
                    $table_count = ceil($table_count / $this->baris);
                    if ($this->hal == "AUTO")
                        if ($key = array_search('page', $this->uri))
                            $this->hal = (int) $this->uri[$key + 1];
                    if ($this->hal < 1)
                        $this->hal = 1;
                    if ($this->hal > $table_count)
                        $this->hal = $table_count;
                    if ($this->hal <= 1) {
                        $dari = 0;
                        $sampai = $this->baris;
                    }
                    else {
                        $dari = ($this->hal - 1) * $this->baris;
                        $sampai = $this->baris;
                    }


                    if ($key == array_search('order', $this->uri)) {
                        $odb = $this->orderby;
                        $this->orderby = $this->uri[$key + 1];
                        $this->sortby = $this->uri[$key + 2];
                        $orderby = "$this->orderby $this->sortby";
                        if($key == ''){
                            $orderby = $odb;
                        }
                    }
                    else {
                        $orderby = "$this->orderby $this->sortby";
                    }
                    $table_data .= " ORDER BY $orderby LIMIT $dari, $sampai";
                }
//                print ($table_data);
                $table_data = $this->db->query($table_data);
                $this->_set_from_object($table_data);
                #print($table_data); //die();
            }
        }

        if (count($this->heading) == 0 AND count($this->rows) == 0) {
            return 'Undefined table data';
        }

        $this->_compile_template();
        $out = '<span id="' . $this->divid . '">';
        if ($this->show_search || $this->show_chk || $this->show_no || $this->show_menu) {
            if ($this->detils_tipe == "pilih")
                $colspan = count($this->heading) + 1;
            else
                $colspan = count($this->heading);

            $out .= $this->template['table_open'] . '<form id="' . $this->formid . '" name="' . $this->formid . '"  action="' . $this->actions . '">';
            $out .= '<input type="hidden" value="' . $this->actions . '" id="' . $this->formid . 'hidden_action">';
            $out .= '<tr class="head"><th colspan="' . $colspan . '">&nbsp;';
        }
        else {
            $out .= $this->template['table_open'] . '<form id="' . $this->formid . '" name="' . $this->formid . '" action="' . $this->actions . '">';
            $out .= "<div id=\"" . $this->divid . "\">";
        }
        $out .= '<input type="hidden" id="orderby" value="' . $this->orderby . '">'
                . '<input type="hidden" id="sortby" value="' . $this->sortby . '">';
        if (count($this->proses) > 0 && ($this->show_chk || $this->show_menu)) {
            $m = 0;
            if ($this->tipe_proses == "button") {
                foreach ($this->proses as $a => $b) {
                    $out .= '<button onClick="tb_menu(\'' . $this->formid . '\',this.id);return false;" id="tb_menu' . $this->formid . $m . '" formid="' . $this->formid . '" title="' . $a . '" met="' . $b[0] . '" url="' . $b[1] . '" jml="' . $b[2] . '" div="' . $this->divid . '" content="' . $b[3] . '" title="' . $a . '" class="btn btn-navy btn-sm"> ' . $b[4] . ' ' . $a . ' </button>&nbsp;';
                    $m++;
                }
            }
            else {
                $out .= '<div class="btn-group" title="Pilih proses yang akan dijalankan">'
                        . '<button type="button" class="btn btn-navy dropdown-toggle btn-md" data-toggle="dropdown">'
                        . 'Pilih Proses <span class="caret"> </span></button>'
                        . '<ul class="dropdown-menu" role="menu">';
                foreach ($this->proses as $a => $b) {
                    $out .= '<li onClick="tb_menu(\'' . $this->formid . '\',this.id);return false;" id="tb_menu' . $this->formid . $m . '" formid="' . $this->formid . '" title="' . $a . '" met="' . $b[0] . '" url="' . $b[1] . '" jml="' . $b[2] . '" div="' . $this->divid . '" content="' . $b[3] . '" title="' . $a . '"><a>' . $a . ' </a></li>';
                    $m++;
                }
                $out .= '</ul></div>';
            }
            $out .= ' &nbsp;<label id="labelload' . $this->formid . '" class="labelload">Loading...</label>';
        }
        if (count($this->rows) == 0) {
            $disabled = "";
        }
        if ($this->show_search) {
            $out .= '<span class="right">Cari <select id="tb_keycari' . $this->formid . '" title="Pilih kategori yang akan dicari" ' . $disabled . ' onChange="TagChange' . $this->formid . '(this.id,\'b\' )">';
            $valcr = '';
            foreach ($this->keycari as $a => $b) {
                if ($kunci == $a)
                    $out .= '<option selected value="';
                else
                    $out .= '<option value="';
                $out .= $a . '" tag="' . strtolower($b[2]) . '">' . $b[1] . '</option>';
                switch ($b[2]) {
                    case'tag-select':
                        $valcr .= ' a[' . $a . '] = \'' . form_dropdown('', $b[3], $arrCari0, 'id="tb_cari' . $this->formid . '" class="tb_text"') . '\';';
                        break;
                    case'tag-tanggal':
                        $valcr .= ' a[' . $a . '] = \'<input type="text" class="tb_text tgl" id="tb_cari' . $this->formid . '_tgl1" title="Masukkan tanggal" onmouseover="ShowDP(this.id);" onfocus="ShowDP(this.id);" value="' . $arrCari0 . '"/>&nbsp;s/d&nbsp;<input type="text" class="tb_text tgl" id="tb_cari' . $this->formid . '_tgl2" title="Masukkan tanggal" onmouseover="ShowDP(this.id);" onfocus="ShowDP(this.id);" value="' . $arrCari1 . '"/>\';';
                        break;
                    case'tag-tanggal-2field':
                        $valcr .= ' a[' . $a . '] = \'<input type="text" class="tb_text tgl" id="tb_cari' . $this->formid . '_tgl1" title="Masukkan tanggal" onmouseover="ShowDP(this.id);" onfocus="ShowDP(this.id);" value="' . $arrCari0 . '"/>&nbsp;s/d&nbsp;<input type="text" class="tb_text tgl" id="tb_cari' . $this->formid . '_tgl2" title="Masukkan tanggal" onmouseover="ShowDP(this.id);" onfocus="ShowDP(this.id);" value="' . $arrCari1 . '"/>\';';
                        break;
                    default :
                        $valcr .= ' a[' . $a . '] = \'<input type="text" class="tb_text" id="tb_cari' . $this->formid . '" title="Masukkan kata kunci yang ingin dicari" ' . $disabled . ' value="' . $arrCari0 . '" onKeyPress="enter(event, this.id, 1)" />\';';
                        break;
                }
            }
            $out .= '</select>';
            $out .= '&nbsp;<b id="TagChange' . $this->formid . '"></b>';
            $out .= " <button id=\"btn_cari" . $this->formid . "\" class=\"btn btn-navy btn-ms\" OnClick=\"tb_cari('" . $this->actions . "', '" . $this->divid . "', '" . $this->baris . "','" . $this->orderby . "', '" . $this->sortby . "','tb_hal" . $this->formid . "','tb_cari" . $this->formid . "','tb_keycari" . $this->formid . "');return false;\"> <i class=\"fa fa-search favicon\"></i> Cari </button> ";
            if ($msgSrc != '') {
                $out .= '<br><div style="width: 100%"><div class="alert alert-warning" style="margin: 3px;padding: 7px;">Filter Pencarian:<br><button style="float: right; cursor: pointer;" class="btn btn-xs btn-danger" data-dismiss="alert" OnClick="tb_clear(\'' . $this->actions . '\', \'' . $this->divid . '\', \'' . $this->baris . '\',\'' . $this->orderby . '\', \'' . $this->sortby . '\',\'tb_hal' . $this->formid . '\',\'tb_keycari' . $this->formid . '\',\'tb_cari' . $this->formid . '\');return false;" type="button">&times;</button>' . $msgSrc . '</div></div>';
            }
            $out .= '<input type="hidden" id="kumpultb_keycari' . $this->formid . '" value="' . $strKey . '">'
                    . '<input type="hidden" id="kumpultb_cari' . $this->formid . '" value="' . $strCari . '">';
            $out .= '</span>';
            $out .= "<script>
                        TagChange" . $this->formid . "('tb_keycari" . $this->formid . "','a');
                        function TagChange" . $this->formid . "(id, ac){
                            var a = new Array();
                            " . $valcr . "
                            $('#TagChange" . $this->formid . "').html(a[$('#'+id).find('option:selected').val()]);
                            if(ac === 'b'){
                                if($('#'+id).find('option:selected').attr('tag') === 'tag-select'){ $('#tb_cari" . $this->formid . "').val($('#tb_cari" . $this->formid . " option:first').val());} else if ($('#'+id).find('option:selected').attr('tag') === 'tag-tanggal' || $('#'+id).find('option:selected').attr('tag') === 'tag-tanggal-2field'){ $('#tb_cari" . $this->formid . "_tgl1').val(''); $('#tb_cari" . $this->formid . "_tgl2').val(''); } else{ $('#tb_cari" . $this->formid . "').val(''); }
                            }
                        }
                     </script>";
        }
        else {
            $out .= '<input type="hidden" id="tb_keycari' . $this->formid . '"><input type="hidden" id="tb_cari' . $this->formid . '">';
        }
        if ($this->show_search || $this->show_chk || $this->show_no || $this->show_menu) {
            $out .= '</th></tr>';
        }
        if ($this->caption) {
            $out .= $this->newline;
            $out .= '<caption>' . $this->caption . '</caption>';
            $out .= $this->newline;
        }

        if (count($this->rows) > 0) {
            if (count($this->heading) > 0) {
                $out .= $this->template['heading_row_start'];
                $out .= $this->newline;
                foreach ($this->heading as $z => $heading) {
                    $z;
                    if (!in_array($heading, $this->hiderows)) {
                        if ($z == 0 && $this->show_no) {
                            $out .= '<th width="1">';
                            $out .= $heading;
                        }
                        elseif ($z == 1 && $this->show_chk) {
                            $out .= '<th width="22">';
                            $out .= $heading;
                        }
                        else {
                            if ($this->show_chk) {
                                $z--;
                            }
                            $out .= $this->template['heading_cell_start'];
                            if ($this->baris != "ALL") {
                                if ($z == $this->orderby) {
                                    if ($this->sortby == "ASC") {
                                        $indexData = 'row|' . $this->baris . '|page|' . $this->hal . '|order|' . $z . '|DESC|';
                                        if ($this->field_order) {
                                            $this->tb_order = "onclick=\"tb_order('" . $this->formid . "','" . $this->divid . "','" . $indexData . "','tb_keycari" . $this->formid . "', 'tb_cari" . $this->formid . "')\"";
                                        }
                                        $out .= "<span " . $this->tb_order . " class=\"order\" title=\"Urutkan Data berdasarkan " . $heading . " (Z-A)\" orderby=\"$z\" sortby=\"DESC\">" . $heading . "</span>"; #ucwords(strtolower($heading))
                                    }
                                    else {
                                        $indexData = 'row|' . $this->baris . '|page|' . $this->hal . '|order|' . $z . '|ASC|';
                                        if ($this->field_order) {
                                            $this->tb_order = "onclick=\"tb_order('" . $this->formid . "','" . $this->divid . "','" . $indexData . "','tb_keycari" . $this->formid . "', 'tb_cari" . $this->formid . "')\"";
                                        }
                                        $out .= "<span " . $this->tb_order . " class=\"order\" title=\"Urutkan Data berdasarkan " . $heading . " (A-Z)\" orderby=\"$z\" sortby=\"ASC\">" . $heading . "</span>"; #ucwords(strtolower($heading))
                                    }
                                }
                                else {
                                    $indexData = 'row|' . $this->baris . '|page|' . $this->hal . '|order|' . $z . '|ASC|';
                                    if ($this->field_order) {
                                        $this->tb_order = "onclick=\"tb_order('" . $this->formid . "','" . $this->divid . "','" . $indexData . "','tb_keycari" . $this->formid . "', 'tb_cari" . $this->formid . "')\"";
                                    }
                                    $out .= "<span " . $this->tb_order . " class=\"order\" title=\"Urutkan Data berdasarkan " . $heading . " (A-Z)\" orderby=\"$z\" sortby=\"ASC\">" . $heading . "</span>";
                                }
                            }
                            else {
                                $out .= "<span class=\"order\" orderby=\"$z\" sortby=\"ASC\">" . $heading . "</span>";
                            }
                        }
                        $out .= $this->template['heading_cell_end'];
                    }
                }
                if ($this->detils_tipe == "pilih") {
                    $out .= '<th width="22">&nbsp;</th>';
                }
                $out .= $this->template['heading_row_end'];
                $out .= $this->newline;
            }
        }
        else {
            $out .= "";
        }

        if (count($this->rows) > 0) {

            if ($this->hal <= 1)
                $x = 1;
            else
                $x = ($this->hal - 1) * $this->baris + 1;

            $i = 1;
            $cls = "odd";
            foreach ($this->rows as $row) {
                if (!is_array($row)) {
                    break;
                }
                #$style
                $keyz = "";
                $koma = "";
                $keypilih = "";
                $keypilihOri = "";
                $batas = "";
                foreach ($this->keys as $a) {
                    $keyz .= $koma . $row[$a];
                    $koma = $this->separator;
                    $keypilih .= $batas . $row[$a];
                    $keypilihOri .= $batas . $row[$a];
                    $batas = ";";
                }
                $keypilih = trim(preg_replace('/\s\s+/', ' ', htmlspecialchars($keypilih, ENT_QUOTES, 'UTF-8')));
                $name = (fmod($i++, 2)) ? '' : 'alt_';
                $field = "";
                foreach ($this->indexField as $b) {
                    $field .= $b . ";";
                }
                if ($this->detils == "") {
                    if ($this->detils_tipe == "pilih") {
                        $out .= "<tr title=\"Klik untuk memilih data\" id=\"pilih\" onmouseover=\"$(this).addClass('hilite');\" onmouseout=\"$(this).removeClass('hilite');\">";
                    }
                    elseif ($this->detils_tipe == "detil_priview") {
                        $out .= "<tr title=\"Klik untuk preview\" id=\"pilih\" onmouseover=\"$(this).addClass('hilite');\" onmouseout=\"$(this).removeClass('hilite');\" onclick=\"td_detil_priview('" . $this->divid . "|" . $keypilih . "')\" class=\"pointer\">";
                    }
                    else {
                        $out .= "<tr urldetil=\"\" onmouseover=\"$(this).addClass('hilite');\" onmouseout=\"$(this).removeClass('hilite');\" >";
                    }
                }
                else {
                    if ($this->detils_tipe == "bawah") {
                        $out .= "<tr title=\"Klik untuk menampilkan detil data\" id=\"bawah\" urldetil=\"" . $this->detils . "\" onmouseover=\"$(this).addClass('hilite');\" onmouseout=\"$(this).removeClass('hilite');\" onclick=\"td_click('" . $keyz . "')\" style=\"cursor:pointer\">";
                    }
                    else if ($this->detils_tipe == "pilih") {
                        $out .= "<tr title=\"Klik untuk memilih data\" id=\"pilih\" onmouseover=\"$(this).addClass('hilite');\" onmouseout=\"$(this).removeClass('hilite');\"";
                    }
                    elseif ($this->detils_tipe == "detil_priview") {//die('tes');
                        $out .= "<tr title=\"Double Klik untuk priv\" urldetil=\"" . $this->detils . "/" . $keyz . "\" id=\"detil_priview\" onmouseover=\"$(this).addClass('hilite');\" onmouseout=\"$(this).removeClass('hilite');\" ondblclick=\"td_detil_priview('" . $this->divid . "|" . $keypilih . "',this);\" style=\"cursor:pointer\">";
                    }
                    elseif ($this->detils_tipe == "detil_priview_bottom") {
                        $out .= "<tr title=\"Double Klik untuk melihat detil\" urldetil=\"" . $this->detils . "/" . $keyz . "\" id=\"detil_priview" . $this->formid . "\" onmouseover=\"$(this).addClass('hilite');\" onmouseout=\"$(this).removeClass('hilite');\" ondblclick=\"td_detil_priview_bottom('" . $this->divid . "|" . $keypilih . "',this)\" style=\"cursor:pointer\">";
                    }
                    elseif ($this->detils_tipe == "detil_priview_blank") {
                        $out .= "<tr title=\"Double Klik untuk preview\" urldetil=\"" . $this->detils . "\" keyz=\"" . $keyz . "\" id=\"detil_priview\" onmouseover=\"$(this).addClass('hilite');\" onmouseout=\"$(this).removeClass('hilite');\" ondblclick=\"td_detil_priview_blank('" . $this->divid . "|" . $keypilih . "',this)\" style=\"cursor:pointer\">";
                    }
                    else {
                        $out .= "<tr title=\"Klik Kanan untuk menampilkan detil data\" urldetil=\"" . $this->detils . "/" . $keyz . "\" onmouseover=\"$(this).addClass('hilite');\" onmouseout=\"$(this).removeClass('hilite');\" >";
                    }
                }
                #print_r($this->newline);die();
                $out .= $this->newline;

                if ($cls == "odd") {
                    $cels = $this->template['cell_alt'];
                }
                else {
                    $cels = $this->template['cell_odd'];
                }
                if ($this->show_no) {
                    $out .= $cels . $x . '</td>';
                }
                if ($this->show_chk)
                    $out .= $cels . "<input type=\"" . $this->check . "\" name=\"tb_chk" . $this->formid . "[]\" id=\"tb_chk" . $this->formid . "\" class=\"tb_chk\" value=\"" . $keyz . "\" onclick=\"tb_chk()\"/></td>";
                foreach ($row as $rowz => $cell) {
                    if (!in_array($rowz, $this->hiderows)) {
                        $out .= $cels;
                        if ($cell === '') {
                            $out .= $this->empty_cells;
                        }
                        else {
                            $out .= $cell;
                        }
                        $out .= $this->template['cell_' . $name . 'end'];
                    }
                }
                if ($this->detils_tipe == "pilih") {
                    $out .= $cels . "<button name=\"pilih" . $this->formid . "\" id=\"pilih" . $this->formid . "\" class=\"btn btn-success btn-xs\" formField=\"" . $this->formField . "\" keyPilih=\"" . $keypilihOri . "\" field=\"" . $field . "\" onclick=\"td_pilih(this);\"> Pilih </button></td>";
                }
                elseif ($this->detils_tipe == "pilih_page") {
                    $out .= $cels . "<button name=\"pilih_page" . $this->formid . "\" id=\"pilih_page" . $this->formid . "\" class=\"btn btn-success btn-xs\" onclick=\"pilih_page('" . $keypilih . "','" . $this->divid . "','" . $this->divChange . "');\"> Pilih </button></td>";
                }

                $out .= $this->template['row_' . $name . 'end'];
                $out .= $this->newline;
                $x++;
                if ($cls == "alt") {
                    $cls = "odd";
                }
                elseif ($cls == "odd") {
                    $cls = "alt";
                }
            }
        }
        else {
            $out .= '<tr><td colspan="' . count($this->heading) . '" align="center" style="background:#FFFFFF">Data Tidak Ditemukan</td></tr>';
        }
        if ($this->baris != "ALL" && $this->show_paging) {

            $datast = ($this->hal - 1);
            if ($datast < 1)
                $datast = 1;
            else
                $datast = $datast * $this->baris + 1;
            $dataen = $datast + $this->baris - 1;
            if ($total_record < $dataen)
                $dataen = $total_record;
            if ($total_record == 0)
                $datast = 0;

            if ($this->detils_tipe == "pilih")
                $colspan = count($this->heading) + 1;
            else
                $colspan = count($this->heading);


            $select[$this->baris] = 'selected';
            #
            $out .= '<tr class="head"><th colspan="' . $colspan . '">';
            if ($this->cmbJmlData) {
                $out .= "<select onchange=\"tb_go('" . $this->actions . "', '" . $this->divid . "', $(this).val(),'" . $this->orderby . "', '" . $this->sortby . "','tb_hal" . $this->formid . "', 'tb_keycari" . $this->formid . "', 'tb_cari" . $this->formid . "');return false;\" title='Pilih jumlah data yang ingin ditampilkan kemudian'><option value='10' " . $select[10] . ">10</option><option value='25' " . $select[25] . ">25</option><option value='50' " . $select[50] . ">50</option><option value='100' " . $select[100] . ">100</option></select>";
                $out .= '&nbsp;' . $this->baris . ' Data Per Halaman. Menampilkan ' . $datast . ' - ' . $dataen . ' Dari ' . $total_record . ' Data.';
            }
            else {
                $out .= 'Menampilkan ' . $datast . ' - ' . $dataen . ' Dari ' . $total_record . ' Data.';
            }



            if ($total_record > $this->baris) {
                $prev = $this->hal - 1;
                $next = $this->hal + 1;
                $firsAjax = 'row|' . $this->baris . '|page|1|order|' . $this->orderby . '|' . $this->sortby . '|';
                $prevAjax = 'row|' . $this->baris . '|page|' . $prev . '|order|' . $this->orderby . '|' . $this->sortby . '|';
                $nextAjax = 'row|' . $this->baris . '|page|' . $next . '|order|' . $this->orderby . '|' . $this->sortby . '|';
                $lastAjax = 'row|' . $this->baris . '|page|' . $total_record . '|order|' . $this->orderby . '|' . $this->sortby . '|';
                $firsExec = "tb_pagging('" . $this->actions . "', '" . $this->divid . "', '" . $firsAjax . "', 'tb_keycari" . $this->formid . "', 'tb_cari" . $this->formid . "','');";
                $prevExec = "tb_pagging('" . $this->actions . "', '" . $this->divid . "', '" . $prevAjax . "', 'tb_keycari" . $this->formid . "', 'tb_cari" . $this->formid . "','');";
                $nextExec = "tb_pagging('" . $this->actions . "', '" . $this->divid . "', '" . $nextAjax . "', 'tb_keycari" . $this->formid . "', 'tb_cari" . $this->formid . "','');";
                $lastExec = "tb_pagging('" . $this->actions . "', '" . $this->divid . "', '" . $lastAjax . "', 'tb_keycari" . $this->formid . "', 'tb_cari" . $this->formid . "','');";
                $out .= "<span class='right'>";
                if ($this->hal != "1") {
                    $out .= "<a href=\"javascript:void(0)\" onclick=\"" . $firsExec . "\" title=\"First\" class=\"paging\">&laquo;</a>&nbsp;";
                    $out .= "<a href=\"javascript:void(0)\" onclick=\"" . $prevExec . "\" title=\"Prev\" class=\"paging\">&lsaquo;&nbsp;</a>&nbsp;";
                }
                else {
                    $out .= "<font class=\"pdisabled\">&laquo;</font>&nbsp;";
                    $out .= "<font class=\"pdisabled\">&lsaquo;&nbsp;</font>&nbsp;";
                }

                $out .= "Halaman <input type=\"text\" class=\"tb_text\" id=\"tb_hal" . $this->formid . "\" title=\"Masukkan nomor halaman yang diinginkan kemudian tekan Enter\" value=\"" . $this->hal . "\" " . $disabled . "  ondblclick=\"" . $nextExec . "\" style=\"width:30px;text-align:center;\"/>";

                $out .= "&nbsp;<button class=\"btn btn-navy btn-ms\" OnClick=\"tb_go('" . $this->actions . "', '" . $this->divid . "', '" . $this->baris . "','" . $this->orderby . "', '" . $this->sortby . "','tb_hal" . $this->formid . "', 'tb_keycari" . $this->formid . "', 'tb_cari" . $this->formid . "');return false;\"> Go </button> ";

                $out .= " Dari " . $table_count;

                if ($this->hal != ($table_count)) {
                    $out .= "<a href=\"javascript:void(0)\" onclick=\"" . $nextExec . "\" title=\"Next\" class=\"paging\">&nbsp;&rsaquo;</a>&nbsp;";
                    $out .= "<a href=\"javascript:void(0)\" onclick=\"" . $lastExec . "\" title=\"Last\" class=\"paging\">&raquo;</a>&nbsp;";
                }
                else {
                    $out .= "<font class=\"pdisabled\">&nbsp;&rsaquo;</font>&nbsp;";
                    $out .= "<font class=\"pdisabled\">&raquo;</font>&nbsp;";
                }
                $out .= "</span>";
            }
            else {
                $out .= "<input type=\"hidden\" class=\"tb_text\" id=\"tb_hal" . $this->formid . "\" value=\"" . $this->hal . "\" " . $disabled . "  ondblclick=\"" . $nextExec . "\" style=\"width:30px;text-align:right;\"/>";
            }
            $out .= '</th></tr></form>';
        }
        else {
            $out .= '<tr class="head">
                        <th colspan="' . count($this->heading) . '">Total ' . $total_record . ' Data.</th>
                     </tr></form>';
        }
        $out .= $this->template['table_close'];
        $out .= '</span>';

        if ($this->detils != '') {
            $out .= '<span class="red">*</span> Double Klik baris untuk melihat detil';
        }
        else if ($this->detils_tipe == "bawah") {
            $out .= '<span id="detils_bawah"></span>';
        }
        return $out;
    }

    function clear() {
        $this->rows = array();
        $this->columns = array();
        $this->hiderows = array();
        $this->keys = array();
        $this->proses = array();
        $this->keycari = array();
        $this->heading = array();
        $this->group = array();
        $this->auto_heading = TRUE;
        $this->show_chk = TRUE;
        $this->show_menu = FALSE;
        $this->show_no = TRUE;
        $this->caption = NULL;
        $this->template = NULL;
    }

    function _set_from_object($query) {
        if (!is_object($query)) {
            return FALSE;
        }
        if (count($this->heading) == 0) {
            if (!method_exists($query, 'list_fields')) {
                return FALSE;
            }
            empty($this->heading);
            if ($this->show_no)
                $this->heading[] = 'No';
            if ($this->show_chk) {
                if ($this->check != "radio") {
                    $this->heading[] .= "<label><input type=\"checkbox\" id=\"tb_chkall" . $this->formid . "\" onclick=\"tb_chkall('" . $this->formid . "')\" class=\"tb_chkall\"/><span></span></label>";
                }
                else {
                    $this->heading[] .= "&nbsp;";
                }
            }
            foreach ($query->list_fields() as $a) {
                //if ( ! in_array($a, $this->hiderows)) $this->heading[] = $a;
                $this->heading[] = $a;
            }
            //print_r($this->heading);
        }


        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $this->rows[] = $row;
            }
        }
    }

    function _set_from_array($data, $set_heading = TRUE) {
        if (!is_array($data) OR count($data) == 0) {
            return FALSE;
        }

        $i = 0;
        foreach ($data as $row) {
            if (!is_array($row)) {
                $this->rows[] = $data;
                break;
            }

            if ($i == 0 AND count($data) > 1 AND count($this->heading) == 0 AND $set_heading == TRUE) {
                $this->heading = $row;
            }
            else {
                $this->rows[] = $row;
            }

            $i++;
        }
    }

    function _compile_template() {
        if ($this->template == NULL) {
            $this->template = $this->_default_template();
            return;
        }


        $this->temp = $this->_default_template();
        foreach (array('table_open', 'heading_row_start', 'heading_row_end', 'heading_cell_start', 'heading_cell_end', 'row_start', 'row_end', 'cell_start', 'cell_alt', 'cell_odd', 'cell_end', 'row_alt_start', 'row_alt_end', 'cell_alt_start', 'cell_alt_end', 'table_close') as $val) {
            if (!isset($this->template[$val])) {
                $this->template[$val] = $this->temp[$val];
            }
        }
    }

    function _size() {
        
    }

    function _default_template() {
        return array(
            'table_open' => '<table class="tabelajax" id="' . $this->formid . '">',
            'heading_row_start' => '<tr class="title">',
            'heading_row_end' => '</tr>',
            'heading_cell_start' => '<th>',
            'heading_cell_end' => '</th>',
            'row_start' => '<tr>',
            'row_end' => '</tr>',
            'cell_start' => '<td ' . $this->td_click . '>',
            'cell_alt' => '<td ' . $this->td_click . ' class="alt">',
            'cell_odd' => '<td ' . $this->td_click . ' class="odd">',
            'cell_end' => '</td>',
            'row_alt_start' => '<tr>',
            'row_alt_end' => '</tr>',
            'cell_alt_start' => '<td ' . $this->td_click . '>',
            'cell_alt_end' => '</td>',
            'table_close' => '</table>'
        );
    }


}
