<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class m_produksi extends CI_Model {
    
    function table(){
    
        $table = $this->newtable;
        $type = 'dataDokumen';
        $query = "SELECT A.idproduksi, C.produk 'PRODUK', CONCAT(periode, satuan_period) 'PERIODE', B.total_harga 'HARGA PENAWARAN', 
					   C.date_create 'DATE PENAWARAN', B.date_create 'DATE PO', A.lama_produksi 'LAMA PRODUKSI', A.perkiraan_budget 'BUDGET PERKIRAAN'
				  FROM t_produksi A
				  LEFT JOIN t_po B ON B.idpo = A.idpo
				  LEFT JOIN t_penawaran_hdr C ON C.idpenawaran = B.idpenawaran";
        
        #SETTING DETAIL, ORDERBY, SORTBY, TIPE CHECK(radio, checkbox), HIDDEN FIELD, TYPE PROCESS
        $table->clear();
        $table->detail(site_url('produksi/detailProduksi'));
        $table->detail_tipe('detil_priview_bottom');
        $table->orderby('idproduksi');
        $table->sortby('DESC');
        $table->action(site_url('produksi/getTables'));
        $table->tipe_check('radio'); //(radio, checkbox)
        $table->keys(array('idproduksi'));
        $table->hiddens(array('idproduksi'));
        $table->tipe_proses('button');
        
        #SEARCHING TABLE
        $table->search(array(
            array("produk", "Nama Produk"),
            array("periode", "Periode"),
            array("lama_produksi", "Lama Produksi"),
        ));
        
        #SETTING URL DAN BANYAK ROW
        $table->cidb($this->db);
        $table->ciuri($this->input->post("uri"));
        
        #LIST ARRAY PROCESS
        $process['Tambah'] = array('GETHASH', 'produksi/getTablePO', '0');
        #$process['Ubah'] = array('GETHASH', 'produksi/action/edit', '1', 'f' . $type . '_list');
        #$process['Preview'] = array('GETHASH', 'produksi/preview', '1', 'f' . $type . '_list');
        $process['Hapus'] = array('GETHASH', 'produksi/delete', '1', 'f' . $type . '_list');
        
        #SETTING PROCESS ID
        $table->menu($process);
        $table->set_formid('f' . $type);
        $table->set_divid('div' . $type);
        
        #GENERATE VIEW TABLE
        $table = $table->generate($query);
        
        return $table;
    }
    
	function tablePO(){
    $table = $this->newtable;
        $type = 'dataDokumen';
        $query = "SELECT idpo ,idpo 'Kode PO', "
                . "idpenawaran 'Kode Penawaran',"
                . "idclient 'Kode Client',"
                . "nama_ttd 'Nama',"
                . "jabatan_ttd 'Jabatan',"
                . "keterangan 'Keterangan',"
                . "biaya_akhir 'Total Biaya' from t_po WHERE kdstatus = 0";

        #SETTING DETAIL, ORDERBY, SORTBY, TIPE CHECK(radio, checkbox), HIDDEN FIELD, TYPE PROCESS
        $table->clear();
        $table->detail(site_url('po/detailPo'));
        $table->detail_tipe('detil_priview_bottom');
        $table->orderby('idpo');
        $table->sortby('DESC');
        $table->action(site_url('po/form'));
        $table->tipe_check('radio'); //(radio, checkbox)
        $table->keys(array('idpo'));
        $table->hiddens(array('idpo'));
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
        $process['Kirim Produksi'] = array('GETHASH', 'produksi/form', '1', 'f' . $type . '_list');
        
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