<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }
class gaji extends CI_Controller {
    
    var $content = '';
    var $arr = array();
    var $path = 'gaji'; //pathview dan model
	
	function __construct(){
        parent::__construct();
        $this->load->model('m_'.$this->path, 'mv');
    }
	
    function index() {
        if ($this->newsession->userdata('logged_in')) {
            $this->content == '' ? $content = $this->load->view('gaji/view', $arr, '') : $content = $this->content;    
            
            $data = array(
              'meta' => $this->load->view('meta/meta', '', TRUE),
              'meta_foot' => $this->load->view('meta/meta_foot', '', TRUE),
              'footer' => $this->load->view('meta/footer', '', TRUE),
              'sidebar'  => $this->load->view('meta/sidebar', '', TRUE),
              'content' => $content
            );
            
            $this->parser->parse('mockup', $data);     
        }else{
            redirect(site_url());
        }
    }
	
	function getTable($listName, $id = '', $param1 = '', $param2 = '', $param3 = '') {
        $id = urldecode($id);
        $param1 = urldecode($param1);
        $param2 = urldecode($param2);
        $param3 = urldecode($param3);
        $table['title'] = 'Gaji';     
        $table['table'] = $this->mv->table($id, $param1, $param2, $param3);
        echo $this->load->view($this->path.'/view', $table, true);
	}
	
	function getTables($listName, $id = '', $param1 = '', $param2 = '', $param3 = '') {
        $id = urldecode($id);
        $param1 = urldecode($param1);
        $param2 = urldecode($param2);
        $param3 = urldecode($param3);
        echo $this->mv->table($id, $param1, $param2, $param3);
    }
	
	function getTablePO($listName, $id = '', $param1 = '', $param2 = '', $param3 = ''){
		$id = urldecode($id);
        $param1 = urldecode($param1);
        $param2 = urldecode($param2);
        $param3 = urldecode($param3);
        $table['title'] = 'Gaji';     
        $table['table'] = $this->mv->tablePO($id, $param1, $param2, $param3);
        echo $this->load->view($this->path.'/viewPO', $table, true);
	}
	
	function form($id = null) {
        $data['title'] = 'Gaji';
        $id = $this->uri->segment(3);
        $sql = "SELECT gaji_harian, gaji_pokok FROM m_karyawan WHERE id = '".$id."'";
        $data['data'] = $this->db->query($sql)->row();
        
        #CONTENT EXECUTE
        echo $this->load->view($this->path . '/form', $data, TRUE);
    }
    
    function detilBarang() {
        $param = $this->input->post('id');
        $SQl = "SELECT kd_brg, nama_barang, stock, satuan FROM m_barang WHERE status = '1' AND kd_brg= '".$param."' ";
        $result = $this->db->query($SQl)->row();
        echo $data = $result->kd_brg . '|' . $result->nama_barang. '|' . $result->stock . '|' . $result->satuan;
    }
    
    function detailProduksi($id) {
        
        $table = $this->newtable;
        $type = 'dataDokumen';
        $query = "SELECT kdangsuran, DATE_FORMAT(tgl_jatuh_tempo, '%Y-%m-%d') 'JATUH TEMPO', tgl_bayar 'TANGGAL BAYAR', nominal 'NOMINAL' FROM t_angsuran WHERE kdproduksi= '".$id."'";
        
        #SETTING DETAIL, ORDERBY, SORTBY, TIPE CHECK(radio, checkbox), HIDDEN FIELD, TYPE PROCESS
        $table->clear();
        $table->orderby('kdangsuran');
        
        $table->sortby('DESC');
        $table->keys(array('kdangsuran'));
        $table->hiddens(array('kdangsuran'));
        $table->tipe_proses('button');
        
        $table->show_search(FALSE);
        $table->show_chk(FALSE);
        $table->show_paging(FALSE);

        #SETTING URL DAN BANYAK ROW
        $table->cidb($this->db);
        $table->ciuri($this->input->post("uri"));
        $table->menu(false);
        #SETTING PROCESS ID
        $table->set_formid('f' . $type);
        $table->set_divid('div' . $type);

        #GENERATE VIEW TABLE
        $table = $table->generate($query);
        $SQL = "SELECT fileupload FROM t_realisasi_file WHERE idproduksi = ".$id." ORDER BY date_create DESC LIMIT 1";
        $file = $this->db->query($SQL)->row();
        
        print "<table>";

        
        print "<tr>";
        print "<td>Lampiran</td>";
        print "<td>:</td>";
        print "<td><a target='_blank' href='".$file->fileupload."'><b>Preview Scan Realisasi</b></a></td>";
        print "</tr>";
        
        print "</table>";

        echo $table;
    }

    function action($act, $data, $id = null){
        if($act == 'add'){
            
        }else if($act == 'update'){
            
        }else if($act == 'delete'){
            
        }else{
            
        }
    }
    
