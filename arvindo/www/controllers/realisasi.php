<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }
class realisasi extends CI_Controller {
    
    var $content = '';
    var $arr = array();
    var $path = 'realisasi'; //pathview dan model
	
	function __construct(){
        parent::__construct();
        $this->load->model('m_'.$this->path, 'mv');
    }
	
    function index() {
        if ($this->newsession->userdata('logged_in')) {
            $this->content == '' ? $content = $this->load->view('realisasi/view', $arr, '') : $content = $this->content;    
            
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
        $table['title'] = 'Realisasi';     
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
        $table['title'] = 'Realisasi';     
        $table['table'] = $this->mv->tablePO($id, $param1, $param2, $param3);
        echo $this->load->view($this->path.'/viewPO', $table, true);
	}
	
	function form($id = null) {
        $data['title'] = 'Realisasi';
        
        #DETAIL HEADER DARI PO
        $SQl = "SELECT idpo, idpenawaran, idclient, nama_ttd, jabatan_ttd, keterangan, biaya_akhir FROM t_po WHERE idpo = '".$id."'";
        $po = $this->db->query($SQl)->row();
        $idpenawaran = $po->idpenawaran;
        $data['idclient'] = $po->idclient;
        $data['namattd'] = $po->nama_ttd;
        $data['jbtnttd'] = $po->jabatan_ttd;
        $data['biaya_akhir'] = $po->biaya_akhir;
        $data['ktrngan'] = $po->keterangan;
        
        #DETAIL HEADER DARI PENAWARAN
        $SQl = "SELECT A.produk, A.ukuran, B.alamat_lokasi, B.arah_pandang, A.periode, A.satuan_period, C.nama_kota, A.pph
                FROM t_penawaran_hdr A
                LEFT JOIN m_lokasi B ON B.kdlokasi = A.kdlokasi
                LEFT JOIN m_kota C ON C.kdkota = B.kdkota
                WHERE A.idpenawaran = '".$idpenawaran."'
                ";
                
        $data['arr'] = $this->db->query($SQl)->row();

        #COMBOBOX LOKASI
        $SQl = "SELECT A.kdlokasi, CONCAT('[',B.nama_kota,']', ' - ', A.alamat_lokasi) 'ALAMAT', A.kdkota, B.nama_kota, B.kdprovinsi, C.nama_provinsi, A.alamat_lokasi, A.arah_pandang 
                FROM m_lokasi A
                LEFT JOIN m_kota B ON B.kdkota = A.kdkota
                LEFT JOIN m_provinsi C ON C.kdprovinsi = B.kdprovinsi ORDER BY C.kdprovinsi";
        $lokasi = $this->db->query($SQl)->result_array();

        $i = 1;
        $akhir = count($data);
        $prov = '';
        $element = '<select class="form-control" disabled>';
        foreach ($lokasi as $datas) {

            if ($i != 1) {
                #SETERUSNYA
                if ($datas['kdprovinsi'] == $prov) {
                    $element .= "<option " . ($data['arr']->alamat_lokasi == $datas['alamat_lokasi'] ? 'selected="TRUE"' : '') . ">" . $datas['ALAMAT'] . "</option>";
                } else {
                    $element .= "</optgroup>";
                    $element .= "<optgroup label='" . $datas['nama_provinsi'] . "'>";
                    $element .= "<option " . ($data['arr']->alamat_lokasi == $datas['alamat_lokasi'] ? 'selected="TRUE"' : '') . ">" . $datas['ALAMAT'] . "</option>";
                    if ($akhir == $i) {
                        $element .= "</optgroup>";
                    }
                }
                $prov = $data['kdprovinsi'];
            } else {
                #PERTAMA
                $prov = $data['kdprovinsi'];
                $element .= "<optgroup label='" . $datas['nama_provinsi'] . "'>";
                $element .= "<option " . ($data['arr']->alamat_lokasi == $datas['alamat_lokasi'] ? 'selected="TRUE"' : '') . ">" . $datas['ALAMAT'] . "</option>";
            }
            $i++;
        }
        $element .= '</select>';
        $data['lokasi'] = $element;

        $SQl = "SELECT perkiraan_budget FROM t_produksi WHERE idproduksi = '".$id."'";
        $data['biaya'] = $this->db->query($SQl)->row();
		
        		
        $SQl = "SELECT id, keterangan FROM t_listrik WHERE idproduksi IS NULL";
        $data['client'] = $this->actmain->get_combobox($SQl, 'id', 'keterangan', true);
		
        
        #COMBOBOX BARANG
        $SQl = "SELECT kd_brg, nama_barang FROM m_barang";
        $data['barangs'] = $this->actmain->get_combobox($SQl, 'kd_brg', 'nama_barang', true);
        
        
        
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
        $query = "SELECT A.idmaterial, B.nama_barang, A.jumlah 
                FROM t_produksi_dtl A 
                LEFT JOIN m_barang B ON B.kd_brg = A.idmaterial
                WHERE  A.idproduksi = " . $id;
        
        #SETTING DETAIL, ORDERBY, SORTBY, TIPE CHECK(radio, checkbox), HIDDEN FIELD, TYPE PROCESS
        $table->clear();
        $table->orderby('idmaterial');
        
        $table->sortby('DESC');
        $table->keys(array('idmaterial'));
        $table->hiddens(array('idmaterial'));
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
        
        #PO
        $sql = "SELECT *, C.produk, A.perkiraan_budget, date_realisasi FROM t_produksi A
                LEFT JOIN t_po B ON B.idpo = A.idpo
                LEFT JOIN t_penawaran_hdr C ON C.idpenawaran = B.idpenawaran 
                WHERE A.idproduksi = '".$id."'";
         $data = $this->db->query($sql)->row();
        
        print "<tr>";
        print "<td>Produk</td>";
        print "<td>:</td>";
        print "<td>".$data->produk."</td>";
        print "</tr>";
        
        print "<tr>";
        print "<td>Tanggal Realisasi</td>";
        print "<td>:</td>";
        print "<td>".$data->date_realisasi."</td>";
        print "</tr>";
        
        print "<tr>";
        print "<td>Total Biaya</td>";
        print "<td>:</td>";
        print "<td>".$data->perkiraan_budget."</td>";
        print "</tr>";
        
        
        
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
        
        $awal   = $this->input->post('awal');
        $akhir  = $this->input->post('akhir');
        $awali   = $this->input->post('awali');
        $akhiri  = $this->input->post('akhiri');
        $budget = $this->input->post('budget');
        $idprod = $this->input->post('idprod');
        $idvou = $this->input->post('idvoucer');
        $barang = $this->input->post('barang');
        $angsuran = $this->input->post('angsuran');
        $angsurandtl = $this->input->post('angsurandtl');
        $file_name = $this->input->post('file_name');
        
        $max = count($angsurandtl['harga'])-1;    
        for($i = 0; $i<= $max; $i++){
            
            $sql = "INSERT INTO t_angsuran SET kdproduksi = '".$idprod."', tgl_jatuh_tempo = '".$angsurandtl['date'][$i]."', nominal = '".$angsurandtl['harga'][$i]."'";
            $this->db->query($sql);    
        }
        
        $user_create = $this->newsession->userdata('username');
        
        $this->db->trans_start();
        $sql = "UPDATE t_listrik SET idproduksi = '".$idprod."', tgl_penggunaan_awal = '".$awal."', tgl_penggunaan_akhir = '".$akhir."' WHERE id= '".$idvou."'";
        $this->db->query($sql);
        
        $sql = "UPDATE t_produksi SET angsuran = '".$angsuran."', date_realisasi=NOW() WHERE idproduksi= '".$idprod."'";
        $this->db->query($sql);
        
        $sql = "INSERT INTO t_realisasi_ijin (idrealisasi, tgl_awal, tgl_ijin, user_create, date_create) 
        VALUES ('".$idprod."', '".$awali."', '".$akhiri."', '".$user_create."', NOW())";
        $this->db->query($sql);     
        
        $sql = "INSERT INTO t_realisasi_file(idproduksi, keterangan, fileupload, date_create)
                VALUES( '".$idprod."', 'realisasi', '".$file_name."', NOW())";
        $this->db->query($sql);     
        
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            echo "Gagal Menambahkan";
        }else{
            echo "Berhasil Menambahkan";
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
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
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
    
    function data(){
        $id = $this->input->post('id');
        $sql = "SELECT watt, nominal, DATE_FORMAT(tgl_beli,'%d-%m-%Y') tgl_beli FROM t_listrik WHERE id='".$id."'";
        $data = $this->db->query($sql)->row();
        echo $data->watt.'|'.$data->nominal.'|'.$data->tgl_beli;
    }
}