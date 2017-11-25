<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }
class inventaris extends CI_Controller {
    
    var $content = '';
    var $arr = array();
    
    function __construct(){
        parent::__construct();
        $this->load->model('m_inventoris', 'mv');    
    }
    
    function index() {
        if ($this->newsession->userdata('logged_in')) {
            
            $arr['table'] = $this->mv->table2();
            $this->content == '' ? $content = $this->load->view('inventoris/view', $arr, TRUE) : $content = $this->content;    
            
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
        echo $this->mv->table2($id, $param1, $param2, $param3);
    }
    
    function table2(){
        $data['table'] = $this->mv->table();
        echo $this->load->view('table', $data);
    }
    
    function action($act, $data, $id = null){
        if($act == 'add'){
            
        }else if($act == 'update'){
            
        }else if($act == 'delete'){
            
        }else{
            
        }
    }
    
    function edit($id){
        
    }
    
    function preview($id){
             
    }
    
    function printing($id){
        
    }
    
    function upload(){
        
    }
}