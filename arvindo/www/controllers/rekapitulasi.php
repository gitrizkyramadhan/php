<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }
class rekapitulasi extends CI_Controller {
    
    var $content = '';
    var $arr = array();
    var $path = 'rekapitulasi'; //pathview dan model
    
    function __construct(){
        parent::__construct();
        //$this->load->model('m_absensi', 'mv');    
    }
    
    function index() {
        if ($this->newsession->userdata('logged_in')) {
            
            $arr['table'] = $this->mv->table2();
            $this->content == '' ? $content = $this->load->view('absensi/view', $arr, TRUE) : $content = $this->content;    
            
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
    
    function excel_penawaran() {
        
        $tglawal = $this->input->post('awal');
        $tglakhir = $this->input->post('akhir');
        
        $this->load->library("Excel");

        //membuat objek PHPExcel
        $objPHPExcel = new PHPExcel();

        //set Sheet yang akan diolah 
        $objPHPExcel->setActiveSheetIndex(0)
                //mengisikan value pada tiap-tiap cell, A1 itu alamat cellnya 
                //Hello merupakan isinya
                ->setCellValue('A1', 'Kode Penawaran')
                ->setCellValue('B1', 'Produk')
                ->setCellValue('C1', 'Ukuran')
                ->setCellValue('D1', 'Periode')
                ->setCellValue('E1', 'Satuan Periode')
                ->setCellValue('F1', 'PPH')
                ->setCellValue('G1', 'Total Harga')
                ->setCellValue('H1', 'Nama Kota')
                ->setCellValue('I1', 'Nama Provinsi')
                ->setCellValue('J1', 'Nama Lokasi')
                ->setCellValue('K1', 'Alamat Lokasi')
                ->setCellValue('L1', 'Arah Pandang')
                ->setCellValue('M1', 'Date Create');

//where date_format(a.date_create,'%Y-%m-%d') between $tglawal and $tglakhir and a.kdstatus = $status
        $sql = "select a.idpenawaran,a.produk,a.ukuran,a.periode,a.satuan_period,a.pph,a.total_harga,
                c.nama_kota,d.nama_provinsi,b.nama_lokasi,b.alamat_lokasi,b.arah_pandang,a.date_create 
                from t_penawaran_hdr a join m_lokasi b on a.kdlokasi = b.kdlokasi join m_kota c on b.kdkota = c.kdkota
                join m_provinsi d on c.kdprovinsi = d.kdprovinsi
                where date_format(a.date_create,'%Y-%m-%d') between '".$tglawal."' and '".$tglakhir."' 
                order by a.date_create desc";
        $datas = $this->db->query($sql)->result_array();

        $i = 2; //dimulai isi
        foreach ($datas as $data) {
            $objPHPExcel->setActiveSheetIndex(0)
                    //mengisikan value pada tiap-tiap cell, A1 itu alamat cellnya 
                    //Hello merupakan isinya
                    ->setCellValue('A' . $i, $data['idpenawaran'])
                    ->setCellValue('B' . $i, $data['produk'])
                    ->setCellValue('C' . $i, $data['ukuran'])
                    ->setCellValue('D' . $i, $data['periode'])
                    ->setCellValue('E' . $i, $data['satuan_period'])
                    ->setCellValue('F' . $i, $data['pph'])
                    ->setCellValue('G' . $i, $data['total_harga'])
                    ->setCellValue('H' . $i, $data['nama_kota'])
                    ->setCellValue('I' . $i, $data['nama_provinsi'])
                    ->setCellValue('J' . $i, $data['nama_lokasi'])
                    ->setCellValue('K' . $i, $data['alamat_lokasi'])
                    ->setCellValue('L' . $i, $data['arah_pandang'])
                    ->setCellValue('M' . $i, $data['date_create'])
            ;
            $i++;
        }

        //set title pada sheet (me rename nama sheet)
        $objPHPExcel->getActiveSheet()->setTitle('Excel Pertama');

        //mulai menyimpan excel format xlsx, kalau ingin xls ganti Excel2007 menjadi Excel5          
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $filename = 'Rekapitulasi Penawaran.xlsx';
        //sesuaikan headernya 
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        //ubah nama file saat diunduh
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        //unduh file
        $objWriter->save("php://output");
    }

    function excel_po() {
        
        $tglawal = $this->input->post('awal');
        $tglakhir = $this->input->post('akhir');
        
        $this->load->library("Excel");
        
        //membuat objek PHPExcel
        $objPHPExcel = new PHPExcel();

        //set Sheet yang akan diolah 
        $objPHPExcel->setActiveSheetIndex(0)
                //mengisikan value pada tiap-tiap cell, A1 itu alamat cellnya 
                //Hello merupakan isinya
                ->setCellValue('A1', 'Kode PO')
                ->setCellValue('B1', 'Produk')
                ->setCellValue('C1', 'Ukuran')
                ->setCellValue('D1', 'Nama Lokasi')
                ->setCellValue('E1', 'Alamat Lokasi')
                ->setCellValue('F1', 'Nama TTD')
                ->setCellValue('G1', 'Jabatan TTD')
                ->setCellValue('H1', 'Keterangan')
                ->setCellValue('I1', 'Biaya Akhir')
                ->setCellValue('J1', 'PPH')
                ->setCellValue('K1', 'Total Harga')
                ->setCellValue('L1', 'Date Create')
        ;

//where date_format(a.date_create,'%Y-%m-%d') between $tglawal and $tglakhir and a.kdstatus = $status
        $sql = "select a.idpo,b.produk,b.ukuran,c.nama_lokasi,c.alamat_lokasi,a.nama_ttd,a.jabatan_ttd,a.keterangan,a.biaya_akhir,
                a.pph,a.total_harga,a.date_create 
                from t_po a join t_penawaran_hdr b on a.idpenawaran = b.idpenawaran
                join m_lokasi c on b.kdlokasi = c.kdlokasi
                where date_format(a.date_create,'%Y-%m-%d') between '".$tglawal."' and '".$tglakhir."' 
                order by a.date_create desc";
        $datas = $this->db->query($sql)->result_array();

        $i = 2; //dimulai isi
        foreach ($datas as $data) {
            $objPHPExcel->setActiveSheetIndex(0)
                    //mengisikan value pada tiap-tiap cell, A1 itu alamat cellnya 
                    //Hello merupakan isinya
                    ->setCellValue('A' . $i, $data['idpo'])
                    ->setCellValue('B' . $i, $data['produk'])
                    ->setCellValue('C' . $i, $data['ukuran'])
                    ->setCellValue('D' . $i, $data['nama_lokasi'])
                    ->setCellValue('E' . $i, $data['alamat_lokasi'])
                    ->setCellValue('F' . $i, $data['nama_ttd'])
                    ->setCellValue('G' . $i, $data['jabatan_ttd'])
                    ->setCellValue('H' . $i, $data['keterangan'])
                    ->setCellValue('I' . $i, $data['biaya_akhir'])
                    ->setCellValue('J' . $i, $data['pph'])
                    ->setCellValue('K' . $i, $data['total_harga'])
                    ->setCellValue('L' . $i, $data['date_create'])
            ;
            $i++;
        }

        //set title pada sheet (me rename nama sheet)
        $objPHPExcel->getActiveSheet()->setTitle('Excel Pertama');

        //mulai menyimpan excel format xlsx, kalau ingin xls ganti Excel2007 menjadi Excel5          
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $filename = 'Rekapitulasi PO_'.$tglawal.'_'.$tglakhir.'.xlsx';
        //sesuaikan headernya 
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        //ubah nama file saat diunduh
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        //unduh file
        $objWriter->save("php://output");
    }

    function excel_produksi() {
        $this->load->library("Excel");
        
        $tglawal = $this->input->post('awal');
        $tglakhir = $this->input->post('akhir');
        
        //membuat objek PHPExcel
        $objPHPExcel = new PHPExcel();

        //set Sheet yang akan diolah 
        $objPHPExcel->setActiveSheetIndex(0)
                //mengisikan value pada tiap-tiap cell, A1 itu alamat cellnya 
                //Hello merupakan isinya
                ->setCellValue('A1', 'Kode Produksi')
                ->setCellValue('B1', 'Nama TTD')
                ->setCellValue('C1', 'Jabatan TTD')
                ->setCellValue('D1', 'Total Harga')
                ->setCellValue('E1', 'Awal Produksi')
                ->setCellValue('F1', 'Akhir Produksi')
                ->setCellValue('G1', 'Perkiraan Budget')
                ->setCellValue('H1', 'Angsuran')
        ;

//where date_format(a.date_create,'%Y-%m-%d') between $tglawal and $tglakhir and a.`status` = $status
        $sql = "select a.idproduksi,b.nama_ttd,b.jabatan_ttd,b.total_harga,a.lama_produksi,a.akhir_produksi,a.perkiraan_budget,
                a.angsuran
                from t_produksi a join t_po b on a.idpo = b.idpo
                where date_format(a.date_create,'%Y-%m-%d') between '".$tglawal."' and '".$tglakhir."'  
                order by a.date_create desc";
        $datas = $this->db->query($sql)->result_array();

        $i = 2; //dimulai isi
        foreach ($datas as $data) {
            $objPHPExcel->setActiveSheetIndex(0)
                    //mengisikan value pada tiap-tiap cell, A1 itu alamat cellnya 
                    //Hello merupakan isinya
                    ->setCellValue('A' . $i, $data['idproduksi'])
                    ->setCellValue('B' . $i, $data['nama_ttd'])
                    ->setCellValue('C' . $i, $data['jabatan_ttd'])
                    ->setCellValue('D' . $i, $data['total_harga'])
                    ->setCellValue('E' . $i, $data['lama_produksi'])
                    ->setCellValue('F' . $i, $data['akhir_produksi'])
                    ->setCellValue('G' . $i, $data['perkiraan_budget'])
                    ->setCellValue('H' . $i, $data['angsuran'])
            ;
            $i++;
        }

        //set title pada sheet (me rename nama sheet)
        $objPHPExcel->getActiveSheet()->setTitle('Excel Pertama');

        //mulai menyimpan excel format xlsx, kalau ingin xls ganti Excel2007 menjadi Excel5          
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $filename = 'Rekapitulasi Produksi_'.$tglawal.'_'.$tglakhir.'.xlsx';
        //sesuaikan headernya 
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        //ubah nama file saat diunduh
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        //unduh file
        $objWriter->save("php://output");
    }
    
    function excel_realisasi() {
        
        $tglawal = $this->input->post('awal');
        $tglakhir = $this->input->post('akhir');
        
        
        $this->load->library("Excel");

        //membuat objek PHPExcel
        $objPHPExcel = new PHPExcel();

        //set Sheet yang akan diolah 
        $objPHPExcel->setActiveSheetIndex(0)
                //mengisikan value pada tiap-tiap cell, A1 itu alamat cellnya 
                //Hello merupakan isinya
                ->setCellValue('A1', 'Kode Produksi')
                ->setCellValue('B1', 'Tanggal Realisasi')
                ->setCellValue('C1', 'Nama TTD')
                ->setCellValue('D1', 'Jabatan TTD')
                ->setCellValue('E1', 'Total Harga')
                ->setCellValue('F1', 'Tanggal Ijin')
                ->setCellValue('G1', 'Tanggal Beli')
                ->setCellValue('H1', 'Tanggal Penggunaan Awal')
                ->setCellValue('I1', 'Tanggal Penggunaan Akhir')
                ->setCellValue('J1', 'Nominal')
                ->setCellValue('K1', 'Watt')
        ;

//where date_format(a.date_realisasi,'%Y-%m-%d') between $tglawal and $tglakhir
        $sql = "select a.idproduksi,a.date_realisasi,d.nama_ttd,d.jabatan_ttd,d.total_harga,b.tgl_ijin,c.tgl_beli,c.tgl_penggunaan_awal,
                c.tgl_penggunaan_akhir,c.nominal,c.watt 
                from t_produksi a join t_realisasi_ijin b on a.idproduksi = b.idrealisasi
                join t_listrik c on a.idproduksi = c.idproduksi
                join t_po d on a.idpo = d.idpo
                where date_format(a.date_realisasi,'%Y-%m-%d') between '".$tglawal."' and '".$tglakhir."'
                order by a.date_realisasi desc";
        $datas = $this->db->query($sql)->result_array();

        $i = 2; //dimulai isi
        foreach ($datas as $data) {
            $objPHPExcel->setActiveSheetIndex(0)
                    //mengisikan value pada tiap-tiap cell, A1 itu alamat cellnya 
                    //Hello merupakan isinya
                    ->setCellValue('A' . $i, $data['idproduksi'])
                    ->setCellValue('B' . $i, $data['date_realisasi'])
                    ->setCellValue('C' . $i, $data['nama_ttd'])
                    ->setCellValue('D' . $i, $data['jabatan_ttd'])
                    ->setCellValue('E' . $i, $data['total_harga'])
                    ->setCellValue('F' . $i, $data['tgl_ijin'])
                    ->setCellValue('G' . $i, $data['tgl_beli'])
                    ->setCellValue('H' . $i, $data['tgl_penggunaan_awal'])
                    ->setCellValue('I' . $i, $data['tgl_penggunaan_akhir'])
                    ->setCellValue('J' . $i, $data['nominal'])
                    ->setCellValue('K' . $i, $data['watt'])
            ;
            $i++;
        }

        //set title pada sheet (me rename nama sheet)
        $objPHPExcel->getActiveSheet()->setTitle('Excel Pertama');

        //mulai menyimpan excel format xlsx, kalau ingin xls ganti Excel2007 menjadi Excel5          
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $filename = 'RekapitulasiRealisasi_'.$tglawal.'_'.$tglakhir.'.xlsx';
        //sesuaikan headernya 
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        //ubah nama file saat diunduh
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        //unduh file
        $objWriter->save("php://output");
    }
    
    
    function excel_listrik() {
        
        $tglawal = $this->input->post('awal');
        $tglakhir = $this->input->post('akhir');
        
        $this->load->library("Excel");

        //membuat objek PHPExcel
        $objPHPExcel = new PHPExcel();

        //set Sheet yang akan diolah 
        $objPHPExcel->setActiveSheetIndex(0)
                //mengisikan value pada tiap-tiap cell, A1 itu alamat cellnya 
                //Hello merupakan isinya
                ->setCellValue('A1', 'Kode ID')
                ->setCellValue('B1', 'Tanggal Beli')
                ->setCellValue('C1', 'Nominal')
                ->setCellValue('D1', 'Watt')
                ->setCellValue('E1', 'Status')
                ->setCellValue('F1', 'Keterangan')
        ;


        $sql = "select a.id,a.tgl_beli,a.nominal,a.watt,a.`status`,a.keterangan from t_listrik a
                where date_format(a.tgl_beli,'%Y-%m-%d') between '".$tglawal."' and '".$tglakhir."'
                order by a.tgl_beli desc";
        $datas = $this->db->query($sql)->result_array();

        $i = 2; //dimulai isi
        foreach ($datas as $data) {
            $objPHPExcel->setActiveSheetIndex(0)
                    //mengisikan value pada tiap-tiap cell, A1 itu alamat cellnya 
                    //Hello merupakan isinya
                    ->setCellValue('A' . $i, $data['id'])
                    ->setCellValue('B' . $i, $data['tgl_beli'])
                    ->setCellValue('C' . $i, $data['nominal'])
                    ->setCellValue('D' . $i, $data['watt'])
                    ->setCellValue('E' . $i, $data['status'])
                    ->setCellValue('F' . $i, $data['keterangan'])
            ;
            $i++;
        }

        //set title pada sheet (me rename nama sheet)
        $objPHPExcel->getActiveSheet()->setTitle('Excel Pertama');

        //mulai menyimpan excel format xlsx, kalau ingin xls ganti Excel2007 menjadi Excel5          
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $filename = 'RekapitulasiListrik_'.$tglawal.'_'.$tglakhir.'.xlsx';
        //sesuaikan headernya 
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        //ubah nama file saat diunduh
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        //unduh file
        $objWriter->save("php://output");
    }
    
    function excel_pajak() {
        
        $tglawal = $this->input->post('awal');
        $tglakhir = $this->input->post('akhir');
        
        $this->load->library("Excel");

        //membuat objek PHPExcel
        $objPHPExcel = new PHPExcel();

        //set Sheet yang akan diolah 
        $objPHPExcel->setActiveSheetIndex(0)
                //mengisikan value pada tiap-tiap cell, A1 itu alamat cellnya 
                //Hello merupakan isinya
                ->setCellValue('A1', 'Kode Pajak')
                ->setCellValue('B1', 'Jatuh Tempo')
                ->setCellValue('C1', 'Tanggal Bayar')
                ->setCellValue('D1', 'Nama Lokasi')
                ->setCellValue('E1', 'Alamat Lokasi')
                ->setCellValue('F1', 'Nama Kota')
                ->setCellValue('G1', 'Nama Provinsi')
        ;


        $sql = "select a.idijin, a.tgl_akhir, a.tgl_ijin,b.nama_lokasi,b.alamat_lokasi,c.nama_kota,d.nama_provinsi 
                from m_lokasi_ijin a join m_lokasi b on a.kdlokasi = b.kdlokasi
                join m_kota c on b.kdkota = c.kdkota
                join m_provinsi d on c.kdprovinsi = d.kdprovinsi
                where date_format(a.date_create,'%Y-%m-%d') between '".$tglawal."' and '".$tglakhir."'
                order by a.date_create desc";
                
        $datas = $this->db->query($sql)->result_array();

        $i = 2; //dimulai isi
        foreach ($datas as $data) {
            $objPHPExcel->setActiveSheetIndex(0)
                    //mengisikan value pada tiap-tiap cell, A1 itu alamat cellnya 
                    //Hello merupakan isinya
                    ->setCellValue('A' . $i, $data['idijin'])
                    ->setCellValue('B' . $i, $data['tgl_akhir'])
                    ->setCellValue('C' . $i, $data['tgl_ijin'])
                    ->setCellValue('D' . $i, $data['nama_lokasi'])
                    ->setCellValue('E' . $i, $data['alamat_lokasi'])
                    ->setCellValue('F' . $i, $data['nama_kota'])
                    ->setCellValue('G' . $i, $data['nama_provinsi'])
            ;
            $i++;
        }

        //set title pada sheet (me rename nama sheet)
        $objPHPExcel->getActiveSheet()->setTitle('Excel Pertama');

        //mulai menyimpan excel format xlsx, kalau ingin xls ganti Excel2007 menjadi Excel5          
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $filename = 'RekapitulasiPajak_'.$tglawal.'_'.$tglakhir.'.xlsx';
        //sesuaikan headernya 
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        //ubah nama file saat diunduh
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        //unduh file
        $objWriter->save("php://output");
    }
    
    function form(){
        $type = $this->uri->segment(3);
        
        switch($type){
            case 'penawaran':
                $data['title'] = 'Laporan '.ucfirst($type);
                $data['url'] = 'excel_'.$type;
            break;
            
            case 'po':
                $data['title'] = 'Laporan '.ucfirst($type);
                $data['url'] = 'excel_'.$type; 
            break;
            
            case 'produksi':
                $data['title'] = 'Laporan '.ucfirst($type);
                $data['url'] = 'excel_'.$type;
            break;
            
            case 'realisasi':
                $data['title'] = 'Laporan '.ucfirst($type);
                $data['url'] = 'excel_'.$type;
            break;
            
            case 'listrik':
                $data['title'] = 'Laporan '.ucfirst($type);
                $data['url'] = 'excel_'.$type;
            break;
            
            case 'pajak':
                $data['title'] = 'Laporan '.ucfirst($type);
                $data['url'] = 'excel_'.$type;
            break;
        }
        
        echo $this->load->view($this->path . '/form', $data, TRUE);
    }
}