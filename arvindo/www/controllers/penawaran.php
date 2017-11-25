<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }
class penawaran extends CI_Controller {
    
    var $content = '';
    var $arr = array();
    var $path = 'penawaran'; //pathview dan model
    
    function __construct(){
        parent::__construct();
        $this->load->model('m_'.$this->path, 'mv');
    }
    
    function getTable($listName, $id = '', $param1 = '', $param2 = '', $param3 = '') {
        $id = urldecode($id);
        $param1 = urldecode($param1);
        $param2 = urldecode($param2);
        $param3 = urldecode($param3);
        $table['title'] = 'Penawaran';     
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
    
    function detilPenawaran($id){
        $table = $this->newtable;
        $type = 'dataDokumen';
        $query = "SELECT idpenawarandtl, keterangan 'KETERANGAN', CONCAT('Rp. ', harga) 'HARGA' FROM t_penawaran_dtl WHERE idpenawaranhdr = ".$id;
        
        #SETTING DETAIL, ORDERBY, SORTBY, TIPE CHECK(radio, checkbox), HIDDEN FIELD, TYPE PROCESS
        $table->clear();
        $table->orderby('idpenawarandtl');
        $table->sortby('DESC');
        $table->keys(array('idpenawarandtl'));
        $table->hiddens(array('idpenawarandtl'));
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
        $SQL = "SELECT produk, date_create, total_harga, pph FROM t_penawaran_hdr WHERE idpenawaran = ".$id;
        $data = $this->db->query($SQL)->row();
        
        $SQL = "SELECT fileupload FROM t_penawaran_file WHERE idpenawaran = ".$id." ORDER BY date_create DESC LIMIT 1";
        $file = $this->db->query($SQL)->row();
        
        print "<table>";
        
        print "<tr>";
        print "<td>Produk yang di Iklankan</td>";
        print "<td>:</td>";
        print "<td><b>".$data->produk."</b></td>";
        print "</tr>";
        
        print "<tr>";
        print "<td>Date Create</td>";
        print "<td>:</td>";
        print "<td><b>".$data->date_create."</b></td>";
        print "</tr>";
        
        print "<tr>";
        print "<td>Budget Total</td>";
        print "<td>:</td>";
        print "<td><b>Rp. ".$data->total_harga."</b> (PPn 10%, PPh = Rp. ".$data->pph.")</td>";
        print "</tr>";
        
        print "<tr>";
        print "<td>Lampiran</td>";
        print "<td>:</td>";
        print "<td><a target='_blank' href='".$file->fileupload."'><b>Preview Scan Penawaran</b></a></td>";
        print "</tr>";
        
        print "</table>";
        
        echo $table;
    }
    
    function karyawan($kode){
        
        die($kode);
    }
    
    function upload(){
        $config['upload_path']          = './upload/penawaran/';
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
			echo "Berhasil Upload#".$_FILES["filename"]['name'];
		}
        die();
    }
    
