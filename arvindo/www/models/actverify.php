<?php
session_start();
if (!defined('BASEPATH')) exit('No direct script access allowed');
class actVerify extends CI_Model {

    function login() {

        $uid = $this->input->post('UserID');
        $pass = md5($this->input->post('Password'));
        $code = $this->input->post('KeyCode');
        $captcha = $_SESSION['captkodex'];

        if (strtolower($code) == strtolower($captcha)) {
          
            $sql = "SELECT * FROM m_user WHERE username = ".$this->db->escape($uid) . " AND password = " . $this->db->escape($pass)."";
            $user = $this->actmain->get_rows($sql);
            $dat = $this->db->query($sql)->row();
            
            if (count($user) > 0) {
                if ($user['password'] === $pass) {
                    #create session
                    $user['username'] = $uid;
                    $user['logged_in'] = true;
                    $user['status'] = $dat->status;
                    unset($user['password']);
                    $this->newsession->set_userdata($user);


                    $rtn = "MSG|DIRECT|Login Berhasil.|" . site_url('dashboard');
                }
                else {
                    $rtn = 'MSG|OK|User atau Password anda salah.';
                }
            }
            else {
                $rtn = 'MSG|OK|User anda tidak ditemukan.';
            }
        }
        else {
            $rtn = 'MSG|OK|Maaf, Kode yang anda masukan salah';
        }
        return $rtn;
    }

    function logout() {
        $this->newsession->sess_destroy();
        $visit = array('visit' => 2, 'location' => 2);
        $this->newsession->set_userdata($visit);
        return 'backtohome';
    }
}