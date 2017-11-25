<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['title'] = 'E-Watch'; 
$config['base_url'] = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$config['base_url'] .= "://" . $_SERVER['HTTP_HOST'];
$config['base_url'] .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
$config['index_page'] = '';
$config['uri_protocol'] = 'AUTO';
$config['url_suffix'] = '';
$config['language'] = 'english';
$config['charset'] = 'utf8_unicode_ci';
$config['enable_hooks'] = FALSE;
$config['subclass_prefix'] = 'PROJECT_';
$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-|;,';
$config['allow_get_array'] = TRUE;
$config['enable_query_strings'] = FALSE;
$config['controller_trigger'] = 'c';
$config['function_trigger'] = 'm';
$config['directory_trigger'] = 'd'; // experimental not currently in use
$config['log_threshold'] = 0;
$config['log_path'] = '';
$config['log_date_format'] = 'Y-m-d H:i:s';
$config['cache_path'] = '';
$config['encryption_key'] = "8c8e295d5b8df766557bfdb9cea017b0"; //md5(edi indonesia)
$config['sess_cookie_name'] = 'EFILING-sess';
$config['sess_expiration'] = 3600;
$config['sess_expire_on_close'] = TRUE;
$config['sess_encrypt_cookie'] = FALSE;
$config['sess_use_database'] = FALSE;
$config['sess_table_name'] = 'EFILING-sess';
$config['sess_match_ip'] = TRUE;
$config['sess_match_useragent'] = TRUE;
$config['sess_time_to_update'] = 300;
$config['cookie_prefix'] = "";
$config['cookie_domain'] = "";
$config['cookie_path'] = "/";
$config['cookie_secure'] = FALSE;
$config['global_xss_filtering'] = TRUE;
$config['csrf_protection'] = FALSE;
$config['csrf_token_name'] = 'csrf_test_name';
$config['csrf_cookie_name'] = 'csrf_cookie_name';
$config['csrf_expire'] = 7200;
$config['compress_output'] = FALSE;
$config['time_reference'] = 'local';
$config['rewrite_short_tags'] = TRUE;
$config['proxy_ips'] = '';
$config['bulan_id'] = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');


#$config['mail_config'] = array('FROM' => 'inspeksi.alkes@kemkes.go.id', 'NAME' => 'e-Watch Alat Kesehatan dan PKRT', 'BCC' => 'inspeksi_alkes_pkrt@yahoo.com;arifrachman93@gmail.com');
/**/