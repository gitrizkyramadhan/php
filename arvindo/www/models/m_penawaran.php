<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class m_penawaran extends CI_Model {
    
    function table(){
    
        $table = $this->newtable;
        $type = 'dataDokumen';
        $query = "SELECT idpenawaran, A.produk 'PRODUK', A.ukuran 'UKURAN', B.alamat_lokasi 'LOKASI', CONCAT(periode, ' ', satuan_period) 'PERIODE' 
                  FROM t_penawaran_hdr A
                  LEFT JOIN m_lokasi B ON B.kdlokasi = A.kdlokasi";
        
        #SETTING DETAIL, ORDERBY, SORTBY, TIPE CHECK(radio, checkbox), HIDDEN FIELD, TYPE PROCESS
        $table->clear();
        $table->detail(site_url('penawaran/detilPenawaran'));
        $table->detail_tipe('detil_priview_bottom');
        $table->orderby('idpenawaran');
        $table->sortby('DESC');
        $table->action(site_url('penawaran/getTables'));
        $table->tipe_check('radio'); //(radio, checkbox)
        $table->keys(array('idpenawaran'));
        $table->hiddens(array('idpenawaran'));
        $table->tipe_proses('button');
        
        #SEARCHING TABLE
        $table->search(array(
            array("produk", "Nama Produk"),
            array("ukuran", "Ukuran"),
            array("alamat_lokasi", "Lokasi"),
        ));
        
        #SETTING URL DAN BANYAK ROW
        $table->cidb($this->db);
        $table->ciuri($this->input->post("uri"));
        
        #LIST ARRAY PROCESS
        $process['Tambah'] = array('GETHASH', 'penawaran/form', '0');
        $process['Ubah'] = array('GETHASH', 'penawaran/edit', '1', 'f' . $type . '_list');
        #$process['Preview'] = array('GETHASH', 'penawaran/preview', '1', 'f' . $type . '_list');
        $process['Hapus'] = array('GETHASH', 'penawaran/delete', '1', 'f' . $type . '_list');
        #$process['Upload Penawaran'] = array('GETHASH', 'penawaran/uploadForm', '0');
        
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