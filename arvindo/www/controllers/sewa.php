<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }
class sewa extends CI_Controller {
    
    var $content = '';
    var $arr = array();
    var $path = 'sewa'; //pathview dan model
    
    function __construct(){
        parent::__construct();
        $this->load->model('m_'.$this->path, 'mv');
    }
    
    function getTable($listName, $id = '', $param1 = '', $param2 = '', $param3 = '') {
        $id = urldecode($id);
        $param1 = urldecode($param1);
        $param2 = urldecode($param2);
        $param3 = urldecode($param3);
        $table['title'] = 'Sewa';     
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
    
    function sewa_dtl($id = '') {
        $id = urldecode($id);
        echo $this->mv->table_detail($id);
        
    }
    
    function action($act, $id = null){
        if($act == 'add'){
            
        }else if($act == 'edit'){
            #CONTENT EXECUTE
            echo $this->load->view($this->path.'/form', $data, TRUE);
        
        }else if($act == 'delete'){
            
        }else{
            
        }
    }
    
    function form($id = null){
        $data['title'] = ucfirst($this->path);        
        echo $this->load->view($this->path.'/form', $data, TRUE);
    }
    
    function add(){
        
        $nomor_ijin = $this->input->post('nomor_ijin');
        $tgl_ijin = $this->input->post('tgl_ijin');
        $tgl_akhir = $this->input->post('tgl_akhir');
        $nominal = $this->input->post('nominal');
        $file_name = $this->input->post('file_name');
        $kdlokasi = $this->input->post('kdlokasi');
        $user_create = $this->newsession->userdata('username');
        
        $this->db->trans_start();
        
        $sql = "INSERT INTO m_lokasi_sewa(kdlokasi, nomor_ijin, tgl_ijin, tgl_akhir, nominal, date_create, user_create)
                VALUES ('".$kdlokasi."', '".$nomor_ijin."', '".$tgl_ijin."', '".$tgl_akhir."', '".$nominal."', NOW(), '".$user_create."')";
        $this->db->query($sql);
        
        $sql = "INSERT INTO m_lokasi_sewa_file(idijin, fileupload, date_create)
        VALUES( '".$kdlokasi."', '".$file_name."', NOW())";
        $this->db->query($sql);
        
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            echo "Gagal Menambahkan";
        }else{
            echo "Berhasil Menambahkan";
        }
        die();
       
    }
    
}