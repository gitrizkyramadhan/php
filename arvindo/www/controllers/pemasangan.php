<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }
class pemasangan extends CI_Controller {
    
    var $content = '';
    var $arr = array();
    
    function index() {
        if ($this->newsession->userdata('logged_in')) {
            $this->content == '' ? $content = $this->load->view('pemasangan/view', $arr, '') : $content = $this->content;    
            
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