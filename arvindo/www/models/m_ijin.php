<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class m_ijin extends CI_Model {
    /*
    function table(){
        $table = $this->newtable;
        $type = 'dataDokumen';
        $query = "SELECT A.kdlokasi, 
                  B.nama_kota 'KOTA', C.nama_provinsi 'PROVINSI',  CONCAT('[',B.nama_kota,']', ' - ', A.alamat_lokasi) 'ALAMAT', A.arah_pandang 'ARAH PANDANG' 
                FROM m_lokasi A
                LEFT JOIN m_kota B ON B.kdkota = A.kdkota
                LEFT JOIN m_provinsi C ON C.kdprovinsi = B.kdprovinsi";
        
        #SETTING DETAIL, ORDERBY, SORTBY, TIPE CHECK(radio, checkbox), HIDDEN FIELD, TYPE PROCESS
        $table->clear();
        $table->detail(site_url('pajak/pajak_dtl'));
        $table->detail_tipe('detil_priview_bottom');
        $table->orderby('kdlokasi');
        $table->sortby('DESC');
        $table->action(site_url('master/getTable/karyawan'));
        $table->tipe_check('radio'); //(radio, checkbox)
        $table->keys(array('kdlokasi'));
        $table->hiddens(array('kdlokasi'));
        $table->tipe_proses('button');
        
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
    */
    function table(){
        $table = $this->newtable;
        $type = 'dataDokumen';
        $query = "SELECT D.produk 'PRODUK', A.tgl_awal 'TANGGAL IJIN',  A.tgl_ijin 'TANGGAL AKHIR' FROM 
                    t_realisasi_ijin A 
                    LEFT JOIN t_produksi B ON B.idproduksi = A.idrealisasi
                    LEFT JOIN t_po C ON C.idpo = B.idpo 
                    LEFT JOIN t_penawaran_hdr D ON D.idpenawaran = C.idpenawaran
                ";
        
        #SETTING DETAIL, ORDERBY, SORTBY, TIPE CHECK(radio, checkbox), HIDDEN FIELD, TYPE PROCESS
        $table->clear();
        //$table->detail(site_url('pajak/pajak_dtl'));
        $table->detail_tipe('detil_priview_bottom');
        $table->orderby('kdlokasi');
        $table->sortby('DESC');
        $table->action(site_url('ijin/getTables'));
        $table->tipe_check('radio'); //(radio, checkbox)
        $table->keys(array('kdlokasi'));
        $table->hiddens(array('kdlokasi'));
        $table->tipe_proses('button');
        
        #SEARCHING TABLE
        $table->search(array(
            array("produk", "Produk"),
        ));
        
        #SETTING URL DAN BANYAK ROW
        $table->cidb($this->db);
        $table->ciuri($this->input->post("uri"));
        
        #LIST ARRAY PROCESS
        #$process['Tambah Ijin'] = array('GETHASH', 'pajak/form', '1', 'f' . $type . '_list');
        
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
        $query = "SELECT idijin, nomor_ijin 'NOMOR IJIN', tgl_ijin 'TANGGAL IJIN', tgl_akhir 'TANGGAL AKHIR', nominal 'NOMINAL', CONCAT('<a href=\'www.google.com\'>Preview File Ijin', '</a>') '' 
                  FROM m_lokasi_ijin 
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