    function add(){
        
        $data = $this->input->post('FORM');
        $detail = $this->input->post('penawaran');
        $user_create = $this->newsession->userdata('username');
        $pph = $this->input->post('pph');
        $total_harga = $this->input->post('total_harga');
        $file_name = $this->input->post('file_name');
		$cabang = $this->input->post('cabang');
        $user_create = $this->newsession->userdata('username');
        
        $this->db->trans_start();
                
        $sql = "INSERT INTO t_penawaran_hdr(produk, ukuran, kdlokasi, periode, satuan_period, date_create, kdstatus, user_create, pph, total_harga, id_cabang) VALUES('".$data['produk']."', '".$data['ukuran']."', '".$data['kdlokasi']."', '".$data['periode']."', '".$data['satuan_period']."', NOW(), '00', '".$user_create."', '".$pph."', '".$total_harga."', '".$cabang."')";
        $this->db->query($sql);
        $last_id = $this->db->insert_id();
        $max = count($detail['ket'])-1;
        
        for($i = 0; $i<= $max; $i++){
			$sql = "INSERT INTO t_penawaran_dtl(idpenawaranhdr, keterangan, harga, date_create, user_create) VALUES('".$last_id."', '".$detail['ket'][$i]."', '".$detail['res'][$i]."', NOW(), '".$user_create."')";
			$this->db->query($sql);    
        }
        
        $sql = "INSERT INTO t_penawaran_file(idpenawaran, keterangan, fileupload, date_create)
                VALUES( '".$last_id."', '".$data['produk']."', '".$file_name."', NOW())";
        $this->db->query($sql);
        
             
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            echo "Gagal Menambahkan";
        }else{
            echo "Berhasil Menambahkan";
        }
        die();
    }
    
    function ubah(){
        
    }
    
    function delete($id){
        $this->db->trans_start();
                
        $sql = "DELETE FROM t_penawaran_hdr WHERE idpenawaran='".$id."'";
        $this->db->query($sql);
        
        $sql = "DELETE FROM t_penawaran_dtl WHERE idpenawaranhdr='".$id."'";
        $this->db->query($sql);
        
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            $msg = "Gagal Menghapus";
        }else{
            $msg = "Berhasil Menghapus Penawaran";
        }
        print "<script>";
        echo "alert('".$msg."');";
        echo "location.href='".site_url('mockups#penawaran/getTable')."';";
        print "</script>";
        die();
    }
    
    function action($act, $id = null){
        if($act == 'edit'){
            $data['title'] = 'Penawaran';
        
            #DETAIL HEADER DARI PENAWARAN
            $SQl = "SELECT A.produk, A.ukuran, B.alamat_lokasi, B.arah_pandang, A.periode, A.satuan_period, C.nama_kota, A.pph
                    FROM t_penawaran_hdr A
                    LEFT JOIN m_lokasi B ON B.kdlokasi = A.kdlokasi
                    LEFT JOIN m_kota C ON C.kdkota = B.kdkota
                    WHERE idpenawaran =".$id;
			
            $data['arr'] = $this->db->query($SQl)->row();
            
            #COMBOBOX LOKASI
            $SQl = "SELECT A.kdlokasi, CONCAT('[',B.nama_kota,']', ' - ', A.alamat_lokasi) 'ALAMAT', A.kdkota, B.nama_kota, B.kdprovinsi, C.nama_provinsi, A.alamat_lokasi, A.arah_pandang FROM m_lokasi A
                    LEFT JOIN m_kota B ON B.kdkota = A.kdkota
                    LEFT JOIN m_provinsi C ON C.kdprovinsi = B.kdprovinsi ORDER BY C.kdprovinsi";
            $lokasi = $this->db->query($SQl)->result_array();
            
            $i = 1;
            $akhir = count($data);
            $prov = '';
            $element = '<select name="FORM[kdlokasi]" class="form-control">';
            foreach($lokasi as $datas ){
                
                if($i != 1 ){
                    #SETERUSNYA
                    if($datas['kdprovinsi'] == $prov){
                        $element .= "<option ".($data['arr']->alamat_lokasi == $datas['alamat_lokasi'] ? 'selected="TRUE"' : '').">".$datas['ALAMAT']."</option>";
                    }else{
                        $element .= "</optgroup>";
                        $element .= "<optgroup label='".$datas['nama_provinsi']."'>";
                        $element .= "<option ".($data['arr']->alamat_lokasi == $datas['alamat_lokasi'] ? 'selected="TRUE"' : '').">".$datas['ALAMAT']."</option>";
                        if($akhir == $i){
                            $element .= "</optgroup>";    
                        }
                    }
                    $prov = $data['kdprovinsi'];
                }else{
                    #PERTAMA
                    $prov = $data['kdprovinsi'];
                    $element .= "<optgroup label='".$datas['nama_provinsi']."'>";
                    $element .= "<option ".($data['arr']->alamat_lokasi == $datas['alamat_lokasi'] ? 'selected="TRUE"' : '').">".$datas['ALAMAT']."</option>"; 
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
            
            #CONTENT EXECUTE
            echo $this->load->view($this->path.'/form', $data, TRUE);
        
        }
    }
    
    function form($id = null){
        $data['title'] = ucfirst($this->path);
        $data['id'] = $id;
		
		$query = "SELECT kdcabang, nama_cabang FROM m_cabang";
        $data['cabang'] = $this->actmain->get_combobox($query, 'kdcabang', 'nama_cabang', true);
		
        #COMBOBOX LOKASI
        $SQl = "SELECT A.kdlokasi, CONCAT('[',B.nama_kota,']', ' - ', A.alamat_lokasi) 'ALAMAT', A.kdkota, B.nama_kota, B.kdprovinsi, C.nama_provinsi, A.alamat_lokasi, A.arah_pandang FROM m_lokasi A
                LEFT JOIN m_kota B ON B.kdkota = A.kdkota
                LEFT JOIN m_provinsi C ON C.kdprovinsi = B.kdprovinsi ORDER BY C.kdprovinsi";
        $lokasi = $this->db->query($SQl)->result_array();
        
        $i = 1;
        $akhir = count($data)+1;
        $prov = '';
        $element = '<select class="form-control" name="FORM[kdlokasi]" id="kdlokasi" onchange="lok();">';
        foreach($lokasi as $datas ){
            if($i != 1 ){
                #SETERUSNYA
                if($datas['kdprovinsi'] == $prov){
                    $element .= "<option value='".$datas['kdlokasi']."' ".($data['arr']->alamat_lokasi == $datas['alamat_lokasi'] ? 'selected="TRUE"' : '').">".$datas['ALAMAT']."</option>";
                }else{
                    
                    $element .= "</optgroup>";
                    $element .= "<optgroup label='".$datas['nama_provinsi']."'>";
                    $element .= "<option  value='".$datas['kdlokasi']."'  ".($data['arr']->alamat_lokasi == $datas['alamat_lokasi'] ? 'selected="TRUE"' : '').">".$datas['ALAMAT']."</option>";
                    if($akhir == $i){
                        $element .= "</optgroup>";    
                    }
                }
                $prov = $datas['kdprovinsi'];
            }else{
                #PERTAMA
                $prov = $datas['kdprovinsi'];
				$element .= "<option  value=''></option>"; 
                $element .= "<optgroup label='".$datas['nama_provinsi']."'>";
                $element .= "<option  value='".$datas['kdlokasi']."' ".($data['arr']->alamat_lokasi == $datas['alamat_lokasi'] ? 'selected="TRUE"' : '').">".$datas['ALAMAT']."</option>"; 
            }
            $i++;    
        }
        $element .= '</select>';
        $data['lokasi'] = $element;
        
        echo $this->load->view($this->path.'/form', $data, TRUE);
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
            
            echo $this->load->view('penawaran/preview', $data, '');
    }
    
    function genPDF($id = null){
        $this->load->library('fpdf_gen');
        header("Content-type:application/pdf");
        #DETAIL HEADER DARI PENAWARAN
        $SQl = "SELECT A.produk, A.ukuran, B.alamat_lokasi, B.arah_pandang, A.periode, A.satuan_period, C.nama_kota, A.pph
                FROM t_penawaran_hdr A
                LEFT JOIN m_lokasi B ON B.kdlokasi = A.kdlokasi
                LEFT JOIN m_kota C ON C.kdkota = B.kdkota
                WHERE idpenawaran = 1";
        $hdr = $this->db->query($SQl)->row();
        
        #PENAWARAN DETAIL
        $SQl = "SELECT keterangan, harga FROM t_penawaran_dtl WHERE idpenawaranhdr = 1 ORDER BY idpenawarandtl";
        $dtl = $this->db->query($SQl)->result_array();
        
        foreach($dtl as $row){
            
        }
        
        #SETTING FPDF
		$this->fpdf->SetFont('Arial','B',16);
        //$this->fpdf->AddPage()
        $this->fpdf->SetY(50);
		$this->fpdf->Cell(0,10,'ESTIMASI BIAYA PERPANJANGAN',0,0,'C');
        $this->fpdf->Ln();
        $this->fpdf->Cell(0,5,'SEWA LOKASI BILLBOARD TOL SEDYATMO - BANDARA',0,0,'C');
        $this->fpdf->Line(20, 67, 210-20, 67); // 20mm from each edge
        
        $this->fpdf->SetFont('Arial','',12);
        $this->fpdf->SetY(70);
		$this->fpdf->Cell(0,10,'� Produk',0,0,'L');
        $this->fpdf->SetX(50);
        $this->fpdf->Cell(0,10,':',0,0,'');
        $this->fpdf->SetX(55);
        $this->fpdf->Cell(0,10,'asdasd'  ,0,0,'');
        $this->fpdf->Ln();
        
		$this->fpdf->Cell(0,0,'� Ukuran',0,0,'L');
        $this->fpdf->SetX(50);
        $this->fpdf->Cell(0,0,':',0,0,'');
        $this->fpdf->SetX(55);
        $this->fpdf->Cell(0,0,'asdasd'  ,0,0,'');
        $this->fpdf->Ln();
        
        $this->fpdf->Cell(0,10,'� Lokasi',0,0,'L');
        $this->fpdf->SetX(50);
        $this->fpdf->Cell(0,10,':',0,0,'');
        $this->fpdf->SetX(55);
        $this->fpdf->Cell(0,10,'asdasd'  ,0,0,'');
		$this->fpdf->Ln();
        
        $this->fpdf->Cell(0,0,'� Arah Pandang',0,0,'L');
        $this->fpdf->SetX(50);
        $this->fpdf->Cell(0,0,':',0,0,'');
        $this->fpdf->SetX(55);
        $this->fpdf->Cell(0,0,'asdasd'  ,0,0,'');
		$this->fpdf->Ln();
        
        $this->fpdf->SetFont('Arial','UB',12);
        $this->fpdf->SetY(110);
        $this->fpdf->Cell(0,0,'Biaya Sewa Meliputi :',0,0,'L');
        $this->fpdf->Ln();
        
        $this->fpdf->SetFont('Arial','',12);
        $this->fpdf->SetY(115);
        $this->fpdf->Cell(0,0,'� Pemakaian Konstruksi',0,0,'L');
        $this->fpdf->SetX(140);
        $this->fpdf->Cell(0,0,':',0,0,'');
        $this->fpdf->SetX(145);
        $this->fpdf->Cell(0,0,'asdasd'  ,0,0,'');
		$this->fpdf->Ln();
        
        $this->fpdf->SetY(120);
        $this->fpdf->Cell(0,0,'� Pemakaian Konstruksi',0,0,'L');
        $this->fpdf->SetX(140);
        $this->fpdf->Cell(0,0,':',0,0,'');
        $this->fpdf->SetX(145);
        $this->fpdf->Cell(0,0,'asdasd'  ,0,0,'');
		$this->fpdf->Ln();
        
        $this->fpdf->SetY(125);
        $this->fpdf->Cell(0,0,'� Pemakaian Konstruksi',0,0,'L');
        $this->fpdf->SetX(140);
        $this->fpdf->Cell(0,0,':',0,0,'');
        $this->fpdf->SetX(145);
        $this->fpdf->Cell(0,0,'asdasd'  ,0,0,'');
		$this->fpdf->Ln();
        
        $this->fpdf->SetY(130);
        $this->fpdf->Cell(0,0,'� Pemakaian Konstruksi',0,0,'L');
        $this->fpdf->SetX(140);
        $this->fpdf->Cell(0,0,':',0,0,'');
        $this->fpdf->SetX(145);
        $this->fpdf->Cell(0,0,'asdasd'  ,0,0,'');
		$this->fpdf->Ln();
        
		echo $this->fpdf->Output('hello_world.pdf','S');
    }
    
    function edit(){
        $data['title'] = 'Penawaran';
        $id = $this->uri->segment(3);
        #DETAIL HEADER DARI PENAWARAN
		
		$query = "SELECT kdcabang, nama_cabang FROM m_cabang ";
        $data['cabang'] = $this->actmain->get_combobox($query, 'kdcabang', 'nama_cabang', true);
		
        $SQl = "SELECT A.produk, A.ukuran, B.alamat_lokasi, B.arah_pandang, A.periode, A.satuan_period, C.nama_kota, A.pph, A.id_cabang
                FROM t_penawaran_hdr A
                LEFT JOIN m_lokasi B ON B.kdlokasi = A.kdlokasi
                LEFT JOIN m_kota C ON C.kdkota = B.kdkota
				WHERE A.idpenawaran = '".$id."' 
				
				
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
        $element = '<select class="form-control" name="FORM[kdlokasi]" id="kdlokasi" onchange="lok();">';
            foreach($lokasi as $datas ){
                if($i != 1 ){
                    #SETERUSNYA
                    if($datas['kdprovinsi'] == $prov){
                        $element .= "<option value='".$datas['kdlokasi']."' ".($data['arr']->alamat_lokasi == $datas['alamat_lokasi'] ? 'selected="TRUE"' : '').">".$datas['ALAMAT']."</option>";
                    }else{
                        
                        $element .= "</optgroup>";
                        $element .= "<optgroup label='".$datas['nama_provinsi']."'>";
                        $element .= "<option  value='".$datas['kdlokasi']."'  ".($data['arr']->alamat_lokasi == $datas['alamat_lokasi'] ? 'selected="TRUE"' : '').">".$datas['ALAMAT']."</option>";
                        if($akhir == $i){
                            $element .= "</optgroup>";    
                        }
                    }
                    $prov = $datas['kdprovinsi'];
                }else{
                    #PERTAMA
                    $prov = $datas['kdprovinsi'];
					$element .= "<option  value=''></option>"; 
                    $element .= "<optgroup label='".$datas['nama_provinsi']."'>";
                    $element .= "<option  value='".$datas['kdlokasi']."' ".($data['arr']->alamat_lokasi == $datas['alamat_lokasi'] ? 'selected="TRUE"' : '').">".$datas['ALAMAT']."</option>"; 
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
                FROM m_client A LEFT JOIN m_kota B ON B.kdkota = A.kdkota
                LEFT JOIN m_provinsi C ON C.kdprovinsi = B.kdprovinsi";
        $data['client'] = $this->actmain->get_combobox($SQl, 'id', 'nama', true);
		
        #FILE
        $SQl = "SELECT fileupload FROM t_penawaran_file WHERE idpenawaran= '".$id."'";
        $data['upload'] = $this->db->query($SQl)->row();
        
        #CONTENT EXECUTE
        echo $this->load->view($this->path . '/formEdit', $data, TRUE);
    }
    
    function update(){
        $data = $this->input->post('FORM');
        $detail = $this->input->post('penawaran');
        $user_create = $this->newsession->userdata('username');
        $pph = $this->input->post('pph');
        $total_harga = $this->input->post('total_harga');
        $file_name = $this->input->post('file_name');
        $user_create = $this->newsession->userdata('username');
        $idpenawaran = $this->input->post('idpenawaran');
        
        $this->db->trans_start();
        
        $sql = "UPDATE t_penawaran_hdr SET 
                    produk = '".$data['produk']."', 
                    ukuran = '".$data['ukuran']."', 
                    kdlokasi = '".$data['kdlokasi']."', 
                    periode = '".$data['periode']."', 
                    satuan_period = '".$data['satuan_period']."'
                WHERE idpenawaran = '".$idpenawaran."'
                ";
        $this->db->query($sql);
        
        #DETAIL
        $max = count($detail['ket'])-1;
        
        $sql = "DELETE FROM t_penawaran_dtl WHERE idpenawaranhdr = '".$idpenawaran."'";
        $this->db->query($sql);
        
        for($i = 0; $i<= $max; $i++){
            $sql = "INSERT INTO t_penawaran_dtl(idpenawaranhdr, keterangan, harga, date_create, user_create)
                VALUES('".$idpenawaran."', '".$detail['ket'][$i]."', '".$detail['res'][$i]."', NOW(), '".$user_create."')
                ";
            $this->db->query($sql);    
        }
        
        #FILE
        $sql = "SELECT fileupload FROM t_penawaran_file";
        $dat = $this->db->query($sql)->row();
        
        if($dat->fileupload != $file_name){
            $sql = "UPDATE t_penawaran_file SET fileupload = '".$file_name."', date_create = NOW() WHERE idpenawaran='".$id."'";
            $this->db->query($sql);    
        }
        
        $this->db->trans_complete();
        
        
        if($this->db->trans_status() === FALSE){
            $msg = "Gagal Mengubah";
        }else{
            $msg = "Berhasil Mengubah Penawaran";
        }
        echo $msg;
        die();
    }

    function uploadForm(){
        $data['title'] = ucfirst($this->path);
        $data['id'] = $id;
		
		$query = "SELECT kdcabang, nama_cabang FROM m_cabang";
        $data['cabang'] = $this->actmain->get_combobox($query, 'kdcabang', 'nama_cabang', true);
		
        #COMBOBOX LOKASI
        $SQl = "SELECT A.kdlokasi, CONCAT('[',B.nama_kota,']', ' - ', A.alamat_lokasi) 'ALAMAT', A.kdkota, B.nama_kota, B.kdprovinsi, C.nama_provinsi, A.alamat_lokasi, A.arah_pandang FROM m_lokasi A
                    LEFT JOIN m_kota B ON B.kdkota = A.kdkota
                    LEFT JOIN m_provinsi C ON C.kdprovinsi = B.kdprovinsi ORDER BY C.kdprovinsi";
        $lokasi = $this->db->query($SQl)->result_array();

        $i = 1;
        $akhir = count($data)+1;
        $prov = '';
        $element = '<select class="form-control" name="kdlokasi">';
        foreach($lokasi as $datas ){
            if($i != 1 ){
                #SETERUSNYA
                if($datas['kdprovinsi'] == $prov){
                    $element .= "<option value='".$datas['kdlokasi']."' ".($data['arr']->alamat_lokasi == $datas['alamat_lokasi'] ? 'selected="TRUE"' : '').">".$datas['ALAMAT']."</option>";
                }else{

                    $element .= "</optgroup>";
                    $element .= "<optgroup label='".$datas['nama_provinsi']."'>";
                    $element .= "<option  value='".$datas['kdlokasi']."'  ".($data['arr']->alamat_lokasi == $datas['alamat_lokasi'] ? 'selected="TRUE"' : '').">".$datas['ALAMAT']."</option>";
                    if($akhir == $i){
                        $element .= "</optgroup>";
                    }
                }
                $prov = $datas['kdprovinsi'];
            }else{
                #PERTAMA
                $prov = $datas['kdprovinsi'];
                $element .= "<optgroup label='".$datas['nama_provinsi']."'>";
                $element .= "<option  value='".$datas['kdlokasi']."' ".($data['arr']->alamat_lokasi == $datas['alamat_lokasi'] ? 'selected="TRUE"' : '').">".$datas['ALAMAT']."</option>";
            }
            $i++;
        }
        $element .= '</select>';
        $data['lokasi'] = $element;

        echo $this->load->view($this->path.'/upload', $data, TRUE);
    }

    function uploadFile(){
        $config['upload_path']          = './template/upload/penawaran';
        $config['allowed_types']        = '*';
        $config['max_size']             = 100000;
        $config['overwrite']             = TRUE;
        $new_name = rand(0,9)."_".$_FILES["files"]['name'];
        $config['file_name'] = $new_name;

        $this->load->library('upload', $config);

        $kdlokasi = $this->input->post('kdlokasi');


        if (!$this->upload->do_upload('files')) {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        } else {
            $data = array('upload_data' => $this->upload->data());

            $inputFileName = $data['upload_data']['file_path'] . $new_name;

            //  Read your Excel workbook
            try {
                $this->load->library('Excel');
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);

                #S: HEADER
                $sheet = $objPHPExcel->getSheet(0);
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();

                $rowData[] = array();
                $i = 0;
                for ($row = 6; $row <= $highestRow; $row++) {
                    //  Read a row of data into an array
                    $data = $sheet->rangeToArray('B' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

                        if ($data[0][0] != '') {
                            $rowData[] = $data;
                        }

                    //$SQL = "INSERT INTO m_kota(kdkota, kdprovinsi, nama_kota) VALUES('" . $rowData["data"][0][0] . "', '$kdprov', '" . $rowData["data"][0][1] . "')";
                    //$this->db->query($SQL);
                    $i++;
                }
                #E: HEADER
                echo "<pre>";

                foreach ($rowData as $key=>$val) {
                    if(empty($val)){
                        unset($rowData[$key]);
                    }
                }

                $rowData = array_values($rowData);

                #S: DETAIL
                $sheet = $objPHPExcel->getSheet(1);
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();

                $rowData[] = array();
                $i = 0;
                for ($row = 5; $row <= $highestRow; $row++) {
                    //  Read a row of data into an array
                    $rowDatas[] = $sheet->rangeToArray('B' . $row . ':' . 'D' . $row, NULL, TRUE, FALSE);

                    $i++;
                }
                #E: DETAIL
                print_r($rowDatas);
            } catch (Exception $e) {
                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
            }
        }

    }
	
	function arah(){
		$id = $this->input->post('id');
		$SQL = "SELECT arah_pandang FROM m_lokasi WHERE kdlokasi = '".$id."'";
		$dat = $this->db->query($SQL)->row();
		echo $dat->arah_pandang;
	}
}