<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class m_listrik extends CI_Model {
    
    function table(){
    
        $table = $this->newtable;
        $type = 'dataDokumen';
        $query = "SELECT id, keterangan 'VOUCER', nominal 'NOMINAL', CONCAT(watt, ' watt') 'ISI', CASE status WHEN 0 THEN 'Belum Terpakai' ELSE 'Terpakai' END 'STATUS', DATE_FORMAT(tgl_beli, '%Y-%m-%d') 'TANGGAL BELI' FROM t_listrik";
        
        #SETTING DETAIL, ORDERBY, SORTBY, TIPE CHECK(radio, checkbox), HIDDEN FIELD, TYPE PROCESS
        $table->clear();
        $table->detail(site_url('listrik/detilListrik'));
        $table->detail_tipe('detil_priview_bottom');
        $table->orderby('id');
        $table->sortby('DESC');
        $table->action(site_url('listrik/getTables'));
        $table->tipe_check('radio'); //(radio, checkbox)
        $table->keys(array('id'));
        $table->hiddens(array('id'));
        $table->tipe_proses('button');
        
        #SEARCHING TABLE
        $table->search(array(
            array("keterangan", "Voucer"),
            array("nominal", "Nominal"),
            array("watt", "Isi"),
			array("status", "Status"),
        ));
        
        #SETTING URL DAN BANYAK ROW
        $table->cidb($this->db);
        $table->ciuri($this->input->post("uri"));
        
        #LIST ARRAY PROCESS
        $process['Tambah'] = array('GETHASH', 'listrik/form', '0');
        #$process['Ubah'] = array('GETHASH', 'listrik/action/edit', '1', 'f' . $type . '_list');
        #$process['Preview'] = array('GETHASH', 'listrik/preview', '1', 'f' . $type . '_list');
        $process['Hapus'] = array('GETHASH', 'listrik/hapus', '1', 'f' . $type . '_list');
        
        #SETTING PROCESS ID
        $table->menu($process);
        $table->set_formid('f' . $type);
        $table->set_divid('div' . $type);
        
        #GENERATE VIEW TABLE
        $table = $table->generate($query);
        
        return $table;
    }
    
    
    
    function action($listName, $act ,$id = null) {
        $table = 'm_'.$listName;
        
        if($act == 'insert'){
            $SQL = "INSERT INTO $table VALUES($data)";    
        }else if($act == 'update'){
            $SQL = "UPDATE $table SET $data WHERE $id";    
        }else if($act == 'delete'){
            $SQL = "DELETE FROM $table WHERE $id";    
        }
        
        $data = $this->db->query($SQL);
        
        if($data == true){
            #BERHASIL
        }else{
            #GAGAL
        }
            
    }
}