<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }
class master extends CI_Controller {
    
    var $content = '';
    var $arr = array();
    var $path = 'master'; //pathview dan model
    
    function __construct(){
        parent::__construct();
        $this->load->model('m_'.$this->path, 'mv');    
    }
    
    function ListData(){
        if ($this->newsession->userdata('logged_in')) {
            
            $listName = strtolower($this->uri->segment(3));
            if($listName == 'karyawan'){
                $arr['table'] =  $this->mv->table_karyawan($id, $param1, $param2, $param3);
                $arr['title'] = 'Karyawan'; 
                   
            }else if($listName == 'provinsi'){
                $arr['table'] =  $this->mv->table_prov($id, $param1, $param2, $param3);
                $arr['title'] = 'Provinsi';
                
            }else if($listName == 'kota'){
                $arr['table'] =  $this->mv->table_kota($id, $param1, $param2, $param3);
                $arr['title'] = 'Kota';
                
            }else if($listName == 'lokasi'){
                $arr['table'] =  $this->mv->table_lokasi($id, $param1, $param2, $param3);
                $arr['title'] = 'Lokasi';
                
            }else if($listName == 'cabang'){
                $arr['table'] =  $this->mv->table_cabang($id, $param1, $param2, $param3);
                $arr['title'] = 'Cabang';
                
            }else if($listName == 'client'){
                $arr['table'] =  $this->mv->table_client($id, $param1, $param2, $param3);
                $arr['title'] = 'Client';
                
            }else if($listName == 'barang'){
                $arr['table'] =  $this->mv->table_barang($id, $param1, $param2, $param3);
                $arr['title'] = 'Barang';
                
            }else if($listName == 'suplier'){
                $arr['table'] =  $this->mv->table_suplier($id, $param1, $param2, $param3);
                $arr['title'] = 'Suplier';
                
            }else if($listName == 'atk'){
                $arr['table'] =  $this->mv->table_atk($id, $param1, $param2, $param3);
                $arr['title'] = 'Inventaris';
                
            }else if($listName == 'users'){
                $arr['table'] =  $this->mv->table_users($id, $param1, $param2, $param3);
                $arr['title'] = 'Manage User';
                
            }
            
            echo $this->content == '' ? $content = $this->load->view($this->path.'/view', $arr, TRUE) : $content = $this->content;    
            
            //$data = array(
//              'meta' => $this->load->view('meta/meta', '', TRUE),
//              'meta_foot' => $this->load->view('meta/meta_foot', '', TRUE),
//              'footer' => $this->load->view('meta/footer', '', TRUE),
//              'sidebar'  => $this->load->view('meta/sidebar', '', TRUE),
//              'content' => $content
//            );
//            
//            $this->parser->parse('mockup', $data);     
        }else{
            redirect(site_url());
        }
    }
    
     function getTable($listName, $id = '', $param1 = '', $param2 = '', $param3 = '') {
        $id = urldecode($id);
        $param1 = urldecode($param1);
        $param2 = urldecode($param2);
        $param3 = urldecode($param3);
        
        if($listName == 'karyawan'){
            echo $this->mv->table_karyawan($id, $param1, $param2, $param3);
                
        }else if($listName == 'provinsi'){
            echo $this->mv->table_prov($id, $param1, $param2, $param3);
            
        }else if($listName == 'kota'){
            echo $this->mv->table_kota($id, $param1, $param2, $param3);
            
        }else if($listName == 'lokasi'){
            echo $this->mv->table_lokasi($id, $param1, $param2, $param3);
            
        }else if($listName == 'client'){
            echo $this->mv->table_client($id, $param1, $param2, $param3);
			
        }else if($listName == 'barang'){
            echo $this->mv->table_barang($id, $param1, $param2, $param3);
			
        }else if($listName == 'cabang'){
            echo $this->mv->table_cabang($id, $param1, $param2, $param3);
			
        }else if($listName == 'suplier'){
            echo $this->mv->table_suplier($id, $param1, $param2, $param3);
			
        }else if($listName == 'users'){
            echo $this->mv->table_users($id, $param1, $param2, $param3);
			
        }else if($listName == 'atk'){
            echo $this->mv->table_atk($id, $param1, $param2, $param3);
        }
        
        
    }
    
    function dataForm(){
    
        $listName = strtolower($this->uri->segment(3));
        if($listName == 'karyawan'){
            $arr['title'] = 'Karyawan'; 
               
        }else if($listName == 'provinsi'){
            $arr['title'] = 'Provinsi';
            
        }else if($listName == 'kota'){
            $query = "SELECT kdprovinsi, nama_provinsi FROM m_provinsi";
            $arr['result'] = $this->actmain->get_combobox($query, 'kdprovinsi', 'nama_provinsi', true);
            $arr['title'] = 'Kota';
            
        }else if($listName == 'lokasi'){
            $query = "SELECT kdprovinsi, nama_provinsi FROM m_provinsi";
            $arr['result'] = $this->actmain->get_combobox($query, 'kdprovinsi', 'nama_provinsi', true);
            $arr['title'] = 'Lokasi';
            
        }else if($listName == 'cabang'){
            $query = "SELECT kdprovinsi, nama_provinsi FROM m_provinsi";
            $arr['result'] = $this->actmain->get_combobox($query, 'kdprovinsi', 'nama_provinsi', true);
            $arr['title'] = 'Cabang';
            
        }else if($listName == 'client'){
            $query = "SELECT kdprovinsi, nama_provinsi FROM m_provinsi";
            $arr['result'] = $this->actmain->get_combobox($query, 'kdprovinsi', 'nama_provinsi', true);
            $arr['title'] = 'Client';
			
        }else if($listName == 'barang'){
			$query = "SELECT kd_suplier, nama_suplier FROM m_suplier";
			$arr['result'] = $this->actmain->get_combobox($query, 'kd_suplier', 'nama_suplier', true);
			
			$query = "SELECT (count_brg+1) 'count_brg' FROM m_setting";
			$query = $this->db->query($query)->row();
			$arr['jml'] = "BRG".str_pad($query->count_brg, 5, '0', STR_PAD_LEFT);
            $arr['title'] = 'Barang';
            
        }else if($listName == 'suplier'){
            $arr['title'] = 'Suplier';
            
        }else if($listName == 'kdatk'){
			$query = "SELECT kdcabang, nama_cabang FROM m_cabang";
			$arr['cabang'] = $this->actmain->get_combobox($query, 'kdcabang', 'nama_cabang', true);
            $arr['title'] = 'Inventaris';
            
        }else if($listName == 'users'){
			$query = "SELECT kdcabang, nama_cabang FROM m_cabang";
			$arr['cabang'] = $this->actmain->get_combobox($query, 'kdcabang', 'nama_cabang', true);
			
			$query = "SELECT kode, status FROM t_role";
			$arr['role'] = $this->actmain->get_combobox($query, 'kode', 'status', true);
			
            $arr['title'] = 'User';
            
        }
        
        $this->content =  $this->load->view($this->path.'/form_'.strtolower($listName), $arr, TRUE);
        $this->ListData();          
    }
    
