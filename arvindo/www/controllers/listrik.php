<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }
class listrik extends CI_Controller {
    
    var $content = '';
    var $arr = array();
    var $path = 'listrik'; //pathview dan model
    
    function __construct(){
        parent::__construct();
        $this->load->model('m_'.$this->path, 'mv');
    }
    
    function getTable($listName, $id = '', $param1 = '', $param2 = '', $param3 = '') {
        $id = urldecode($id);
        $param1 = urldecode($param1);
        $param2 = urldecode($param2);
        $param3 = urldecode($param3);
        $table['title'] = 'Listrik';     
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
    
    function action($act, $id = null){
        if($act == 'add'){
            
        }else if($act == 'edit'){
        
        }else if($act == 'delete'){
            
        }else{
            
        }
    }
    
    function hapus($id){
        $sql = "SELECT * FROM t_listrik WHERE id = '".$id."'";
        $data = $this->db->query($sql)->num_rows();
        if($data != 0){
            $msg = "Gagal Menghapus, Voucer Listrik Telah Terpakai !";
            print "<script>";
            echo "alert('".$msg."');";
            echo "location.href='".site_url('mockups#listrik/getTable')."'";
            print "</script>";
            die();
        }
        
        $sql = "DELETE FROM t_listrik WHERE id = '".$id."'";
        
        $this->db->trans_start();                    
            $this->db->query($sql);    
        $this->db->trans_complete();
        
            if($this->db->trans_status() === FALSE){
                $msg = "Gagal Menambahkan";
            }else{
                $msg =  "Berhasil Menghapus ".$data;
            }
            print "<script>";
            echo "alert('".$msg."');";
            echo "location.href='".site_url('mockups#listrik/getTable')."'";
            print "</script>";
            die();
    }
    
    function add(){
        $user_create = $this->newsession->userdata('username');
        $tgl_beli = $this->input->post('tgl_beli');
        $nominal = $this->input->post('nominal');
        $watt = $this->input->post('watt');
        $keterangan = $this->input->post('keterangan');
        $file_name = $this->input->post('file_name');
        $user_create = $this->newsession->userdata('username');
                
        $this->db->trans_start();
            
        $sql = "INSERT INTO t_listrik(tgl_beli, nominal, watt, user_created, STATUS, keterangan, date_create) 
                VALUES ('".$tgl_beli."', '".$nominal."', '".$watt."', '".$user_create."', '0', '".$keterangan."', NOW() )";
        $this->db->query($sql);
        $last_id = $this->db->insert_id();
                
        $sql = "INSERT INTO t_listrik_file(idlistrik, keterangan, fileupload, date_create, user_create)
        VALUES( '".$last_id."', '".$keterangan."','".$file_name."', NOW(), '".$user_create."')";
        $this->db->query($sql);

        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            echo "Gagal Menambahkan";
        }else{
            echo "Berhasil Menambahkan";
        }
        die();
    }
    
    function form($id = null){
        $data['title'] = 'Listrik';
        echo $this->load->view($this->path.'/form', $data, TRUE);
    }
    
    function detilListrik($id){
        $sql = "SELECT fileupload FROM t_listrik_file WHERE idlistrik = '".$id."'";
        $data = $this->db->query($sql)->row();
        
        print "<table>";
        print "<tr>";
        print "<td>";
        //echo "Jawa Barat, Kota <br/> AlamatAlamatAlamatAlamatAlamatAlamatAlamat";
        print "</td>";
        print "<td rowspan='5'>";
        
        if($data->fileupload != ''){
            echo "<b>Preview Scan Voucer Listrik :</b> <br/><a href='".$data->fileupload."' target='_blank'><img src='".$data->fileupload."' height='200' /></a>";
        }else{
            echo "<b>Belum Ada Photo</b>";
        }
        
        print "</td>";    
        print "</tr>";
        /*
        print "<tr>";
        print "<td>";
        echo "ASd";
        print "</td>";
        print "</tr>";
        */
        print "</table>";
    }
}