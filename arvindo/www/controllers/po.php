<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class po extends CI_Controller {

    var $content = '';
    var $arr = array();
    var $path = 'po'; //pathview dan model

    function __construct() {
        parent::__construct();
        $this->load->model('m_' . $this->path, 'mv');
    }

    function index() {
        if ($this->newsession->userdata('logged_in')) {
            $this->content == '' ? $content = $this->load->view($this->path . '/view', $arr, '') : $content = $this->content;

            $data = array(
                'meta' => $this->load->view('meta/meta', '', TRUE),
                'meta_foot' => $this->load->view('meta/meta_foot', '', TRUE),
                'footer' => $this->load->view('meta/footer', '', TRUE),
                'sidebar' => $this->load->view('meta/sidebar', '', TRUE),
                'content' => $content
            );

            $this->parser->parse('mockup', $data);
        } else {
            redirect(site_url());
        }
    }

    function getTable($listName, $id = '', $param1 = '', $param2 = '', $param3 = '') {
        $id = urldecode($id);
        $param1 = urldecode($param1);
        $param2 = urldecode($param2);
        $param3 = urldecode($param3);
        $table['title'] = 'Purchase Order';
        $table['table'] = $this->mv->table($id, $param1, $param2, $param3);
        echo $this->load->view($this->path . '/view', $table, true);
    }
	
	function getTables($listName, $id = '', $param1 = '', $param2 = '', $param3 = '') {
        $id = urldecode($id);
        $param1 = urldecode($param1);
        $param2 = urldecode($param2);
        $param3 = urldecode($param3);
        echo $this->mv->table($id, $param1, $param2, $param3);
    }
	
    function detailPo($id) {
        $table = $this->newtable;
        $type = 'dataDokumen';
        $query = "select a.idpodtl,a.keterangan,a.harga 
                    from t_po_detail a join t_po b on a.idpo = b.idpo join 
                    t_penawaran_hdr c on b.idpenawaran = c.idpenawaran join 
                    m_lokasi d on c.kdlokasi = d.kdlokasi where b.idpo = " . $id;
        
        #SETTING DETAIL, ORDERBY, SORTBY, TIPE CHECK(radio, checkbox), HIDDEN FIELD, TYPE PROCESS
        $table->clear();
        $table->orderby('idpodtl');
        
        $table->sortby('DESC');
        $table->keys(array('idpodtl'));
        $table->hiddens(array('idpodtl'));
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
        $SQL = "select a.nama_ttd,a.jabatan_ttd, b.nama,b.alamat,b.npwp from t_po a join m_client b on b.id = a.idclient
                where a.idpo =  " . $id;
        $data = $this->db->query($SQL)->row();
        
        $SQL = "SELECT fileupload FROM t_po_file WHERE idpo = ".$id." ORDER BY date_create DESC LIMIT 1";
        $file = $this->db->query($SQL)->row();
        
        print "<table>";

        print "<tr>";
        print "<td>Nama</td>";
        print "<td>:</td>";
        print "<td><b>" . $data->nama_ttd . "</b></td>";
        print "</tr>";

        print "<tr>";
        print "<td>Jabatan</td>";
        print "<td>:</td>";
        print "<td><b>" . $data->jabatan_ttd . "</b></td>";
        print "</tr>";

        print "<tr>";
        print "<td>Nama Kantor</td>";
        print "<td>:</td>";
        print "<td><b>" . $data->nama . "</b></td>";
        print "</tr>";

        print "<tr>";
        print "<td>Alamat</td>";
        print "<td>:</td>";
        print "<td><b>" . $data->alamat . "</b></td>";
        print "</tr>";

        print "<tr>";
        print "<td>NPWP</td>";
        print "<td>:</td>";
        print "<td><b>" . $data->npwp . "</b></td>";
        print "</tr>";

        print "<tr>";
        print "<td>Lampiran</td>";
        print "<td>:</td>";
        print "<td><a target='_blank' href='".$file->fileupload."'><b>Preview Scan PO</b></a></td>";
        print "</tr>";
        
        print "</table>";

        echo $table;
    }

    function action($act, $data, $id = null) {
        if ($act == 'add') {
            
        } else if ($act == 'update') {
            
        } else if ($act == 'delete') {
            
        } else {
            
        }
    }
    
    function upload(){
        $config['upload_path']          = './upload/po/';
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
        
        $idclient = $this->input->post('idclient');
        $nama = $this->input->post('nama');
        $jabatan  = $this->input->post('jabatan');
        $biaya = $this->input->post('biaya');
        $keterangan = $this->input->post('keterangan');
        $idpenawaran= $this->input->post('idpenawaran');
        $detail = $this->input->post('penawaran');
        $user_create = $this->newsession->userdata('username');
        $file_name = $this->input->post('file_name');
        $pph = $this->input->post('pph');
        $total_harga = $this->input->post('total_harga');
        $user_create = $this->newsession->userdata('username');
        
        $this->db->trans_start();
                
        $sql = "INSERT INTO t_po(idpenawaran, idclient, nama_ttd, jabatan_ttd, keterangan, biaya_akhir, date_create, user_create, pph, total_harga)
                VALUES('".$idpenawaran."', '".$idclient."', '".$nama."', '".$jabatan."', '".$keterangan."', '".$biaya."', NOW(), 
                '".$user_create."', '".$pph."', '".$total_harga."')";
        $this->db->query($sql);
        $last_id = $this->db->insert_id();
        
        $max = count($detail['ket'])-1;
        
        for($i = 0; $i<= $max; $i++){
            $sql = "INSERT INTO t_po_detail(idpo, keterangan, harga, date_create, user_create)
                VALUES('".$last_id."', '".$detail['ket'][$i]."', '".$detail['res'][$i]."', NOW(), '".$user_create."')
                ";
        $this->db->query($sql);    
        }
        
        $sql = "INSERT INTO t_po_file(idpo, keterangan, fileupload, date_create, user_create)
                VALUES( '".$last_id."', 'po', '".$file_name."', NOW(), '".$user_create."')";
        $this->db->query($sql);
        
        $sql = "UPDATE t_penawaran_hdr SET kdstatus = '01' WHERE idpenawaran = '".$idpenawaran."'";
        $this->db->query($sql);
             
             
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            echo "Gagal Menambahkan PO";
        }else{
            echo "Berhasil Menambahkan PO";
        }
        die();
    }
    
    function delete($id){
        $this->db->trans_start();
                
        $sql = "DELETE FROM t_po WHERE idpo='".$id."'";
        $this->db->query($sql);
        
        $sql = "DELETE FROM t_po_detail WHERE idpo='".$id."'";
        $this->db->query($sql);
        

        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            $msg = "Gagal Menghapus";
        }else{
            $msg = "Berhasil Menghapus PO";
        }
        print "<script>";
        echo "alert('".$msg."');";
        echo "location.href='".site_url('mockups#po/getTable')."';";
        print "</script>";
        die();
    }

    function form($id = null) {
        $data['title'] = 'Purchase Order';
        
        #DETAIL HEADER DARI PENAWARAN
        $SQl = "SELECT A.produk, A.ukuran, B.alamat_lokasi, B.arah_pandang, A.periode, A.satuan_period, C.nama_kota, A.pph
                FROM t_penawaran_hdr A
                LEFT JOIN m_lokasi B ON B.kdlokasi = A.kdlokasi
                LEFT JOIN m_kota C ON C.kdkota = B.kdkota
                WHERE idpenawaran = '".$id."'
                ";
        $data['arr'] = $this->db->query($SQl)->row();

        #COMBOBOX LOKASI
        $SQl = "SELECT A.kdlokasi, CONCAT('[',B.nama_kota,']', ' - ', A.alamat_lokasi) 'ALAMAT', A.kdkota, B.nama_kota, B.kdprovinsi, C.nama_provinsi, A.alamat_lokasi, A.arah_pandang FROM m_lokasi A
                LEFT JOIN m_kota B ON B.kdkota = A.kdkota
                LEFT JOIN m_provinsi C ON C.kdprovinsi = B.kdprovinsi ORDER BY C.kdprovinsi";
        $lokasi = $this->db->query($SQl)->result_array();

        $i = 1;
        $akhir = count($data)+1;
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
                $prov = $datas['kdprovinsi'];
            } else {
                #PERTAMA
                $prov = $datas['kdprovinsi'];
                $element .= "<optgroup label='" . $datas['nama_provinsi'] . "'>";
                $element .= "<option " . ($data['arr']->alamat_lokasi == $datas['alamat_lokasi'] ? 'selected="TRUE"' : '') . ">" . $datas['ALAMAT'] . "</option>";
            }
            $i++;
        }
        $element .= '</select>';
        $data['lokasi'] = $element;

        #PENAWARAN DETAIL
        $SQl = "SELECT keterangan, harga FROM t_penawaran_dtl WHERE idpenawaranhdr = '".$id."' ORDER BY idpenawarandtl";
        $data['dtlpenawaran'] = $this->db->query($SQl)->result_array();

        #COMBOBOX 
        $SQl = "SELECT A.id, A.nama, A.NPWP, C.nama_provinsi, B.nama_kota, A.alamat 
                FROM m_client A
                LEFT JOIN m_kota B ON B.kdkota = A.kdkota
                LEFT JOIN m_provinsi C ON C.kdprovinsi = B.kdprovinsi";
        $data['client'] = $this->actmain->get_combobox($SQl, 'id', 'nama', true);
		
		$SQl = "SELECT * FROM t_po WHERE id_po = '".$id."'";
		
        #CONTENT EXECUTE
        echo $this->load->view($this->path . '/form', $data, TRUE);
    }
    
    function getTablePenawaran($listName, $id = '', $param1 = '', $param2 = '', $param3 = ''){
		$id = urldecode($id);
        $param1 = urldecode($param1);
        $param2 = urldecode($param2);
        $param3 = urldecode($param3);
        $table['title'] = 'Penawaran';     
        $table['table'] = $this->mv->tablePenawaran($id, $param1, $param2, $param3);
        echo $this->load->view($this->path.'/viewPenawaran', $table, true);
	}
    
    function detilClient() {
        $SQl = "SELECT A.id, A.nama, A.NPWP, C.nama_provinsi, B.nama_kota, A.alamat 
                FROM m_client A
                LEFT JOIN m_kota B ON B.kdkota = A.kdkota
                LEFT JOIN m_provinsi C ON C.kdprovinsi = B.kdprovinsi
                WHERE id = '" . $this->input->post('id') . "'
                ";
        $result = $this->db->query($SQl)->row();
        echo $data = $result->id . '|' . $result->nama . '|' . $result->NPWP . '|' . $result->nama_provinsi . '|' . $result->nama_kota . '|' . $result->alamat;
    }

    function edit($id) {
        
    }

    function preview($id) {
        
    }

    function printing($id) {
        
    }


}
