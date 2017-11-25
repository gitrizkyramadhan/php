<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class m_dash extends CI_Model {

    function list_dash($param) {
        if ($param == "listrik") {
            $sql = "select a.id,a.tgl_beli,a.tgl_penggunaan_awal,a.tgl_penggunaan_akhir,a.nominal, 
            a.watt,a.idproduksi from t_listrik a where a.status = '1' and 
            a.tgl_penggunaan_akhir between curdate() and date_add(curdate(),interval 30 day)
            order by a.tgl_penggunaan_akhir desc limit 10";
        } else if ($param == "pajak") {
            $sql = "select a.kdpajak,a.kdlokasi,a.jatuh_tempo,a.tgl_bayar from t_pajak a 
                where a.status = '1' and a.jatuh_tempo between curdate() and date_add(curdate(),interval 30 day) 
                order by a.jatuh_tempo desc limit 10";
        } else if ($param == "ijinlokasi") {
            $sql = "select a.idijin,a.kdlokasi,a.tgl_ijin,a.tgl_akhir,a.nominal from m_lokasi_ijin a
            where a.tgl_akhir between curdate() and date_add(curdate(),interval 30 day) 
            order by a.tgl_akhir desc limit 10";
        } else if ($param == "tagihan") {
            $sql = "select d.npwp,d.nama,b.date_realisasi,a.nominal from t_angsuran a join t_produksi b on a.kdproduksi = b.idproduksi
            join t_po c on b.idpo = c.idpo join m_client d on c.idclient = d.id
            where a.tgl_jatuh_tempo between curdate() and date_add(curdate(),interval 30 day) 
            and a.tgl_bayar is null 
            order by a.tgl_jatuh_tempo desc limit 10";
        }
        return $this->db->query($sql)->result_array();
    }

    function count($param = null) {
        if ($param == "penawaran") {
            $sql = "select count(idpenawaran) 'count' from t_penawaran_hdr where date_create like '" . date("Y-m-d") . "%'";
        } else if ($param == "po") {
            $sql = "select count(idpo) 'count' from t_po where date_create like '" . date("Y-m-d") . "%'";
        } else if ($param == "produksi") {
            $sql = "select count(idproduksi) 'count' from t_produksi where date_create like '" . date("Y-m-d") . "%'";
        } else if ($param == "relisasi") {
            $sql = "select count(idproduksi) 'count' from t_produksi where date_realisasi like '" . date("Y-m-d") . "%'";
        } else if ($param == "material") {
            $sql = "select count(idpo) 'count' from t_po where date_create like '" . date("Y-m-d") . "%'";
        } else if ($param == "listrik") {
            $sql = "select count(id) 'count' from t_listrik where date_create like '" . date("Y-m-d") . "%'";
        }


        $a = $this->db->query($sql)->row();
        $isi = "";
        $isi = ($a->count == '0') ?  '0' : $a->count;
        return $isi;
    }

}
