<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class m_absensi extends CI_Model {
    
    function table2(){
    
        $table = $this->newtable;
        $type = 'dataDokumen';
        $query = "SELECT npwp 'NPWP', nama_depan 'NAMA DEPAN', nama_belakang 'NAMA BELAKANG' FROM m_karyawan WHERE 1=1";
        
        #SETTING DETAIL, ORDERBY, SORTBY, TIPE CHECK(radio, checkbox), HIDDEN FIELD, TYPE PROCESS
        $table->clear();
        $table->detail(site_url('dokumen/getTable/dokumen_dtl'));
        $table->detail_tipe('detil_priview_bottom');
        $table->orderby('ID');
        $table->sortby('DESC');
        $table->action(site_url('absensi/getTable/'));
        $table->tipe_check('radio'); //(radio, checkbox)
        $table->keys(array('ID'));
        $table->hiddens(array('ID'));
        $table->tipe_proses('button');
        
        #SEARCHING TABLE
        $table->search(array(
            array("npwp", "Tipe dokumen"),
            array("npwp", "Tipe dokumen"),
            array("npwp", "Tipe dokumen"),
          //  array("a.DOC_PIC", "Penanggung Jawab"),
            //array("b.URAIAN", "Status")
        ));
        
        #SETTING URL DAN BANYAK ROW
        $table->cidb($this->db);
        $table->ciuri($this->input->post("uri"));
        
        #LIST ARRAY PROCESS
        $process['Tambah'] = array('GETHASH', site_url('absensi/action'), '0');
        $process['Ubah'] = array('GETHASH', site_url('dokumen/form/dokumen/'), '1', 'f' . $type . '_list');
        $process['Hapus'] = array('PROSES', site_url('dokumen/action/hapus/'), '1', 'f' . $type . '_list');
        $process['Tambah File'] = array('GETHASH', site_url('dokumen/form/file/'), '1', 'f' . $type . '_list');
        
        #SETTING PROCESS ID
        $table->menu($process);
        $table->set_formid('f' . $type);
        $table->set_divid('div' . $type);
        
        #GENERATE VIEW TABLE
        $table = $table->generate($query);
        
        return $table;
    }
    
    function action($act, $id = null) {
        
    }
}