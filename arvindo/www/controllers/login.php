<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }
class login extends CI_Controller {
    function index() {
        if ($this->newsession->userdata('logged_in')) {
           redirect(site_url('dashboard'));
        }

        $data = array('menulist' => $menulist);

        echo $this->load->view("home", $data, true);
    }

    function home() {
        
        if ($this->newsession->userdata('logged_in')) {
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
             echo $this->load->view('dashboard', $arr, TRUE);
        }
        else {
            $this->load->model('m_absensi', 'mv');
            //echo $this->mv->table($listName, $id = '', $param1 = '', $param2 = '', $param3 = '');
            echo $this->load->view("welcome/out", $data, true);
        }
    }
    
    
    
    function verify($fungsi) {
        $this->load->model('actVerify');
        $data = $this->actVerify->$fungsi();
        echo $data;
        die();
    }
    
    function logout(){
        $this->load->model('actVerify');
        $data = $this->actVerify->logout();
        redirect(site_url());
    }
}