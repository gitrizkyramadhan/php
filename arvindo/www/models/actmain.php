<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class actMain extends CI_Model {
    function insertReference($table, $arrData, $allField = false) {
        $arrData = array_change_key_case($arrData, CASE_UPPER);
        $arrData = array_map('trim', $arrData);
        #$arrData = array_map('strtoupper', $arrData); #jika semua data yang di input uppercase
        $sqlTBL = 'SHOW FIELDS FROM ' . $table;
        $datTBL = $this->db->query($sqlTBL);
        $arrTBL = $datTBL->result_array();
        $whrTBL = '';
        $data = '';
        foreach ($arrTBL as $aTBL) {
            $aTBL = array_change_key_case($aTBL, CASE_UPPER);
            $aTBL = array_map('strtoupper', $aTBL);
            $trueData = false;
            if ($aTBL['EXTRA'] != 'AUTO_INCREMENT') {
                if ($allField) {
                    $data[$aTBL['FIELD']] = $arrData[$aTBL['FIELD']];
                    $trueData = true;
                }
                else {
                    if (isset($arrData[$aTBL['FIELD']])) {
                        $data[$aTBL['FIELD']] = $arrData[$aTBL['FIELD']];
                        $trueData = true;
                    }
                }
                if ($trueData) {
                    if ($arrData[$aTBL['FIELD']] != '') {
                        $type = explode('(', $aTBL['TYPE']);
                        switch ($type[0]) {
                            case'DOUBLE':
                            case'INT':
                                $data[$aTBL['FIELD']] = str_replace(',', '', $arrData[$aTBL['FIELD']]);
                                break;
                        }
                    }
                    else {
                        $data[$aTBL['FIELD']] = NULL;
                    }
                }
            }
            #find key
            if ($aTBL['KEY'] == 'PRI') {
                $whrTBL[$aTBL['FIELD']] = $arrData[$aTBL['FIELD']]; //$data[$aTBL['FIELD']];
                #if ($trueData) {
                #    $whrTBL[$aTBL['FIELD']] = $data[$aTBL['FIELD']]; //$data[$aTBL['FIELD']];
                #}
            }
        }

        $datCEK = $this->db->get_where($table, $whrTBL);
        if ($datCEK->num_rows() == 0) {
            $exec = $this->db->insert($table, $data);
        }
        else {
            $this->db->where($whrTBL);
            $exec = $this->db->update($table, $data);
        }
        return $exec;
    }
    function get_daerah($region_id, $addKey = '') {
        $hasil['arrkota' . $addKey] = $this->get_combobox("SELECT REGION_ID, NAME FROM M_REGION WHERE REGION_ID LIKE '%00' AND RIGHT(REGION_ID, 4) != '0000' AND LEFT(REGION_ID, 2) = '" . substr($region_id, 0, 2) . "'", "REGION_ID", "NAME", TRUE);
        $hasil['arrkecamatan' . $addKey] = $this->get_combobox("SELECT REGION_ID, NAME FROM M_REGION WHERE RIGHT(REGION_ID, 2) != '00' AND LEFT(REGION_ID, 4) = '" . substr($region_id, 0, 4) . "'", "REGION_ID", "NAME", TRUE);
        return $hasil;
    }
    function get_uraian($query, $select) {
        $data = $this->db->query($query);
        if ($data->num_rows() > 0) {
            $row = $data->row();
            return $row->$select;
        }
        else {
            return "";
        }
        return 1;
    }
    function get_rows($query, $many = false) {
        #get who is the date
        $data = $this->db->query($query);

        if ($data) {
            $arr = $data->result_array();
            if ($many) {
                $dataarray = $arr;
            }
            else {
                $dataarray = end($arr);
            }
        }
        else {
            $dataarray = '';
        }
        
        return $dataarray;
    }
    function ip_geo($ip) {
        $data = file_get_contents('http://api.ipinfodb.com/v3/ip-city/?key=d7859a91e5346872d0378a2674821fbd60bc07ed63684c3286c083198f024138&ip=' . $ip . '&format=json');
        $arr = json_decode($data, true);
        return $arr;
    }
    
    function get_anggota_online(&$guest) {
        $sessions = array();
        $path = realpath(session_save_path());
        $i = 0;
        $guest = 0;
        foreach (glob($path . '/sess*') as $file) {
            if (filesize($file) > 100)
                $i++;
            else
                $guest++;
        }
        return $i;
    }

    function get_combobox($query, $key, $value, $empty = FALSE, &$disable = "") {
        $combobox = array();
        $data = $this->db->query($query);
        if ($empty)
            $combobox[""] = "&nbsp;";
        if ($data->num_rows() > 0) {
            $kodedis = "";
            $arrdis = array();
            foreach ($data->result_array() as $row) {
                if (is_array($disable)) {
                    if ($kodedis == $row[$disable[0]]) {
                        if (!array_key_exists($row[$key], $combobox))
                            $combobox[$row[$key]] = str_replace("'", "\'", "&nbsp; &nbsp;&nbsp;" . $row[$value]);
                    }else {
                        if (!array_key_exists($row[$disable[0]], $combobox))
                            $combobox[$row[$disable[0]]] = $row[$disable[1]];
                        if (!array_key_exists($row[$key], $combobox))
                            $combobox[$row[$key]] = str_replace("'", "\'", "&nbsp; &nbsp;&nbsp;" . $row[$value]);
                    }
                    $kodedis = $row[$disable[0]];
                    if (!in_array($kodedis, $arrdis))
                        $arrdis[] = $kodedis;
                }else {
                    $combobox[$row[$key]] = str_replace("'", "\'", $row[$value]);
                }
            }
            $disable = $arrdis;
        }
        return $combobox;
    }
    function formatNPWP($npwp) {
        $strlen = strlen($npwp);
        if ($strlen == 15) {
            $npwpnya = substr($npwp, 0, 2) . "." . substr($npwp, 2, 3) . "." . substr($npwp, 5, 3) . "." . substr($npwp, 8, 1) . "-" . substr($npwp, 9, 3) . "." . substr($npwp, 12, 3);
        }
        else if ($strlen == 12) {
            $npwpnya = substr($npwp, 0, 2) . "." . substr($npwp, 2, 3) . "." . substr($npwp, 5, 3) . "." . substr($npwp, 8, 1) . "-" . substr($npwp, 9, 3);
        }
        else {
            $npwpnya = $npwp;
        }
        return $npwpnya;
    }
    function gen_code($TIPE, $REGION_ID) {
        $query = "SELECT `" . $TIPE . "` AS 'CNT' FROM m_region WHERE REGION_ID = '" . $REGION_ID . "'";
        $CNT = $this->get_uraian($query, 'CNT');
        $rtn = $TIPE . '-' . $REGION_ID . '-' . str_pad(($CNT + 1), 2, '0', STR_PAD_LEFT);
        return $rtn;
    }
    function set_code($TIPE, $REGION_ID) {
        $sql = "UPDATE m_region SET `" . $TIPE . "` = `" . $TIPE . "` + 1 WHERE REGION_ID = '" . $REGION_ID . "'";
        $exec = $this->db->query($sql);
        return $exec;
    }
    function removePhat($path) {
        if (is_dir($path) === true) {
            $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::CHILD_FIRST);
            foreach ($files as $file) {
                if (in_array($file->getBasename(), array('.', '..')) !== true) {
                    if ($file->isDir() === true) {
                        rmdir($file->getPathName());
                    }
                    else if (($file->isFile() === true) || ($file->isLink() === true)) {
                        unlink($file->getPathname());
                    }
                }
            }
            return rmdir($path);
        }
        else if ((is_file($path) === true) || (is_link($path) === true)) {
            return unlink($path);
        }
        return false;
    }
    function sqlReplaceInto($table, $data, $exception = NULL) {
        $sqlTBL = 'SHOW FIELDS FROM ' . $table;
        $arrTBL = $this->get_rows($sqlTBL, true);
        foreach ($arrTBL as $v) {
            $arr = array_change_key_case($v);
            $fields[] = strtoupper($arr['field']);
        }
        if (is_array($exception)) {
            $fields = array_diff($fields, $exception);
        }
        $sql = 'REPLACE INTO ' . $table . ' (' . implode(',', $fields) . ') VALUES ';
        foreach ($data as $v) {
            foreach ($fields as $v2) {
                if ($v[$v2] == '') {
                    $val[] = 'NULL';
                }
                else {
                    $val[] = "'" . $v[$v2] . "'";
                }
            }
            $values[] = '(' . implode(",", $val) . ')';
            unset($val);
        }
        $sql .= implode(',', $values);
        return $this->db->query($sql);
    }
    
    function uploadFile($element, $fileAllow, $maxSize) {
        #'fileIklan', '*.pdf,*jpg', 5242880, 'uploads/folder/pernyataan.pdf', 'namaFungsi'
        $path = $_FILES[$element]['name'];
        $ftype = pathinfo($path, PATHINFO_EXTENSION); 
        if (!empty($_FILES[$element]['error'])) {
            switch ($_FILES[$element]['error']) {
                case'1':$rtn = "0|Ukuran File Terlalu Besar.";
                    break;
                case'3':$rtn = "0|File Yang Ter-Upload Tidak Sempurna.";
                    break;
                case'4':$rtn = "0|File Kosong Atau Belum Dipilih.";
                    break;
                case'6':$rtn = "0|Direktori Penyimpanan Sementara Tidak Ditemukan.";
                    break;
                case'7':$rtn = "0|File Gagal Ter-Upload.";
                    break;
                case'8':$rtn = "0|Proses Upload File Dibatalkan.";
                    break;
                default:$rtn = "0|Pesan Error Tidak Ditemukan.";
                    break;
            }
        }
        else if (empty($_FILES[$element]['tmp_name']) || ($_FILES[$element]['tmp_name'] == 'none')) {
            $rtn = "0|File Gagal Ter-Upload.";
        }
        else if (!strstr($fileAllow, strtolower($ftype))) {
            $rtn = "0|Tipe File Salah.<br>Tipe File Yang Diterima : " . $fileAllow;
        }
        else if ($_FILES[$element]['size'] > $maxSize) {
            $rtn = "0|Ukuran file lebih dari " . formatSizeUnits($maxSize) . " MB.";
        }
        else {
            $rtn = '1|' . $_FILES[$element]['tmp_name'] . '|' . $_FILES[$element]['name'];
        }

        return $rtn;
    }
    
    function set_log($tabel, $doc_id, $file_serial, $user_id, $file_name, $file_note) {
        $data = array(
                    'DOC_ID' => $doc_id,
                    'FILE_SERIAL' => $file_serial,
                    'USER_ID' => $user_id,
                    'FILE_NAME' => $file_name,
                    'FILE_NOTE' => $file_note
                );
        
        $exec = $this->insertReference($tabel,$data);
        return $exec;
    }
    
    
    function get_log($ktd_id) {
        $sql_log = "SELECT a.LOG_ACTIVITY,
                           a.LOG_DATETIME,
                           a.KTD_KEMKES_RESPON,
                           a.KTD_COMMON_STATUS
                    FROM tl_ktd_common a WHERE a.KTD_COMMON_ID = '$ktd_id' 
                    ORDER BY a.LOG_ID DESC";
        
        return $this->get_rows($sql_log, TRUE);
    }
    
    function get_logper($ktd_id) {
        $sql_log = "SELECT a.LOG_ACTIVITY,
                           a.LOG_DATETIME,
                           a.CM_KEMKES_RESPON,
                           a.CM_REPORT_STATUS
                    FROM tl_ktd_company a WHERE a.CM_KTD_ID = '$ktd_id' 
                    ORDER BY a.LOG_ID DESC";
        
        return $this->get_rows($sql_log, TRUE);
    }
    
    function get_logaspak($ktd_id) {
        $sql_log = "SELECT a.LOG_ACTIVITY,
                           a.LOG_DATETIME,
                           a.KTD_FOLLOWUP,
                           a.KTD_STATUS
                    FROM tl_ktd_aspak a WHERE a.KTD_ID = '$ktd_id' 
                    ORDER BY a.LOG_ID DESC";
        
        return $this->get_rows($sql_log, TRUE);
    }
}