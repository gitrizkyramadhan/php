<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Newsession {

    var $CI;
    var $salt = "qza";

    function Newsession($params = array()) {
        @session_start();
        $this->CI = & get_instance();
        $this->salt = $this->CI->config->config['sess_cookie_name'];
    }

    function set_userdata($newdata = array(), $newval = '') {
        if (is_string($newdata)) {
            $_SESSION[$this->salt . $newdata] = $newval;
            return;
        }

        if (count($newdata) > 0) {
            foreach ($newdata as $key => $val) {
                $_SESSION[$this->salt . $key] = $val;
            }
            return;
        }
    }

    function userdata($item) {
        return (!isset($_SESSION[$this->salt . $item])) ? FALSE : $_SESSION[$this->salt . $item];
    }

    function sess_destroy() {
        @session_unset();
        @session_destroy();
    }

}

?>