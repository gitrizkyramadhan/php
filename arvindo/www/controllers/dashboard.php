<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class dashboard extends CI_Controller {

    var $content = '';
    var $arr = array();

    function index() {

        $this->load->model('m_dash', 'mv');
        
        $arr['listrik'] = $this->mv->list_dash('listrik');
        $arr['pajak'] = $this->mv->list_dash('pajak');
        $arr['ijinlokasi'] = $this->mv->list_dash('ijinlokasi');
        $arr['tagihan'] = $this->mv->list_dash('tagihan');
        $arr['cpenawaran'] = $this->mv->count('penawaran');
        $arr['cpo'] = $this->mv->count('po');
        $arr['cproduksi'] = $this->mv->count('produksi');
        $arr['clistrik'] = $this->mv->count('listrik');
        $arr['creal'] = $this->mv->count('relisasi');
        

        if ($this->newsession->userdata('logged_in')) {
            $this->content == '' ? $content = $this->load->view('dashboard', $arr, TRUE) : $content = $this->content;

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

}
