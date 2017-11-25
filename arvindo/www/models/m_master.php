<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class m_master extends CI_Model {
    
    function table_karyawan(){
    
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
        $table->action(site_url('master/getTable/karyawan'));
        $table->tipe_check('radio'); //(radio, checkbox)
        $table->keys(array('ID'));
        $table->hiddens(array('ID'));
        $table->tipe_proses('button');
        
        #SEARCHING TABLE
        $table->search(array(
            array("npwp", "NPWP"),
            array("nama_karyawan", "Nama Karyawan"),
            array("agama", "Agama"),
            array("status", "Status")
        ));
        
        #SETTING URL DAN BANYAK ROW
        $table->cidb($this->db);
        $table->ciuri($this->input->post("uri"));
        
        #LIST ARRAY PROCESS
        $process['Tambah'] = array('GETHASH', 'master/dataForm/karyawan', '0');
        #$process['Download Excel'] = array('GETHASH', 'master/excel_karyawan', '0');
        ##$process['Ubah'] = array('GETHASH', 'master/action/edit/karyawan', '1', 'f' . $type . '_list');
        $process['Hapus'] = array('GETHASH', 'master/delete/karyawan', '1', 'f' . $type . '_list');
        
        #SETTING PROCESS ID
        $table->menu($process);
        $table->set_formid('f' . $type);
        $table->set_divid('div' . $type);
        
        #GENERATE VIEW TABLE
        $table = $table->generate($query);
        
        return $table;
    }
    
	function table_barang(){
    
        $table = $this->newtable;
        $type = 'dataDokumen';
        $query = "
			SELECT A.kd_brg, A.kd_brg 'KDBARANG', A.nama_barang 'NAMA BARANG', CONCAT(A.stock, ' ', A.satuan) 'STOK', CASE A.STATUS WHEN '1' THEN 'Aktif' ELSE 'Tidak Aktif' END STATUS, B.nama_suplier 'SUPLIER'  
			FROM m_barang A
			LEFT JOIN m_suplier B ON B.kd_suplier = A.kd_suplier";
        
        #SETTING DETAIL, ORDERBY, SORTBY, TIPE CHECK(radio, checkbox), HIDDEN FIELD, TYPE PROCESS
        $table->clear();
        $table->detail(site_url('master/detilBarang'));
        $table->detail_tipe('detil_priview_bottom');
        $table->orderby('kd_brg');
        $table->sortby('DESC');
        $table->action(site_url('master/getTable/barang'));
        $table->tipe_check('radio'); //(radio, checkbox)
        $table->keys(array('kd_brg'));
        $table->hiddens(array('kd_brg'));
        $table->tipe_proses('button');
        
        #SEARCHING TABLE
        $table->search(array(
            array("kd_brg", "Kode Barang"),
            array("nama_barang", "Nama Barang"),
            array("stock", "Stok Barang"),
			array("status", "Status"),
			array("nama_suplier", "Suplier")
        ));
        
        #SETTING URL DAN BANYAK ROW
        $table->cidb($this->db);
        $table->ciuri($this->input->post("uri"));
        
        
        #LIST ARRAY PROCESS
        $process['Tambah'] = array('GETHASH', 'master/dataForm/barang', '0');
        $process['Ubah'] = array('GETHASH', 'master/edit/barang', '1', 'f' . $type . '_list');
        $process['Hapus'] = array('GETHASH', 'master/delete/barang', '1', 'f' . $type . '_list');
        
        #SETTING PROCESS ID
        $table->menu($process);
        $table->set_formid('f' . $type);
        $table->set_divid('div' . $type);
        
        #GENERATE VIEW TABLE
        $table = $table->generate($query);
        
        return $table;
    }
	function table_atk(){
    
        $table = $this->newtable;
        $type = 'dataDokumen';
        $query = "SELECT A.kdatk, B.nama_cabang 'CABANG', A.nama_barang 'NAMA BARANG', CONCAT(A.stock, ' ', A.satuan) 'JUMLAH', CASE A.STATUS WHEN '1' THEN 'Aktif' ELSE 'Tidak Aktif' END ALERT, DATE_FORMAT(A.date_alert, '%Y-%m-%d') 'DATE ALERT' 
				  FROM t_atk A
				  LEFT JOIN m_cabang B ON B.kdcabang = A.idcabang
				  ";
        
        #SETTING DETAIL, ORDERBY, SORTBY, TIPE CHECK(radio, checkbox), HIDDEN FIELD, TYPE PROCESS
        $table->clear();
        #$table->detail(site_url('master/detilBarang'));
        $table->detail_tipe('detil_priview_bottom');
        $table->orderby('kdatk');
        $table->sortby('DESC');
        $table->action(site_url('master/getTable/atk'));
        $table->tipe_check('radio'); //(radio, checkbox)
        $table->keys(array('kdatk'));
        $table->hiddens(array('kdatk'));
        $table->tipe_proses('button');
        
        #SEARCHING TABLE
        $table->search(array(
            array("nama_cabang", "Cabang"),
            array("nama_barang", "Nama Barang"),
            array("stock", "Stock"),
			array("satuan", "Satuan"),
			array("STATUS", "Status"),
        ));
        
        #SETTING URL DAN BANYAK ROW
        $table->cidb($this->db);
        $table->ciuri($this->input->post("uri"));
        
        
        #LIST ARRAY PROCESS
        $process['Tambah'] = array('GETHASH', 'master/dataForm/kdatk', '0');
        $process['Ubah'] = array('GETHASH', 'master/edit/kdatk', '1', 'f' . $type . '_list');
        $process['Hapus'] = array('GETHASH', 'master/delete/kdatk', '1', 'f' . $type . '_list');
        
        #SETTING PROCESS ID
        $table->menu($process);
        $table->set_formid('f' . $type);
        $table->set_divid('div' . $type);
        
        #GENERATE VIEW TABLE
        $table = $table->generate($query);
        
        return $table;
    }
	
	function table_suplier(){
    
        $table = $this->newtable;
        $type = 'dataDokumen';
        $query = "SELECT kd_suplier, kd_suplier 'KODE SUPLIER', nama_suplier 'NAMA SUPLIER', CASE STATUS WHEN '1' THEN 'Aktif' ELSE 'Tidak Aktif' END STATUS  FROM m_suplier";
        
        #SETTING DETAIL, ORDERBY, SORTBY, TIPE CHECK(radio, checkbox), HIDDEN FIELD, TYPE PROCESS
        $table->clear();
        #$table->detail(site_url('master/detilBarang'));
        $table->detail_tipe('detil_priview_bottom');
        $table->orderby('kd_suplier');
        $table->sortby('DESC');
        $table->action(site_url('master/getTable/suplier'));
        $table->tipe_check('radio'); //(radio, checkbox)
        $table->keys(array('kd_suplier'));
        $table->hiddens(array('kd_suplier'));
        $table->tipe_proses('button');
        
        #SEARCHING TABLE
        $table->search(array(
            array("kd_suplier", "Kode Suplier"),
            array("nama_suplier", "Nama Suplier"),
            array("STATUS", "Status"),
          //  array("a.DOC_PIC", "Penanggung Jawab"),
            //array("b.URAIAN", "Status")
        ));
        
        #SETTING URL DAN BANYAK ROW
        $table->cidb($this->db);
        $table->ciuri($this->input->post("uri"));
        
        
        #LIST ARRAY PROCESS
        $process['Tambah'] = array('GETHASH', 'master/dataForm/suplier', '0');
        $process['Ubah'] = array('GETHASH', 'master/edit/suplier', '1', 'f' . $type . '_list');
        $process['Hapus'] = array('GETHASH', 'master/delete/suplier', '1', 'f' . $type . '_list');
        
        #SETTING PROCESS ID
        $table->menu($process);
        $table->set_formid('f' . $type);
        $table->set_divid('div' . $type);
        
        #GENERATE VIEW TABLE
        $table = $table->generate($query);
        
        return $table;
    }
	
    function table_lokasi(){
    
        $table = $this->newtable;
        $type = 'dataDokumen';
        $query = "SELECT A.kdlokasi, A.nama_lokasi 'NAMA LOKASI',
                  B.nama_kota 'KOTA', C.nama_provinsi 'PROVINSI',  CONCAT('[',B.nama_kota,']', ' - ', A.alamat_lokasi) 'ALAMAT', A.arah_pandang 'ARAH PANDANG',
                  CASE A.kdstatus WHEN '01' THEN 'Active' ELSE 'Non-Active' END 'STATUS' , C.kdprovinsi
                FROM m_lokasi A
                LEFT JOIN m_kota B ON B.kdkota = A.kdkota
                LEFT JOIN m_provinsi C ON C.kdprovinsi = B.kdprovinsi";
        
        #SETTING DETAIL, ORDERBY, SORTBY, TIPE CHECK(radio, checkbox), HIDDEN FIELD, TYPE PROCESS
        $table->clear();
        $table->detail(site_url('master/detilLokasi'));
        $table->detail_tipe('detil_priview_bottom');
        $table->orderby('kdlokasi');
        $table->sortby('DESC');
        $table->action(site_url('master/getTable/lokasi'));
        $table->tipe_check('radio'); //(radio, checkbox)
        $table->keys(array('kdlokasi'));
        $table->hiddens(array('kdlokasi', 'kdprovinsi'));
        $table->tipe_proses('button');
        $table->show_search(TRUE);
        
        #SEARCHING TABLE
        $table->search(array(
            array("A.kdlokasi", "Kode Lokasi"),
            array("A.nama_lokasi", "Nama Lokasi"),
            array("B.nama_kota", "Nama Kota"),
            array("C.nama_provinsi", "Nama Provinsi"),
            array("A.alamat_lokasi", "Alamat Lokasi"),
            array("A.arah_pandang", "Arah Pandang"),
        ));
        
        #SETTING URL DAN BANYAK ROW
        $table->cidb($this->db);
        $table->ciuri($this->input->post("uri"));
        
        #LIST ARRAY PROCESS
        $process['Tambah'] = array('GETHASH', 'master/dataForm/lokasi', '0');
        $process['Ubah'] = array('GETHASH', 'master/edit/lokasi', '1', 'f' . $type . '_lista');
        $process['Hapus'] = array('GETHASH', 'master/delete/lokasi', '1', 'f' . $type . '_list');
        $process['Upload Lokasi'] = array('GETHASH', 'master/uploadForm/lokasi', '0');

        #SETTING PROCESS ID
        $table->menu($process);
        $table->set_formid('f' . $type);
        $table->set_divid('div' . $type);
        
        #GENERATE VIEW TABLE
        $table = $table->generate($query);
        
        return $table;
    }
    
    function table_client(){
    
        $table = $this->newtable;
        $type = 'dataDokumen';
        $query = "SELECT id, nama AS 'NAMA', alamat 'ALAMAT', npwp 'NPWP', 
                  CASE STATUS WHEN '1' THEN 'Active' ELSE 'Non-Active' END 'STATUS' 
                  FROM m_client";
        
        #SETTING DETAIL, ORDERBY, SORTBY, TIPE CHECK(radio, checkbox), HIDDEN FIELD, TYPE PROCESS
        $table->clear();
        
        $table->detail(site_url('master/detilClient'));
        $table->detail_tipe('detil_priview_bottom');
        $table->orderby('id');
        $table->sortby('DESC');
        $table->action(site_url('master/getTable/client'));
        $table->tipe_check('radio'); //(radio, checkbox)
        $table->keys(array('id'));
        $table->hiddens(array('id'));
        $table->tipe_proses('button');
        
        #SEARCHING TABLE
        $table->search(array(
            array("nama", "Nama"),
            array("alamat", "Alamat"),
            array("npwp", "NPWP"),
			array("STATUS", "Status"),
        ));
        
        #SETTING URL DAN BANYAK ROW
        $table->cidb($this->db);
        $table->ciuri($this->input->post("uri"));
        
        #LIST ARRAY PROCESS
        $process['Tambah'] = array('GETHASH', 'master/dataForm/client', '0');
        #$process['Ubah'] = array('GETHASH', 'master/action/edit/client', '1', 'f' . $type . '_list');
        $process['Hapus'] = array('GETHASH', 'master/delete/client', '1', 'f' . $type . '_list');
        $process['Upload Client'] = array('GETHASH', 'master/uploadForm/client', '0');
        
        #SETTING PROCESS ID
        $table->menu($process);
        $table->set_formid('f' . $type);
        $table->set_divid('div' . $type);
        
        #GENERATE VIEW TABLE
        $table = $table->generate($query);
        
        return $table;
    }
	
	function table_users(){
    
        $table = $this->newtable;
        $type = 'dataDokumen';
        $query = "SELECT id, A.username 'USERNAME', A.nama 'NAMA USER', B.nama_cabang 'CABANG', A.email 'EMAIL', A.last_login 'LAST LOGIN', C.status 'ROLE' 
				  FROM m_user A
				  LEFT JOIN m_cabang B ON B.kdcabang = A.id_cabang
				  LEFT JOIN t_role C ON C.kode = A.status
				  ";
        
        #SETTING DETAIL, ORDERBY, SORTBY, TIPE CHECK(radio, checkbox), HIDDEN FIELD, TYPE PROCESS
        $table->clear();
        
        #$table->detail(site_url('master/detilClient'));
        $table->detail_tipe('detil_priview_bottom');
        $table->orderby('id');
        $table->sortby('DESC');
        $table->action(site_url('master/getTable/users'));
        $table->tipe_check('radio'); //(radio, checkbox)
        $table->keys(array('id'));
        $table->hiddens(array('id'));
        $table->tipe_proses('button');
        
        #SEARCHING TABLE
        $table->search(array(
            array("username", "Username"),
            array("nama", "Nama User"),
			array("email", "Email"),
            array("nama_cabang", "Cabang"),
			array("status", "Role"),
        ));
        
        #SETTING URL DAN BANYAK ROW
        $table->cidb($this->db);
        $table->ciuri($this->input->post("uri"));
        
        #LIST ARRAY PROCESS
        $process['Tambah'] = array('GETHASH', 'master/dataForm/users', '0');
        $process['Ubah'] = array('GETHASH', 'master/edit/users', '1', 'f' . $type . '_list');
        $process['Hapus'] = array('GETHASH', 'master/delete/users', '1', 'f' . $type . '_list');
        #$process['Upload Client'] = array('GETHASH', 'master/uploadForm/client', '0');
        
        #SETTING PROCESS ID
        $table->menu($process);
        $table->set_formid('f' . $type);
        $table->set_divid('div' . $type);
        
        #GENERATE VIEW TABLE
        $table = $table->generate($query);
        
        return $table;
    }
    
    function table_cabang(){
        $table = $this->newtable;
        $type = 'dataDokumen';
        $query = "SELECT 
                a.kdcabang, a.kdcabang 'KODE CABANG', a.nama_cabang 'NAMA CABANG', a.alamat_cabang 'ALAMAT', b.nama_kota 'KOTA', C.kdprovinsi, C.nama_provinsi 'PROVINSI'
                FROM m_cabang A
                LEFT JOIN m_kota B ON B.kdkota = A.kdkota
                LEFT JOIN m_provinsi C ON C.kdprovinsi = B.kdprovinsi";
        
        #SETTING DETAIL, ORDERBY, SORTBY, TIPE CHECK(radio, checkbox), HIDDEN FIELD, TYPE PROCESS
        $table->clear();
        //$table->detail(site_url('dokumen/getTable/dokumen_dtl'));
        $table->detail_tipe('detil_priview_bottom');
        $table->orderby('A.kdcabang');
        $table->sortby('DESC');
        $table->action(site_url('master/getTable/cabang'));
        $table->tipe_check('radio'); //(radio, checkbox)
        $table->keys(array('kdcabang'));
        $table->hiddens(array('kdcabang', 'kdprovinsi'));
        $table->tipe_proses('button');
        $table->show_search(TRUE);
        
        #SEARCHING TABLE
        $table->search(array(
            array("A.kdcabang", "Kode Cabang"),
            array("A.nama_cabang", "Nama Cabang"),
            array("A.alamat_cabang", "Alamat Cabang"),
            array("B.nama_kota", "Nama Kota"),
            array("C.nama_provinsi", "Nama Provinsi"),
        ));
        
        #SETTING URL DAN BANYAK ROW
        $table->cidb($this->db);
        $table->ciuri($this->input->post("uri"));
        
        #LIST ARRAY PROCESS
        $process['Tambah'] = array('GETHASH', 'master/dataForm/cabang', '0');
        $process['Ubah'] = array('GETHASH', 'master/edit/cabang', '1', 'f' . $type . '_lista');
        $process['Hapus'] = array('GETHASH', 'master/delete/cabang', '1', 'f' . $type . '_list');
        $process['Upload Cabang'] = array('GETHASH', 'master/uploadForm/cabang', '0');

        #SETTING PROCESS ID
        $table->menu($process);
        $table->set_formid('f' . $type);
        $table->set_divid('div' . $type);
        
        #GENERATE VIEW TABLE
        $table = $table->generate($query);
        
        return $table;
    }
    
    function table_kota(){
        
        $table = $this->newtable;
        $type = 'dataDokumen';
        $query = "SELECT kdkota, a.kdkota 'KODE KOTA', a.nama_kota 'KOTA', A.kdprovinsi, b.nama_provinsi 'PROVINSI' FROM m_kota A LEFT JOIN m_provinsi B ON B.kdprovinsi = A.kdprovinsi";
        
        #SETTING DETAIL, ORDERBY, SORTBY, TIPE CHECK(radio, checkbox), HIDDEN FIELD, TYPE PROCESS
        $table->clear();

        //$table->detail(site_url('dokumen/getTable/dokumen_dtl'));
        $table->detail_tipe('detil_priview_bottom');
        $table->orderby('A.kdkota');
        $table->sortby('DESC');
        $table->action(site_url('master/getTable/kota'));
        $table->tipe_check('radio'); //(radio, checkbox)
        $table->keys(array('kdkota'));
        $table->hiddens(array('kdkota', 'kdprovinsi'));
        $table->tipe_proses('button');
        $table->show_search(TRUE);  
        
        #SEARCHING TABLE
        $table->search(array(
            array("A.kdkota", "Kode Kota"),
            array("A.nama_kota", "Nama Kota"),
            array("B.nama_provinsi", "Nama Provinsi"),
        ));
        
        #SETTING URL DAN BANYAK ROW
        $table->cidb($this->db);
        $table->ciuri($this->input->post("uri"));
        
        #LIST ARRAY PROCESS
        $process['Tambah'] = array('GETHASH', 'master/dataForm/kota', '0');
        $process['Ubah'] = array('GETHASH', 'master/edit/kota', '1', 'f' . $type . '_lista');
        $process['Hapus'] = array('GETHASH', 'master/delete/kota', '1', 'f' . $type . '_list');
        $process['Upload File'] = array('GETHASH', 'master/uploadForm/kota', '0');
        
        #SETTING PROCESS ID
        $table->menu($process);
        $table->set_formid('f' . $type);
        $table->set_divid('div' . $type);
        
        #GENERATE VIEW TABLE
        $table = $table->generate($query);
        return $table;
                    
    }
    
    function table_prov(){
        
        $table = $this->newtable;
        $type = 'dataDokumen';
        $query = "SELECT kdprovinsi, kdprovinsi 'KODE PROVINSI', nama_provinsi 'PROVINSI'
        FROM m_provinsi";
        
        #SETTING DETAIL, ORDERBY, SORTBY, TIPE CHECK(radio, checkbox), HIDDEN FIELD, TYPE PROCESS
        $table->clear();
        //$table->detail(site_url('dokumen/getTable/dokumen_dtl'));
        $table->detail_tipe('detil_priview_bottom');
        $table->orderby('kdprovinsi');
        $table->sortby('DESC');
        $table->action(site_url('master/getTable/provinsi'));
        $table->tipe_check('radio'); //(radio, checkbox)
        $table->keys(array('kdprovinsi'));
        $table->hiddens(array('kdprovinsi'));
        $table->tipe_proses('button');
        $table->show_search(TRUE);
        #SEARCHING TABLE
        $table->search(array(
            array("kdprovinsi", "Kode Provinsi"),
            array("nama_provinsi", "Nama Provinsi"),
        ));
        
        #SETTING URL DAN BANYAK ROW
        $table->cidb($this->db);
        $table->ciuri($this->input->post("uri"));
        
        #LIST ARRAY PROCESS
        $process['Tambah'] = array('GETHASH', 'master/dataForm/provinsi', '0');
        $process['Ubah'] = array('GETHASH', 'master/edit/provinsi', '1', 'f' . $type . '_lista');
        $process['Hapus'] = array('GETHASH', 'master/delete/provinsi', '1', 'f' . $type . '_list');
        $process['Upload File'] = array('GETHASH', 'master/uploadForm/provinsi', '0');
        
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