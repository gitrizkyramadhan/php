<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }
class download extends CI_Controller {
    
    var $content = '';
    var $arr = array();
    
    function upload($act) {
        if($act == 'provinsi'){
            // make sure it's a file before doing anything!
              if(is_file($path))
              {
                $path = str_replace(__DIR__. '/../../template/', 'file:///', '');
                $name = 'provinsi.xlsx';
                file_get_contents($path.$name);
            
        }
    }
    
}
}
