<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class m_gaji extends CI_Model {
    
    function table(){
    
        $table = $this->newtable;
        $type = 'dataDokumen';
        $query = "SELECT ID, 
                	npwp 'NPWP', 
                	nama_karyawan 'NAMA' , 
                	DATE_FORMAT(tgl_lahir, '%d-%m-%Y') 'TANGGAL LAHIR', 
                	agama 'AGAMA', 
                	CASE STATUS WHEN '1' THEN 'Active' ELSE 'Non-Active' END 'STATUS'
                FROM m_karyawan";
        
        #SETTING DETAIL, ORDERBY, SORTBY, TIPE CHECK(radio, checkbox), HIDDEN FIELD, TYPE PROCESS
        $table->clear();
        $table->detail(site_url('master/karyawanDetil'));
        $table->detail_tipe('detil_priview_bottom');
        $table->orderby('ID');
        $table->sortby('DESC');
        $table->action(site_url('gaji/getTables'));
        $table->tipe_check('radio'); //(radio, checkbox)
        $table->keys(array('ID'));
        $table->hiddens(array('ID'));
        $table->tipe_proses('button');
        
        #SEARCHING TABLE
        $table->search(array(
            array("npwp", "NPWP"),
            array("nama_karyawan", "Nama Karyawan"),
            array("agama", "Agama"),
        ));
        
        #SETTING URL DAN BANYAK ROW
        $table->cidb($this->db);
        $table->ciuri($this->input->post("uri"));
        
        #LIST ARRAY PROCESS
        $process['Process'] = array('GETHASH', 'gaji/getTablePO', '1', 'f' . $type . '_list');
        #$process['Preview'] = array('GETHASH', 'realisasi/preview', '1', 'f' . $type . '_list');
        #$process['Hapus'] = array('GETHASH', 'realisasi/delete', '1', 'f' . $type . '_list');
        
        #SETTING PROCESS ID
        $table->menu($process);
        $table->set_formid('f' . $type);
        $table->set_divid('div' . $type);
        
        #GENERATE VIEW TABLE
        $table = $table->generate($query);
        
        return $table;
    }
    
	function tablePO($id){
	    $id = $this->uri->segment(3);
              	   
        $table = $this->newtable;
        $type = 'dataDokumen';
        $query = "SELECT id, 
                        CASE bulan 
                            WHEN 1 THEN 'Januari'
                            WHEN 2 THEN 'Februari'
                            WHEN 3 THEN 'Maret'
                            WHEN 4 THEN 'April'
                            WHEN 5 THEN 'Mei'
                            WHEN 6 THEN 'Juni'
                            WHEN 7 THEN 'Juli'
                            WHEN 8 THEN 'Agustus'
                            WHEN 9 THEN 'September'
                            WHEN 10 THEN 'Oktober'
                            WHEN 11 THEN 'November'
                            WHEN 12 THEN 'Desember'
                        END 'BULAN' 
                , minggu 'MINGGU KE-' FROM t_gaji WHERE id_karyawan = '".$id."'";
        

        #SETTING DETAIL, ORDERBY, SORTBY, TIPE CHECK(radio, checkbox), HIDDEN FIELD, TYPE PROCESS
        $table->clear();
        $table->detail(site_url('gaji/detailGaji'));
        $table->detail_tipe('detil_priview_bottom');
        $table->orderby('id');
        $table->sortby('DESC');
        $table->action(site_url('tagihan/form'));
        $table->tipe_check('radio'); //(radio, checkbox)
        $table->keys(array('id'));
        $table->hiddens(array('id'));
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
        $process['Tambah Gaji'] = array('GETHASH', 'gaji/form/'.$id, '0');
        
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