    function uploadForm(){
    
        $listName = strtolower($this->uri->segment(3));
        if($listName == 'karyawan'){
            $arr['title'] = 'Karyawan'; 
               
        }else if($listName == 'provinsi'){
            $arr['title'] = 'Provinsi';
            
        }else if($listName == 'kota'){
            $query = "SELECT kdprovinsi, nama_provinsi FROM m_provinsi";
            $arr['result'] = $this->actmain->get_combobox($query, 'kdprovinsi', 'nama_provinsi', true);
            $arr['title'] = 'Kota';
            
        }else if($listName == 'lokasi'){
            $query = "SELECT kdprovinsi, nama_provinsi FROM m_provinsi";
            $arr['result'] = $this->actmain->get_combobox($query, 'kdprovinsi', 'nama_provinsi', true);
            $arr['title'] = 'Lokasi';
            
        }else if($listName == 'cabang'){
            $query = "SELECT kdprovinsi, nama_provinsi FROM m_provinsi";
            $arr['result'] = $this->actmain->get_combobox($query, 'kdprovinsi', 'nama_provinsi', true);
            $arr['title'] = 'Cabang';
            
        }else if($listName == 'client'){
            $query = "SELECT kdprovinsi, nama_provinsi FROM m_provinsi";
            $arr['result'] = $this->actmain->get_combobox($query, 'kdprovinsi', 'nama_provinsi', true);
            $arr['title'] = 'Client';
			
        }else if($listName == 'barang'){
			$query = "SELECT (count_brg+1) 'count_brg' FROM m_setting";
			$query = $this->db->query($query)->row();
			$arr['jml'] = "BRG".str_pad($query->count_brg, 5, '0', STR_PAD_LEFT);
            $arr['title'] = 'Barang';
            
        }
        
        $this->content =  $this->load->view($this->path.'/upload_'.strtolower($listName), $arr, TRUE);
        $this->ListData();          
    }
    
