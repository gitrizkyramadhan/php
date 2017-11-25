<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }
class mockups extends CI_Controller {
    
    var $content = '';
    var $arr = array();
    var $path = 'penawaran'; //pathview dan model
    
    function __construct(){
        parent::__construct();
        $this->load->model('m_'.$this->path, 'mv');
    }
    
    function index() {
        if ($this->newsession->userdata('logged_in')) {            
            $data = array(
              'meta' => $this->load->view('meta/meta', '', TRUE),
              'meta_foot' => $this->load->view('meta/meta_foot', '', TRUE),
              'footer' => $this->load->view('meta/footer', '', TRUE),
              'sidebar'  => $this->load->view('meta/sidebar', '', TRUE),
              'content' => ''
            );
            
            $this->parser->parse('mockup', $data);     
        }else{
            redirect(site_url());
        }
    }
    
}