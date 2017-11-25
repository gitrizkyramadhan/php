<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }
class produksi extends CI_Controller {
    
    var $content = '';
    var $arr = array();
    var $path = 'produksi'; //pathview dan model
	
	function __construct(){
        parent::__construct();
        $this->load->model('m_'.$this->path, 'mv');
    }
	
    function index() {
        if ($this->newsession->userdata('logged_in')) {
            $this->content == '' ? $content = $this->load->view('produksi/view', $arr, '') : $content = $this->content;    
            
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
        $table['title'] = 'Produksi';     
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
        $table['title'] = 'PO';     
        $table['table'] = $this->mv->tablePO($id, $param1, $param2, $param3);
        echo $this->load->view($this->path.'/viewPO', $table, true);
	}
	
	function form($id = null) {
        $data['title'] = 'Produksi';;
        
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

        #PENAWARAN DETAIL
        $SQl = "SELECT keterangan, harga FROM t_po_detail WHERE idpo = '".$id."' ORDER BY idpo";
        $data['dtlpenawaran'] = $this->db->query($SQl)->result_array();

        #COMBOBOX CLIENT
        $SQl = "SELECT A.id, A.nama, A.NPWP, C.nama_provinsi, B.nama_kota, A.alamat 
                FROM m_client A
                LEFT JOIN m_kota B ON B.kdkota = A.kdkota
                LEFT JOIN m_provinsi C ON C.kdprovinsi = B.kdprovinsi";
        $data['client'] = $this->actmain->get_combobox($SQl, 'id', 'nama', true);
		
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
        $SQL = "SELECT fileupload FROM t_produksi_file WHERE idproduksi = ".$id." ORDER BY date_create DESC LIMIT 1";
        $file = $this->db->query($SQL)->row();
        
        print "<table>";

        
        print "<tr>";
        print "<td>Lampiran</td>";
        print "<td>:</td>";
        print "<td><a target='_blank' href='".$file->fileupload."'><b>Preview Scan Produksi</b></a></td>";
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
    
    function upload(){
        $config['upload_path']          = './upload/produksi/';
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
    
    
    function add(){
        
        $awal   = $this->input->post('awal');
        $akhir  = $this->input->post('akhir');
		
		
        $budget = $this->input->post('budget');
        $idpo = $this->input->post('idpo');
        $barang = $this->input->post('barang');
        $file_name = $this->input->post('file_name');
        
        $this->db->trans_start();
                
        $sql = "INSERT INTO t_produksi(idpo, lama_produksi, akhir_produksi, perkiraan_budget, date_create)
                VALUES('".$idpo."', '".$awal."', '".$akhir."', '".$budget."', NOW())
                ";
        $this->db->query($sql);
        $last_id = $this->db->insert_id();
        
        $sql = "UPDATE t_po SET kdstatus = '1' WHERE idpo = '".$idpo."'";
        $this->db->query($sql);
        
        $max = count($barang['id'])-1;
        
        
        for($i = 0; $i<= $max; $i++){
            $sql = "INSERT INTO t_produksi_dtl(idproduksi, idmaterial, jumlah)
                VALUES('".$last_id."', '".$barang['id'][$i]."', '".$barang['stok'][$i]."')
                ";
        $this->db->query($sql);    
        }
             
        $sql = "INSERT INTO t_produksi_file(idproduksi, keterangan, fileupload, date_create)
                VALUES( '".$last_id."', 'produksi', '".$file_name."', NOW())";
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
        
        $sql = "SELECT idpo FROM t_produksi WHERE idproduksi='".$id."'";
        $data = $this->db->query($sql)->row();
                
        
        $sql = "UPDATE t_po SET kdstatus = 0 WHERE idpo='".$data->idpo."'";
        $this->db->query($sql);
        
        
        $sql = "DELETE FROM t_produksi WHERE idproduksi='".$id."'";
        $this->db->query($sql);
        
        $sql = "DELETE FROM t_produksi_dtl WHERE idproduksi='".$id."'";
        $this->db->query($sql);
        
        
        
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            $msg = "Gagal Menghapus";
        }else{
            $msg = "Berhasil Menghapus Produksi";
        }
        print "<script>";
        echo "alert('".$msg."');";
        echo "location.href='".site_url('mockups#produksi/getTable')."';";
        print "</script>";
        die();
    }
    
    function edit($id){
        
    }
    
    function preview($id){
             
    }
    
    function printing($id){
        
    }
}