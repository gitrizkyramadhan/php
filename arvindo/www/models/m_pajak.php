<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class m_pajak extends CI_Model {
   
    function table(){
        $table = $this->newtable;
        $type = 'dataDokumen';
        $query = "SELECT A.kdlokasi, 
                  B.nama_kota 'KOTA', C.nama_provinsi 'PROVINSI',  CONCAT('[',B.nama_kota,']', ' - ', A.alamat_lokasi) 'ALAMAT', A.arah_pandang 'ARAH PANDANG',
                  CASE A.kdstatus WHEN '1' THEN 'Active' ELSE 'Non-Active' END 'STATUS' 
                FROM m_lokasi A
                LEFT JOIN m_kota B ON B.kdkota = A.kdkota
                LEFT JOIN m_provinsi C ON C.kdprovinsi = B.kdprovinsi";
        
        #SETTING DETAIL, ORDERBY, SORTBY, TIPE CHECK(radio, checkbox), HIDDEN FIELD, TYPE PROCESS
        $table->clear();
        $table->detail(site_url('pajak/pajak_dtl'));
        $table->detail_tipe('detil_priview_bottom');
        $table->orderby('kdlokasi');
        $table->sortby('DESC');
        $table->action(site_url('pajak/getTables'));
        $table->tipe_check('radio'); //(radio, checkbox)
        $table->keys(array('kdlokasi'));
        $table->hiddens(array('kdlokasi'));
        $table->tipe_proses('button');
        
        #SEARCHING TABLE
        $table->search(array(
            array("nama_provinsi", "Provinsi"),
			array("nama_kota", "Kota"),
			array("alamat_lokasi", "Alamat"),
			array("arah_pandang", "Arah Pandang"),
        ));
        
        #SETTING URL DAN BANYAK ROW
        $table->cidb($this->db);
        $table->ciuri($this->input->post("uri"));
        
        #LIST ARRAY PROCESS
        $process['Tambah Pajak'] = array('GETHASH', 'pajak/form', '1', 'f' . $type . '_list');
        
        #SETTING PROCESS ID
        $table->menu($process);
        $table->set_formid('f' . $type);
        $table->set_divid('div' . $type);
        
        #GENERATE VIEW TABLE
        $table = $table->generate($query);
        
        return $table;
    }
    
    function table_detail($id){
        $table = $this->newtable;
        $type = 'dataDokumen';
        $query = "SELECT A.idijin, nomor_ijin 'NOMOR IJIN', tgl_ijin 'TANGGAL IJIN', tgl_akhir 'TANGGAL AKHIR', nominal 'NOMINAL', CONCAT('<a href=', B.fileupload ,' target=\'_blank\'>Preview File Ijin', '</a>') '' 
                  FROM m_lokasi_ijin A
                  LEFT JOIN (SELECT fileupload, idijin FROM m_lokasi_ijin_file ORDER BY date_create DESC ) B ON B.idijin = A.idijin 
                  WHERE kdlokasi = '".$id."'";
        
        #SETTING DETAIL, ORDERBY, SORTBY, TIPE CHECK(radio, checkbox), HIDDEN FIELD, TYPE PROCESS
        $table->clear();
        $table->detail(site_url('pajak/pajak_dtl'));
        $table->detail_tipe('detil_priview_bottom');
        $table->orderby('idijin');
        $table->sortby('DESC');
        $table->action(site_url('master/getTable/karyawan'));
        $table->tipe_check('radio'); //(radio, checkbox)
        $table->keys(array('idijin'));
        $table->hiddens(array('idijin'));
        $table->tipe_proses('button');
        
        $table->show_search(FALSE);
        $table->show_chk(FALSE);
        $table->show_paging(FALSE);
                
        #SEARCHING TABLE
        $table->search(array(
            array("npwp", "Tipe dokumen"),
            array("npwp", "Tipe dokumen"),
            array("npwp", "Tipe dokumen"),
        ));
        
        #SETTING URL DAN BANYAK ROW
        $table->cidb($this->db);
        $table->ciuri($this->input->post("uri"));
        
        #LIST ARRAY PROCESS
        $process['Tambah Ijin'] = array('GETHASH', 'pajak/form', '1', 'f' . $type . '_list');
        
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