    function action($act, $data, $id = null){

        if($act == 'add'){
            if($data == 'provinsi'){
                $kode = $this->input->post('kode');
                $nama = $this->input->post('nama');
                
                $this->db->trans_start();
                
                $sql = "INSERT INTO m_provinsi(kdprovinsi, nama_provinsi) VALUES ('".$kode."', '".$nama."')";
                $this->db->query($sql);
                
                $this->db->trans_complete();
                if($this->db->trans_status() === FALSE){
                    echo "Gagal Menambahkan";
                }else{
                    echo "Berhasil Menambahkan";
                }
                die();
               
            }else if($data == 'kota'){
                $kdprov = $this->input->post('kdprov');
                $kdkota = $this->input->post('kodekota');
                $nama = $this->input->post('namakota');
                
                $this->db->trans_start();
                
                $sql = "INSERT INTO m_kota(kdprovinsi, kdkota, nama_kota) VALUES ('".$kdprov."', '".$kdkota."', '".$nama."')";
                $this->db->query($sql);
                
                $this->db->trans_complete();
                if($this->db->trans_status() === FALSE){
                    echo "Gagal Menambahkan";
                }else{
                    echo "Berhasil Menambahkan";
                }
                die();
                
            }else if($data == 'cabang'){
                
                $nama_cabang = $this->input->post('nama_cabang');
                $alamat_cabang = $this->input->post('alamat_cabang');
                $kdkota = $this->input->post('kdkota');
                $kdcabang = 'CBG'.$kdkota;
                
                $this->db->trans_start();
                    
                $sql = "INSERT INTO m_cabang(kdcabang, nama_cabang, alamat_cabang, kdkota, status) 
                        VALUES ('".$kdcabang."', '".$nama_cabang."', '".$alamat_cabang."', '".$kdkota."', '1')";
                $this->db->query($sql);
                
                $this->db->trans_complete();
                if($this->db->trans_status() === FALSE){
                    echo "Gagal Menambahkan";
                }else{
                    echo "Berhasil Menambahkan";
                }
                die();
                
            }else if($data == 'lokasi'){
                
                $kdlokasi = $this->input->post('kdlokasi');
                $kdkota = $this->input->post('kdkota');
                $nama_lokasi = $this->input->post('nama_lokasi');
                $alamat_lokasi = $this->input->post('alamat_lokasi');
                $arah_pandang = $this->input->post('arah_pandang');
                $status = $this->input->post('status');
                $user_create = $this->newsession->userdata('username');
                $file_name = $this->input->post('file_name');
                
                $this->db->trans_start();
                    
                $sql = "INSERT INTO m_lokasi(kdlokasi, kdkota, nama_lokasi, alamat_lokasi, arah_pandang, kdstatus, date_create, user_create) 
                        VALUES ('".$kdlokasi."', '".$kdkota."', '".$nama_lokasi."', '".$alamat_lokasi."', '".$arah_pandang."','".$status."', NOW(), '".$user_create."')";
                $this->db->query($sql);
                $last_id = $kdlokasi;
                
                $sql = "INSERT INTO m_lokasi_ijin_file(idijin, fileupload, date_create)
                VALUES( '".$last_id."', '".$file_name."', NOW())";
                $this->db->query($sql);
                
                $this->db->trans_complete();
                if($this->db->trans_status() === FALSE){
                    echo "Gagal Menambahkan";
                }else{
                    echo "Berhasil Menambahkan";
                }
                die();
                
            }else if($data == 'client'){
                
                $kdkota = $this->input->post('kdkota');
                $nama = $this->input->post('nama');
                $alamat = $this->input->post('alamat');
                $npwp = $this->input->post('npwp');
                $status = $this->input->post('status');
                $user_create = $this->newsession->userdata('username');
                $file_name = $this->input->post('file_name');
                
                $this->db->trans_start();
                    
                $sql = "INSERT INTO m_client(nama, kdkota, alamat, npwp, date_create, user_create, status) 
                        VALUES ('".$nama."', '".$kdkota."', '".$alamat."', '".$npwp."', NOW(),  '".$user_create."', '".$status."')";
                $this->db->query($sql);
                
                $this->db->trans_complete();
                if($this->db->trans_status() === FALSE){
                    echo "Gagal Menambahkan";
                }else{
                    echo "Berhasil Menambahkan";
                }
                die();
                
            }else if($data == 'karyawan'){
                
                $npwp = $this->input->post('npwp');
                $nama = $this->input->post('nama');
                $alamat_asl = $this->input->post('alamat_asl');
                $alamat_dom = $this->input->post('alamat_dom');
                $nomor_hp = $this->input->post('nomor_hp');
                $jns_kelamin = $this->input->post('jns_kelamin');
                $tgl_lahir = $this->input->post('tgl_lahir');
                $agama = $this->input->post('agama');
                $gaji_harian = $this->input->post('gaji_harian');
                $gaji_pokok = $this->input->post('gaji_pokok');
                $status = $this->input->post('status');
                
                $user_create = $this->newsession->userdata('username');
                
                $this->db->trans_start();
                    
                $sql = "INSERT INTO m_karyawan(npwp, nama_karyawan, alamat_asal, alamat_domisili, nomor_hp, jns_kelamin, 
                        tgl_lahir, agama, gaji_harian, gaji_pokok, status) 
                        VALUES ('".$npwp."', '".$nama."', '".$alamat_asl."', '".$alamat_dom."', '".$nomor_hp."', '".$jns_kelamin."', '".$tgl_lahir."', '".$agama."', '".$gaji_harian."', '".$gaji_pokok."', '".$status."')";
                $this->db->query($sql);
                
                $this->db->trans_complete();
                if($this->db->trans_status() === FALSE){
                    echo "Gagal Menambahkan";
                }else{
                    echo "Berhasil Menambahkan";
                }
                die();
                
            }else if($data == 'barang'){
                $kode = $this->input->post('kode');
                $nama = $this->input->post('nama');
                $stok = $this->input->post('stok');
                $satuan = $this->input->post('satuan');
                $status = $this->input->post('status');
				$suplier = $this->input->post('kd_suplier');
                $user_create = $this->newsession->userdata('username');
                //$file_name = $this->input->post('file_name');
                
                $this->db->trans_start();
                    
                $sql = "INSERT INTO m_barang(kd_brg, nama_barang, stock, satuan, date_create, user_create, status, kd_suplier) 
                        VALUES ('".$kode."', '".$nama."', '".$stok."', '".$satuan."', NOW(), '".$user_create."','".$status."', '".$suplier."')";
                $this->db->query($sql);
                
                $sql = "UPDATE m_setting SET count_brg = count_brg + 1";
                $this->db->query($sql);
                
                $this->db->trans_complete();
                if($this->db->trans_status() === FALSE){
                    echo "Gagal Menambahkan";
                }else{
                    echo "Berhasil Menambahkan";
                }
                die();
                
            }else if($data == 'suplier'){
                $kode = $this->input->post('kode');
                $nama = $this->input->post('nama');
                $status = $this->input->post('status');
                $user_create = $this->newsession->userdata('username');
                
				$query = "SELECT kd_suplier FROM m_suplier WHERE kd_suplier = '".$kode."'";				
				$count = $this->db->query($query)->num_rows();
				
				if($count != 0){
					echo "Data Sudah Pernah Diinput";
					die();
				}
				
                $this->db->trans_start();
                    
                $sql = "INSERT INTO m_suplier(kd_suplier, nama_suplier, date_create, user_create, status) 
                        VALUES ('".$kode."', '".$nama."', NOW(), '".$user_create."','".$status."')";
                $this->db->query($sql);
                
                $this->db->trans_complete();
                if($this->db->trans_status() === FALSE){
                    echo "Gagal Menambahkan";
                }else{
                    echo "Berhasil Menambahkan";
                }
                die();
                
            } else if($data == 'atk'){
                $cabang = $this->input->post('cabang');
                $nama = $this->input->post('nama');
				$jml = $this->input->post('stok');
				$satuan = $this->input->post('satuan');
				$alert = $this->input->post('alert');
                $status = $this->input->post('status');
                $user_create = $this->newsession->userdata('username');
                
                $this->db->trans_start();
                    
                $sql = "INSERT INTO t_atk(nama_barang, stock, satuan, date_create, user_create, status, date_alert, idcabang)
						VALUES('".$nama."', '".$jml."', '".$satuan."', NOW(), '".$user_create."', '".$status."', '".$alert."', '".$cabang."')";
                $this->db->query($sql);
                
                $this->db->trans_complete();
                if($this->db->trans_status() === FALSE){
                    echo "Gagal Menambahkan";
                }else{
                    echo "Berhasil Menambahkan";
                }
                die();
                
            }else if($data == 'users'){
				
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$cabang = $this->input->post('cabang');
				$nama_user = $this->input->post('nama_user');
				$email = $this->input->post('email');
				$role = $this->input->post('role');
                
                $this->db->trans_start();
                    
                $sql = "INSERT INTO m_user(username, password, nama, email, date_create, status, id_cabang) VALUES('".$username."', '".md5($password)."', '".$nama_user."', '".$email."', NOW(), '".$role."', '".$cabang."')";
                $this->db->query($sql);
                
                $this->db->trans_complete();
                if($this->db->trans_status() === FALSE){
                    echo "Gagal Menambahkan";
                }else{
                    echo "Berhasil Menambahkan";
                }
                die();
                
            }       
        }else if($act == 'update'){
            if($data == 'barang'){
                //print_r($_POST);
                $kode = $this->input->post('kode');
                $aksi = $this->input->post('aksi');
                $jml = $this->input->post('aksiKet');
                $status = $this->input->post('status');
                $stokA = $this->input->post('stokA');
                $user_create = $this->newsession->userdata('username');
                
                
                $this->db->trans_start();
                    
                $sql = "INSERT INTO t_barang(kd_brg, stock, action, date_create, user_create) 
                        VALUES ('".$kode."', '".$jml."', '".$aksi."', NOW(), '".$user_create."')";
                $this->db->query($sql);
                
                $sql = "UPDATE m_barang SET stock = '".$stokA."', status = '".$status."', date_update = NOW() WHERE kd_brg = '".$kode."'";
                $this->db->query($sql);
                
                $this->db->trans_complete();
                if($this->db->trans_status() === FALSE){
                    echo "Gagal Merubah";
                }else{
                    echo "Berhasil Merubah";
                }
                die();
            }else if($data == 'atk'){
				$id = $this->input->post('id');
                $cabang = $this->input->post('cabang');
                $nama = $this->input->post('nama');
				$jml = $this->input->post('stok');
				$satuan = $this->input->post('satuan');
				$alert = $this->input->post('alert');
                $status = $this->input->post('status');
                $user_create = $this->newsession->userdata('username');
                
                
                $this->db->trans_start();
                    
                $sql = "UPDATE t_atk SET nama_barang = '".$nama."', stock = '".$jml."', satuan = '".$satuan."', date_alert = '".$alert."', status = '".$status."' WHERE kdatk = '".$id."'";
                $this->db->query($sql);
                
                $this->db->trans_complete();
                if($this->db->trans_status() === FALSE){
                    echo "Gagal Merubah";
                }else{
                    echo "Berhasil Merubah";
                }
                die();
            } if($data == 'suplier'){
				$kode = $this->input->post('kode');
				$nama = $this->input->post('nama');
                $status = $this->input->post('status');
                
                $this->db->trans_start();
                    
                $sql = "UPDATE m_suplier SET nama_suplier = '".$nama."', status = '".$status."' WHERE kd_suplier  = '".$kode."'";
                $this->db->query($sql);
                
                $this->db->trans_complete();
                if($this->db->trans_status() === FALSE){
                    echo "Gagal Merubah";
                }else{
                    echo "Berhasil Merubah";
                }
                die();
			}else if($data == 'users'){
			
				$id = $this->input->post('id');			
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$cabang = $this->input->post('cabang');
				$nama_user = $this->input->post('nama_user');
				$email = $this->input->post('email');
				$role = $this->input->post('role');
				
				$this->db->trans_start();
				
				if($password == ''){
					$sql = "UPDATE m_user SET username = '".$username."', nama = '".$nama_user."',  
							email = '".$email."', status = '".$role."', id_cabang = '".$cabang."' 
							WHERE id = '".$id."'";
				}else{
					$sql = "UPDATE m_user SET username = '".$username."', nama = '".$nama_user."',  password = '".md5($password)."', 
							email = '".$email."', status = '".$role."', id_cabang = '".$cabang."' 
							WHERE id = '".$id."'";
				}
				$this->db->query($sql);
				
				$this->db->trans_complete();
                if($this->db->trans_status() === FALSE){
                    echo "Gagal Merubah";
                }else{
                    echo "Berhasil Merubah";
                }
                die();
			}
            
        }else if($act == 'delete'){
            
            
        }
    }
    
    function delete($data, $id){

        if($data == 'provinsi'){
            $sql = "DELETE FROM m_provinsi WHERE kdprovinsi = '".$id."'";   
        }else if($data == 'kota'){
            $sql = "DELETE FROM m_kota WHERE kdkota = '".$id."'";   
        }else if($data == 'lokasi'){
            $sql = "DELETE FROM m_lokasi WHERE kdlokasi = '".$id."'";   
        }else if($data == 'cabang'){
            $sql = "DELETE FROM m_cabang WHERE kdcabang = '".$id."'";   
        }else if($data == 'client'){
            $sql = "DELETE FROM m_client WHERE id = '".$id."'";   
        }else if($data == 'karyawan'){
            $sql = "DELETE FROM m_karyawan WHERE id = '".$id."'";   
        }else if($data == 'barang'){
            $sql = "DELETE FROM m_barang WHERE kd_brg = '".$id."'";
        }else if($data == 'kdatk'){
            $sql = "DELETE FROM t_atk WHERE kdatk = '".$id."'";
			$data = 'atk';
        }else if($data == 'users'){
            $sql = "DELETE FROM m_user WHERE id = '".$id."'";
        }
        
        $this->db->trans_start();                    
            $this->db->query($sql);    
        $this->db->trans_complete();
        
            if($this->db->trans_status() === FALSE){
                $msg = "Gagal Menambahkan";
            }else{
                $msg =  "Berhasil Menghapus ".$data;
            }
            print "<script>";
            echo "alert('".$msg."');";
            echo "location.href='".site_url('mockups#master/ListData/'.$data)."';";
            print "</script>";
            die();
    }
    
    function edit($data, $id){
        
        if($data == 'barang'){
            $sql = "SELECT kd_brg, nama_barang, stock, satuan, date_create, status FROM m_barang WHERE kd_brg = '".$id."'";
            $arr['barang'] = $this->db->query($sql)->row();
            $arr['title']= 'Barang';
            echo $this->content == '' ? $content = $this->load->view($this->path.'/form_barang_edit', $arr, TRUE) : $content = $this->content;
        }else if($data == 'kdatk'){
			$query = "SELECT kdcabang, nama_cabang FROM m_cabang";
			$arr['cabang'] = $this->actmain->get_combobox($query, 'kdcabang', 'nama_cabang', true);
			
			
            $sql = "SELECT *, DATE_FORMAT(date_alert, '%Y-%m-%d') 'alert' FROM t_atk WHERE kdatk = '".$id."'";
            $arr['barang'] = $this->db->query($sql)->row();
            $arr['title']= 'Inventaris';
            echo $this->content == '' ? $content = $this->load->view($this->path.'/form_kdatk_edit', $arr, TRUE) : $content = $this->content;
			
        }else if($data == 'suplier'){
            $sql = "SELECT kd_suplier, nama_suplier, status FROM m_suplier WHERE kd_suplier = '".$id."'";
            $arr['suplier'] = $this->db->query($sql)->row();
            $arr['title']= 'Suplier';
            echo $this->content == '' ? $content = $this->load->view($this->path.'/form_suplier_edit', $arr, TRUE) : $content = $this->content;
			
        }else if($data == 'provinsi'){
            $sql = "SELECT * FROM m_provinsi WHERE kdprovinsi = '".$id."'";
            $arr['title'] = 'Provinsi';
            $arr['data'] = $this->db->query($sql)->row();
            echo $this->content == '' ? $content = $this->load->view($this->path.'/form_provinsi_edit', $arr, TRUE) : $content = $this->content;
			
        }else if($data == 'kota'){
            $query = "SELECT kdprovinsi, nama_provinsi FROM m_provinsi";
            $arr['result'] = $this->actmain->get_combobox($query, 'kdprovinsi', 'nama_provinsi', true);
            
            $sql = "SELECT * FROM m_kota WHERE kdkota = '".$id."'";
            $arr['title'] = 'Kota';
            $arr['data'] = $this->db->query($sql)->row();
            echo $this->content == '' ? $content = $this->load->view($this->path.'/form_kota_edit', $arr, TRUE) : $content = $this->content;
			
        }else if($data == 'cabang'){
            $query = "SELECT kdprovinsi, nama_provinsi FROM m_provinsi";
            $arr['result'] = $this->actmain->get_combobox($query, 'kdprovinsi', 'nama_provinsi', true);
            
            $sql = "SELECT A.*, B.kdkota, B.kdprovinsi FROM m_cabang A
                    LEFT JOIN m_kota B ON B.kdkota = A.kdkota 
                    WHERE A.kdcabang = '".$id."'";
            $arr['data'] = $this->db->query($sql)->row();
            
            $arr['title'] = 'Cabang';
            echo $this->content == '' ? $content = $this->load->view($this->path.'/form_cabang_edit', $arr, TRUE) : $content = $this->content;
			
        }else if($data == 'lokasi'){
            $query = "SELECT kdprovinsi, nama_provinsi FROM m_provinsi";
            $arr['result'] = $this->actmain->get_combobox($query, 'kdprovinsi', 'nama_provinsi', true);
            
            $sql = "SELECT A.*, B.kdkota, B.kdprovinsi FROM m_lokasi A
                    LEFT JOIN m_kota B ON B.kdkota = A.kdkota 
                    WHERE kdlokasi = '".$id."'";
                    
            $arr['title'] = 'Lokasi';
            $arr['data'] = $this->db->query($sql)->row();
            
            #FILE
            $SQl = "SELECT fileupload FROM m_lokasi_ijin_file WHERE idijin= '".$id."'";
            $arr['upload'] = $this->db->query($SQl)->row();
            
            echo $this->content == '' ? $content = $this->load->view($this->path.'/form_lokasi_edit', $arr, TRUE) : $content = $this->content;
        }else if($data == 'users'){
			$query = "SELECT kdcabang, nama_cabang FROM m_cabang";
			$arr['cabang'] = $this->actmain->get_combobox($query, 'kdcabang', 'nama_cabang', true);
			
			$query = "SELECT kode, status FROM t_role";
			$arr['role'] = $this->actmain->get_combobox($query, 'kode', 'status', true);
			
			$sql = "SELECT id, A.username, A.nama, A.id_cabang, A.email, A.status 
					FROM m_user A LEFT JOIN m_cabang B ON B.kdcabang = A.id_cabang
					LEFT JOIN t_role C ON C.kode = A.status 
					WHERE id = '".$id."'";
					
            $arr['title'] = 'User';
			$arr['data'] = $this->db->query($sql)->row();
			
			echo $this->content == '' ? $content = $this->load->view($this->path.'/form_users_edit', $arr, TRUE) : $content = $this->content;
        }
        
    }
    
    function update($data){
        //$data = $this->input->post('type');
        $id = $this->input->post('id');
        
        if($data == 'provinsi'){
            $nama = $this->input->post('nama');
            $sql = "UPDATE m_provinsi SET nama_provinsi = '".$nama."' WHERE kdprovinsi = '".$id."'";
            
        }else if($data == 'kota'){
            $kdprov = $this->input->post('kdprov');
            $nama = $this->input->post('namakota');
            $sql = "UPDATE m_kota SET kdprovinsi='".$kdprov."', nama_kota = '".$nama."' WHERE kdkota = '".$id."'";
            
            
        }else if($data == 'cabang'){
            $kdkota = $this->input->post('kdkota');
            $namacabang  = $this->input->post('nama_cabang');
            $alamatcabang = $this->input->post('alamat_cabang');
            $sql = "UPDATE m_cabang SET nama_cabang = '".$namacabang."', alamat_cabang = '".$alamatcabang."', kdkota = '".$kdkota."' WHERE kdcabang = '".$id."'";
             
        }else if($data == 'lokasi'){
            $nmlokasi = $this->input->post('nama_lokasi');
            $kdkota = $this->input->post('kdkota');
            $almtlokasi = $this->input->post('alamat_lokasi');
            $arahpandang = $this->input->post('arah_pandang');
            $status = $this->input->post('status');
            
            $sql = "UPDATE m_lokasi SET kdkota = '".$kdkota."', nama_lokasi = '".$nmlokasi."', alamat_lokasi = '".$almtlokasi."', 
                    arah_pandang = '".$arahpandang."', kdstatus = '".$status."', date_update = NOW() WHERE kdlokasi = '".$id."'"; 
					
        }
        
        $this->db->trans_start();
        $this->db->query($sql);
        $this->db->trans_complete();
        
        if($this->db->trans_status() === FALSE){
            echo "Gagal Menambahkan";
        }else{
            echo "Berhasil Menambahkan";
        }
        die();        
    }
    
    function upload($type){
        $config['upload_path']          = './upload/'.$type.'/';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['max_size']             = 100000;
        $config['overwrite']             = TRUE;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;
        
		$this->load->library('upload', $config);
 
		if ( ! $this->upload->do_upload('filename')){
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
		}else{
			$data = array('upload_data' => $this->upload->data());
			echo "sukses#".$_FILES["filename"]['name']."#Berhasil Upload Media";
		}
        die();
    }

    function uploadFile($id){
        $config['upload_path']          = './template/upload/'.$id;
        $config['allowed_types']        = '*';
        $config['max_size']             = 100000;
        $config['overwrite']             = TRUE;
        $new_name = rand(0,9)."_".$_FILES["files"]['name'];
        $config['file_name'] = $new_name;

        $this->load->library('upload', $config);

        if($id == 'provinsi'){

            $dats = $this->db->query("SELECT kdprovinsi FROM m_provinsi");
            $prov = array();
            foreach($dats->result_array() as $datt){
                array_push($prov, $datt['kdprovinsi']);
            }


            if ( ! $this->upload->do_upload('files')){
                $error = array('error' => $this->upload->display_errors());
                print_r($error);
            }else{
                $data = array('upload_data' => $this->upload->data());

                $inputFileName = $data['upload_data']['file_path'].$new_name;

                //  Read your Excel workbook
                try {
                    $this->load->library('Excel');
                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($inputFileName);

                    $sheet = $objPHPExcel->getSheet(0);
                    $highestRow = $sheet->getHighestRow();
                    $highestColumn = $sheet->getHighestColumn();

                    $rowData[] = array();
                    $i = 0;
                    $j = 0;
                    for ($row = 5; $row <= $highestRow; $row++){
                        //  Read a row of data into an array
                        $rowData['data'] = $sheet->rangeToArray('B' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
                        if(in_array($rowData['data'][0][0], $prov) == FALSE){
                            //INSERT DATABASE
                            $SQL = "INSERT INTO m_provinsi(kdprovinsi, nama_provinsi) VALUES('".$rowData["data"][0][0]."', '".$rowData["data"][0][1]."')";
                            $this->db->query($SQL);
                            $i++;
                        }else{
                            $j++;
                        }

                    }
                }

                catch(Exception $e) {
                    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
                }
            }
        }else if($id == 'kota') {

            $kdprov = $this->input->post('kdprov');
            $dats = $this->db->query("SELECT kdkota FROM m_kota ");
            $kota = array();
            foreach ($dats->result_array() as $datt) {
                array_push($kota, $datt['kdkota']);
            }


            if (!$this->upload->do_upload('files')) {
                $error = array('error' => $this->upload->display_errors());
                print_r($error);
            } else {
                $data = array('upload_data' => $this->upload->data());

                $inputFileName = $data['upload_data']['file_path'] . $new_name;

                //  Read your Excel workbook
                try {
                    $this->load->library('Excel');
                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($inputFileName);

                    $sheet = $objPHPExcel->getSheet(0);
                    $highestRow = $sheet->getHighestRow();
                    $highestColumn = $sheet->getHighestColumn();

                    $rowData[] = array();
                    $i = 0;
                    $j = 0;
                    for ($row = 5; $row <= $highestRow; $row++) {
                        //  Read a row of data into an array
                        $rowData['data'] = $sheet->rangeToArray('B' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
                        if (in_array($rowData['data'][0][0], $kota) == FALSE) {
                            //INSERT DATABASE
                            $SQL = "INSERT INTO m_kota(kdkota, kdprovinsi, nama_kota) VALUES('" . $rowData["data"][0][0] . "', '$kdprov', '" . $rowData["data"][0][1] . "')";
                            $this->db->query($SQL);
                            $i++;
                        } else {
                            $j++;
                        }

                    }
                } catch (Exception $e) {
                    die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
                }
            }
        }else if($id == 'cabang'){
            $kdkota = $this->input->post('kdkota');
            $dats = $this->db->query("SELECT kdcabang FROM m_cabang ");
            $cabang = array();
            foreach ($dats->result_array() as $datt) {
                array_push($cabang, $datt['kdcabang']);
            }

            if (!$this->upload->do_upload('files')) {
                $error = array('error' => $this->upload->display_errors());
                print_r($error);
            } else {
                $data = array('upload_data' => $this->upload->data());

                $inputFileName = $data['upload_data']['file_path'] . $new_name;

                //  Read your Excel workbook
                try {
                    $this->load->library('Excel');
                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($inputFileName);

                    $sheet = $objPHPExcel->getSheet(0);
                    $highestRow = $sheet->getHighestRow();
                    $highestColumn = $sheet->getHighestColumn();

                    $rowData[] = array();
                    $i = 0;
                    $j = 0;
                    for ($row = 5; $row <= $highestRow; $row++) {
                        //  Read a row of data into an array
                        $rowData['data'] = $sheet->rangeToArray('B' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
                        if (in_array($rowData['data'][0][0], $cabang) == FALSE) {
                            //INSERT DATABASE
                            $SQL = "INSERT INTO m_cabang(kdcabang, nama_cabang, alamat_cabang, kdkota, status) VALUES('" . $rowData["data"][0][0] . "', '" . $rowData["data"][0][1] . "', '".$rowData["data"][0][2]."', '".$kdkota."',1)";
                            $this->db->query($SQL);
                            $i++;
                        } else {
                            $j++;
                        }

                    }
                } catch (Exception $e) {
                    die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
                }
            }

        }else if($id == 'client'){
            $kdkota = $this->input->post('kdkota');
            $dats = $this->db->query("SELECT npwp FROM m_client ");
            $client = array();
            foreach ($dats->result_array() as $datt) {
                array_push($client, $datt['npwp']);
            }

            if (!$this->upload->do_upload('files')) {
                $error = array('error' => $this->upload->display_errors());
                print_r($error);
            } else {
                $data = array('upload_data' => $this->upload->data());

                $inputFileName = $data['upload_data']['file_path'] . $new_name;

                //  Read your Excel workbook
                try {
                    $this->load->library('Excel');
                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($inputFileName);

                    $sheet = $objPHPExcel->getSheet(0);
                    $highestRow = $sheet->getHighestRow();
                    $highestColumn = $sheet->getHighestColumn();

                    $rowData[] = array();
                    $i = 0;
                    $j = 0;
                    for ($row = 5; $row <= $highestRow; $row++) {
                        //  Read a row of data into an array
                        $rowData['data'] = $sheet->rangeToArray('B' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
                        if (in_array($rowData['data'][0][0], $client) == FALSE) {
                            //INSERT DATABASE
                            $SQL = "INSERT INTO m_client(nama, kdkota, alamat, npwp, date_create,  status) VALUES('".$rowData['data'][0][1]."', '$kdkota', '".$rowData['data'][0][2]."', '".$rowData['data'][0][0]."', NOW(), 1)";
                            $this->db->query($SQL);
                            $i++;
                        } else {
                            $j++;
                        }

                    }
                } catch (Exception $e) {
                    die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
                }
            }

        }else if($id == 'lokasi'){
            $kdkota = $this->input->post('kdkota');
            $dats = $this->db->query("SELECT kdlokasi FROM m_lokasi ");
            $kota = array();
            foreach ($dats->result_array() as $datt) {
                array_push($kota, $datt['kdlokasi']);
            }


            if (!$this->upload->do_upload('files')) {
                $error = array('error' => $this->upload->display_errors());
                print_r($error);
            } else {
                $data = array('upload_data' => $this->upload->data());

                $inputFileName = $data['upload_data']['file_path'] . $new_name;

                //  Read your Excel workbook
                try {
                    $this->load->library('Excel');
                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($inputFileName);

                    $sheet = $objPHPExcel->getSheet(0);
                    $highestRow = $sheet->getHighestRow();
                    $highestColumn = $sheet->getHighestColumn();

                    $rowData[] = array();
                    $i = 0;
                    $j = 0;
                    for ($row = 5; $row <= $highestRow; $row++) {
                        //  Read a row of data into an array
                        $rowData['data'] = $sheet->rangeToArray('B' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
                        if (in_array($rowData['data'][0][0], $kota) == FALSE) {
                            //INSERT DATABASE
                            $SQL = "INSERT INTO m_lokasi(kdlokasi, kdkota, nama_lokasi, alamat_lokasi, arah_pandang, kdstatus, date_create) 
                                    VALUES('".$rowData['data'][0][0]."', '$kdkota', '".$rowData['data'][0][1]."', '".$rowData['data'][0][2]."', '".$rowData['data'][0][3]."', '1', NOW())";

                            $this->db->query($SQL);
                            $i++;
                        } else {
                            $j++;
                        }

                    }
                } catch (Exception $e) {
                    die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
                }
            }
        }else if($id == 'barang'){

        }

        echo "<script>alert('Data Yang di Upload ($i), data yang sudah ada di system ($j)');location.href='".site_url('mockups#master/ListData/'.$id)."';</script>";
        die();
    }

    function data(){
        $id = $this->input->post('id');
        $query = 'SELECT kdkota, nama_kota FROM m_kota WHERE kdprovinsi = "'.$id.'"';
        $result = $this->actmain->get_combobox($query, 'kdkota', 'nama_kota', true);
        echo form_dropdown("kdkota", $result, '', ' class="form-control"');
    }
    
    function dataEdit(){
        $id = $this->input->post('id');
        $kd = $this->input->post('kd');
        $query = 'SELECT kdkota, nama_kota FROM m_kota WHERE kdprovinsi = "'.$id.'"';
        $result = $this->actmain->get_combobox($query, 'kdkota', 'nama_kota', true);
        echo form_dropdown("kdkota", $result, $kd, ' class="form-control"');
    }
    
    function detilClient($id){
        $query = "SELECT A.nama AS 'NAMA', C.nama_provinsi 'PROVINSI', B.nama_kota 'KOTA', A.alamat 'ALAMAT', A.npwp 'NPWP', 
                  CASE A.STATUS WHEN '1' THEN 'Active' ELSE 'Non-Active' END 'STATUS' 
                  FROM m_client A
                  LEFT JOIN m_kota B ON B.kdkota = A.kdkota
                  LEFT JOIN m_provinsi C ON C.kdprovinsi = B.kdprovinsi 
                  WHERE a.id = ".$id;
        $data = $this->db->query($query)->row();
        print "<table>";
        
        print "<tr>";
        print "<td>Nama</td>";
        print "<td>:</td>";
        print "<td><b>".$data->NAMA."</b></td>";
        print "</tr>";
        
        print "<tr>";
        print "<td>NPWP</td>";
        print "<td>:</td>";
        print "<td><b>".$data->NPWP."</b></td>";
        print "</tr>";
        
        print "<tr>";
        print "<td>Alamat</td>";
        print "<td>:</td>";
        print "<td><b>[".$data->PROVINSI." - ".$data->KOTA."] ".$data->ALAMAT."</td>";
        print "</tr>";
        
        print "<tr>";
        print "<td>Status</td>";
        print "<td>:</td>";
        print "<td><b>".$data->STATUS."</b></td>";
        print "</tr>";
        
        print "</table>";
        
        echo $table;
    }
	
	function detilBarang($kdbrg){
		$query = "SELECT A.id_trx_brg, A.action 'AKSI', CONCAT(A.stock, ' ', B.satuan) 'STOK', A.date_create 'TANGGAL' , A.user_create 'user'
				  FROM t_barang A
				  LEFT JOIN m_barang B ON B.kd_brg = A.kd_brg
				  WHERE B.kd_brg = '".$kdbrg."'
				  ";
        $table = $this->newtable;
        $type = 'dataDokumen';
        
        #SETTING DETAIL, ORDERBY, SORTBY, TIPE CHECK(radio, checkbox), HIDDEN FIELD, TYPE PROCESS
        $table->clear();
        $table->orderby('id_trx_brg');
        $table->sortby('DESC');
        $table->keys(array('id_trx_brg'));
        $table->hiddens(array('id_trx_brg'));
        $table->tipe_proses('button');
        
		#SEARCHING TABLE
		$table->show_search(FALSE);
        $table->show_chk(FALSE);
        $table->show_paging(FALSE);
        
        #SETTING URL DAN BANYAK ROW
        $table->cidb($this->db);
        $table->ciuri($this->input->post("uri"));
        $table->menu(false);
        #SETTING PROCESS ID
        $table->set_formid('f' . $type);
        $table->set_divid('div' . $type);
		$table = $table->generate($query);
		echo "<h4>Log 10 Transaksi Terakhir </h4>";
		echo $table;
		echo "<br/>";
	}
    
    function detilLokasi($id){

        $sql = "SELECT fileupload FROM m_lokasi_ijin_file WHERE idijin = '".$id."'";
        $data = $this->db->query($sql)->row();
        
        print "<table>";
        print "<tr>";
        print "<td>";
        //echo "Jawa Barat, Kota <br/> AlamatAlamatAlamatAlamatAlamatAlamatAlamat";
        print "</td>";
        print "<td rowspan='5'>";
        
        if($data->fileupload != ''){
            echo "<b>Preview Lokasi :</b> <br/><a href='".$data->fileupload."' target='_blank'><img src='".$data->fileupload."' width='500' /></a>";
        }else{
            echo "<b>Belum Ada Photo</b>";
        }
        
        print "</td>";    
        print "</tr>";
        /*
        print "<tr>";
        print "<td>";
        echo "ASd";
        print "</td>";
        print "</tr>";
        */
        print "</table>";
           
    }
    
    function karyawanDetil($id){
        $sql = "SELECT npwp, nama_karyawan, alamat_asal, alamat_domisili, nomor_hp, jns_kelamin, tgl_lahir, agama, gaji_harian, CASE status WHEN 1 THEN 'Aktif' ELSE 'Tidak Aktif' END status FROM m_karyawan WHERE id = ".$id;
        $data = $this->db->query($sql)->row();
        
        print "<table>";
        
        print "<tr>";
        
        print "<td>";
        echo "NPWP";
        print "</td>";
        print "<td>";
        echo ":";
        print "</td>";
        print "<td style='width:400px;'>";
        echo $data->npwp;
        print "</td>";
        
        print "<td>";
        echo "";
        print "</td>";
        print "<td>";
        echo "";
        print "</td>";
        print "<td>";
        
        print "</td>";
            
        print "</tr>";
        
        print "<tr>";
        
        print "<td>";
        echo "Nama";
        print "</td>";
        print "<td>";
        echo ":";
        print "</td>";
        print "<td>";
        echo $data->nama_karyawan;
        print "</td>";    
        
        print "<td>";
        echo "Jenis Kelamin";
        print "</td>";
        print "<td>";
        echo ":";
        print "</td>";
        print "<td>";
        echo $data->jns_kelamin;
        print "</td>";
        
        print "</tr>";
        
        print "<tr>";
        
        print "<td>";
        echo "Alamat Asal";
        print "</td>";
        print "<td>";
        echo ":";
        print "</td>";
        print "<td>";
        echo $data->alamat_asal;
        print "</td>";    
        
        print "<td>";
        echo "Tanggal Lahir";
        print "</td>";
        print "<td>";
        echo ":";
        print "</td>";
        print "<td>";
        echo $data->tgl_lahir;
        print "</td>";
        
        print "</tr>";
        
        print "<tr>";
        
        print "<td>";
        echo "Alamat Domisili";
        print "</td>";
        print "<td>";
        echo ":";
        print "</td>";
        print "<td>";
        echo $data->alamat_domisili;
        print "</td>";    
        
        print "<td>";
        echo "Agama";
        print "</td>";
        print "<td>";
        echo ":";
        print "</td>";
        print "<td>";
        echo $data->agama;
        print "</td>";
        
        print "</tr>";
        
        print "<tr>";
        
        print "<td>";
        echo "Gaji Harian";
        print "</td>";
        print "<td>";
        echo ":";
        print "</td>";
        print "<td>";
        echo $data->gaji_harian;
        print "</td>";
        
        print "<td>";
        echo "Status";
        print "</td>";
        print "<td>";
        echo ":";
        print "</td>";
        print "<td>";
        echo $data->status;
        print "</td>";
            
        print "</tr>";
        
        print "</table>";
        
    }
    
    function excel_karyawan(){
            $this->load->library("Excel");
 
            //membuat objek PHPExcel
            $objPHPExcel = new PHPExcel();
 
            //set Sheet yang akan diolah 
            $objPHPExcel->setActiveSheetIndex(0)
                    //mengisikan value pada tiap-tiap cell, A1 itu alamat cellnya 
                    //Hello merupakan isinya
                                        ->setCellValue('A1', 'Hello')
                                        ->setCellValue('B1', 'Ini')
                                        ->setCellValue('C1', 'Excel')
                                        ->setCellValue('D1', 'Pertamaku');
            
            
            $sql = "";
            $datas = $this->db->query($sql)->result_array();
            
            $i = 2; //dimulai isi
            foreach($datas as $data){
                $objPHPExcel->setActiveSheetIndex(0)
                    //mengisikan value pada tiap-tiap cell, A1 itu alamat cellnya 
                    //Hello merupakan isinya
                                        ->setCellValue('A'.$i, $data['asd'])
                                        ->setCellValue('B'.$i, 'Ini')
                                        ->setCellValue('C'.$i, 'Excel')
                                        ->setCellValue('D'.$i, 'Pertamaku');
                                        $i++;
            }          
                              
            //set title pada sheet (me rename nama sheet)
            $objPHPExcel->getActiveSheet()->setTitle('Excel Pertama');
 
            //mulai menyimpan excel format xlsx, kalau ingin xls ganti Excel2007 menjadi Excel5          
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $filename = 'hasi';
            //sesuaikan headernya 
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: no-store, no-cache, must-revalidate");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            //ubah nama file saat diunduh
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            //unduh file
            $objWriter->save("php://output");
 
    }
}