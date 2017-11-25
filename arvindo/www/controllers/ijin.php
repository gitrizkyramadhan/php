<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }
class ijin extends CI_Controller {
    
    var $content = '';
    var $arr = array();
    var $path = 'ijin'; //pathview dan model
    
    function __construct(){
        parent::__construct();
        $this->load->model('m_'.$this->path, 'mv');
    }
    
    function getTable($listName, $id = '', $param1 = '', $param2 = '', $param3 = '') {
        $id = urldecode($id);
        $param1 = urldecode($param1);
        $param2 = urldecode($param2);
        $param3 = urldecode($param3);
        $table['title'] = 'Ijin Realisasi';     
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
    
    function pajak_dtl($id = '') {
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
        print_r($_POST);
        die();
    }
    
}