    function add(){
        
        $bulan          = $this->input->post('bulan');
        $mingguke       = $this->input->post('mingguke');
        $gaji_harian    = $this->input->post('gaji_harian');
        $hari_kerja     = $this->input->post('hari_kerja');
        $gaji_pokok     = $this->input->post('gaji_pokok');
        $over_time      = $this->input->post('over_time');
        $uang_makan     = $this->input->post('uang_makan');
        $kasbon_harian  = $this->input->post('kasbon_harian');
        $kasbon_bulanan  = $this->input->post('kasbon_bulanan');
        $idkaryawan     = $this->input->post('idkaryawan');
        $user_create    = $this->newsession->userdata('username');
        
        $sql = "SELECT * FROM t_gaji WHERE id_karyawan = '".$idkaryawan."' AND bulan = '".$bulan."' AND minggu = '".$mingguke."' ";
        $data = $this->db->query($sql)->num_rows();
                
        $this->db->trans_start();
            if($data != 0){
                #UPDATE
                $sql = "UPDATE t_gaji SET
                            gaji_harian='".$gaji_harian."', 
                            hari_kerja='".$hari_kerja."',
                            gaji_pokok='".$gaji_pokok."',
                            over_time='".$over_time."',
                            uang_makan='".$uang_makan."',
                            kasbon_harian='".$kasbon_harian."',
                            kasbon_bulanan='".$kasbon_bulanan."' 
                        WHERE id_karyawan = '".$idkaryawan."' AND bulan = '".$bulan."' AND minggu = '".$mingguke."'";
                $this->db->query($sql);
                
            }else{
                #INSERT
                $sql = "INSERT INTO t_gaji(id_karyawan, gaji_harian, hari_kerja, gaji_pokok, over_time, uang_makan, kasbon_harian, kasbon_bulanan, bulan, minggu, tahun)
                        VALUES('".$idkaryawan."', '".$gaji_harian."', '".$hari_kerja."', '".$gaji_pokok."', '".$over_time."', '".$uang_makan."', '".$kasbon_harian."', '".$kasbon_bulanan."', '".$bulan."', '".$mingguke."', YEAR(NOW())) 
                       ";
                $this->db->query($sql);
            }
            
             
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            echo "Gagal Process";
        }else{
            echo "Berhasil Process";
        }
        die();
    }
    
     function delete($id){
        $this->db->trans_start();
                
        $sql = "UPDATE t_produksi SET date_realisasi = NULL WHERE idproduksi = '".$id."'";
        $this->db->query($sql);
        
        $sql = "UPDATE t_listrik SET idproduksi = NULL WHERE idproduksi = '".$id."'";
        $this->db->query($sql);
        
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            $msg = "Gagal Menghapus";
        }else{
            $msg = "Berhasil Menghapus Realisasi";
        }
        print "<script>";
        echo "alert('".$msg."');";
        echo "location.href='".site_url('mockups#realisasi/getTable')."';";
        print "</script>";
        die();
    }
    
    function edit($id){
        
    }
    
    function preview($id){
        
        $data = '';
        
        #DETAIL HEADER DARI PENAWARAN
        $SQl = "SELECT A.produk, A.ukuran, B.alamat_lokasi, B.arah_pandang, A.periode, A.satuan_period, C.nama_kota, A.pph, A.total_harga, D.nama_provinsi
                FROM t_penawaran_hdr A
                LEFT JOIN m_lokasi B ON B.kdlokasi = A.kdlokasi
                LEFT JOIN m_kota C ON C.kdkota = B.kdkota
                LEFT JOIN m_provinsi D ON D.kdprovinsi = C.kdprovinsi
                WHERE idpenawaran =".$id;
        $data['arr'] = $this->db->query($SQl)->row();
        
        #PENAWARAN DETAIL
        $SQl = "SELECT keterangan, harga FROM t_penawaran_dtl WHERE idpenawaranhdr = '".$id."' ORDER BY idpenawarandtl";
        $data['dtlpenawaran'] = $this->db->query($SQl)->result_array();
        
        #PENAWARAN FILE
        $SQl = "SELECT keterangan, fileupload FROM t_penawaran_file WHERE idpenawaran = '".$id."' ORDER BY idpenawaranfile ASC";
        $data['filepenawaran'] = $this->db->query($SQl)->result_array();
        
        echo $this->load->view('realisasi/preview', $data, '');
}

    
    function printing($id){
        
    }
    
    function upload(){
        $config['upload_path']          = './upload/realisasi/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 100000;
        $config['overwrite']             = TRUE;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;
        
		$this->load->library('upload', $config);
 
		if ( ! $this->upload->do_upload('filename')){
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
		}else{
			$data = array('upload_data' => $this->upload->data());
			echo "sukses#".$_FILES["filename"]['name'];
		}
        die();
    }
}