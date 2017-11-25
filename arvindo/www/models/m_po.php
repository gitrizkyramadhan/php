<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class m_po extends CI_Model {

    function table() {

        $table = $this->newtable;
        $type = 'dataDokumen';
        $query = "SELECT A.idpo, B.produk 'PRODUK', 
				  C.nama 'CLIENT', nama_ttd 'NAMA', A.jabatan_ttd 'JABATAN',
				  A.keterangan 'KETERANGAN', A.biaya_akhir 'TOTAL BIAYA' 
				  FROM t_po A
				  LEFT JOIN t_penawaran_hdr B ON B.idpenawaran = A.idpenawaran
				  LEFT JOIN m_client C ON C.id = A.idclient
				  ";

        #SETTING DETAIL, ORDERBY, SORTBY, TIPE CHECK(radio, checkbox), HIDDEN FIELD, TYPE PROCESS
        $table->clear();
        $table->detail(site_url('po/detailPo'));
        $table->detail_tipe('detil_priview_bottom');
        $table->orderby('idpo');
        $table->sortby('DESC');
        $table->action(site_url('po/getTables'));
        $table->tipe_check('radio'); //(radio, checkbox)
        $table->keys(array('idpo'));
        $table->hiddens(array('idpo'));
        $table->tipe_proses('button');

        #SEARCHING TABLE
        $table->search(array(
            array("produk", "Nama Produk"),
            array("C.nama", "Nama Client"),
            array("nama_ttd", "Nama Ttd"),
			array("jabatan_ttd", "Jabatan Ttd"),
			array("keterangan", "Keterangan"),
			array("biaya_akhir", "Total Biaya"),
        ));

        #SETTING URL DAN BANYAK ROW
        $table->cidb($this->db);
        $table->ciuri($this->input->post("uri"));

        #LIST ARRAY PROCESS
        $process['Tambah'] = array('GETHASH', 'po/getTablePenawaran', '0');
        #$process['Ubah'] = array('GETHASH', site_url('dokumen/form/dokumen/'), '1', 'f' . $type . '_list');
        #$process['Priview'] = array('GETHASH', site_url('dokumen/form/file/'), '1', 'f' . $type . '_list');
        $process['Hapus'] = array('GETHASH', 'po/delete', '1', 'f' . $type . '_list');

        #SETTING PROCESS ID
        $table->menu($process);
        $table->set_formid('f' . $type);
        $table->set_divid('div' . $type);

        #GENERATE VIEW TABLE
        $table = $table->generate($query);

        return $table;
    }
    
    function tablePenawaran(){
        $table = $this->newtable;
        $type = 'dataDokumen';
        $query = "SELECT idpenawaran, A.produk 'PRODUK', A.ukuran 'UKURAN', B.alamat_lokasi 'LOKASI', CONCAT(periode, ' ', satuan_period) 'PERIODE' 
                  FROM t_penawaran_hdr A
                  LEFT JOIN m_lokasi B ON B.kdlokasi = A.kdlokasi
                  WHERE A.kdstatus = '00'
                  ";
        
        #SETTING DETAIL, ORDERBY, SORTBY, TIPE CHECK(radio, checkbox), HIDDEN FIELD, TYPE PROCESS
        $table->clear();
        $table->detail(site_url('penawaran/detilPenawaran'));
        $table->detail_tipe('detil_priview_bottom');
        $table->orderby('idpenawaran');
        $table->sortby('DESC');
        $table->action(site_url('penawaran/form'));
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
        $process['Kirim PO'] = array('GETHASH', 'po/form', '1', 'f' . $type . '_list');
        
        #SETTING PROCESS ID
        $table->menu($process);
        $table->set_formid('f' . $type);
        $table->set_divid('div' . $type);
        
        #GENERATE VIEW TABLE
        $table = $table->generate($query);
        
        return $table;
    }

    function action($listName, $act, $id = null) {
        $table = 'm_' . $listName;

        if ($act == 'insert') {
            $SQL = "INSERT INTO $table VALUES($data)";
        } else if ($act == 'update') {
            $SQL = "UPDATE $table SET $data WHERE $id";
        } else if ($act == 'delete') {
            $SQL = "DELETE FROM $table WHERE $id";
        }

        $data = $this->db->query($SQL);

        if ($data == true) {
            #BERHASIL
        } else {
            #GAGAL
        }
    }

}
