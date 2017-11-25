/*
SQLyog Community v12.4.3 (64 bit)
MySQL - 10.1.25-MariaDB : Database - arvindo
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`arvindo` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `arvindo`;

/*Table structure for table `m_barang` */

DROP TABLE IF EXISTS `m_barang`;

CREATE TABLE `m_barang` (
  `kd_brg` varchar(24) NOT NULL,
  `nama_barang` varchar(120) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `satuan` varchar(60) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  `user_create` varchar(45) DEFAULT NULL,
  `status` char(3) DEFAULT NULL,
  `kd_suplier` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `m_barang` */

/*Table structure for table `m_cabang` */

DROP TABLE IF EXISTS `m_cabang`;

CREATE TABLE `m_cabang` (
  `kdcabang` varchar(8) NOT NULL,
  `nama_cabang` varchar(35) DEFAULT NULL,
  `alamat_cabang` varchar(35) DEFAULT NULL,
  `kdkota` varchar(10) DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  PRIMARY KEY (`kdcabang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `m_cabang` */

/*Table structure for table `m_client` */

DROP TABLE IF EXISTS `m_client`;

CREATE TABLE `m_client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `kdkota` varchar(15) DEFAULT NULL,
  `alamat` text,
  `npwp` varchar(16) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `date_update` datetime NOT NULL,
  `user_create` varchar(25) DEFAULT NULL,
  `user_update` varchar(25) DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `m_client` */

/*Table structure for table `m_karyawan` */

DROP TABLE IF EXISTS `m_karyawan`;

CREATE TABLE `m_karyawan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `npwp` varchar(20) NOT NULL,
  `nama_karyawan` varchar(15) NOT NULL,
  `alamat_asal` varchar(35) DEFAULT NULL,
  `alamat_domisili` varchar(35) DEFAULT NULL,
  `nomor_hp` varchar(15) DEFAULT NULL,
  `jns_kelamin` char(1) DEFAULT NULL,
  `tgl_lahir` date NOT NULL,
  `agama` varchar(10) NOT NULL,
  `gaji_harian` varchar(15) DEFAULT NULL,
  `gaji_pokok` varchar(15) DEFAULT NULL,
  `status` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `m_karyawan` */

/*Table structure for table `m_kota` */

DROP TABLE IF EXISTS `m_kota`;

CREATE TABLE `m_kota` (
  `kdkota` varchar(10) NOT NULL,
  `kdprovinsi` varchar(10) DEFAULT NULL,
  `nama_kota` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`kdkota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `m_kota` */

/*Table structure for table `m_lokasi` */

DROP TABLE IF EXISTS `m_lokasi`;

CREATE TABLE `m_lokasi` (
  `kdlokasi` varchar(5) NOT NULL,
  `kdkota` varchar(15) DEFAULT NULL,
  `nama_lokasi` varchar(40) DEFAULT NULL,
  `alamat_lokasi` text,
  `arah_pandang` text,
  `kdstatus` varchar(5) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  `user_create` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`kdlokasi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `m_lokasi` */

/*Table structure for table `m_lokasi_file` */

DROP TABLE IF EXISTS `m_lokasi_file`;

CREATE TABLE `m_lokasi_file` (
  `idlokasifile` int(11) NOT NULL AUTO_INCREMENT,
  `idlokasi` int(11) DEFAULT NULL,
  `idijin` int(11) DEFAULT NULL,
  `keterangan` text,
  `file_upload` varchar(50) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `user_create` varchar(25) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idlokasifile`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `m_lokasi_file` */

/*Table structure for table `m_lokasi_ijin` */

DROP TABLE IF EXISTS `m_lokasi_ijin`;

CREATE TABLE `m_lokasi_ijin` (
  `idijin` int(11) NOT NULL AUTO_INCREMENT,
  `kdlokasi` varchar(25) DEFAULT NULL,
  `tgl_ijin` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `nominal` varchar(50) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `user_create` varchar(15) DEFAULT NULL,
  `nomor_ijin` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idijin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `m_lokasi_ijin` */

/*Table structure for table `m_lokasi_ijin_file` */

DROP TABLE IF EXISTS `m_lokasi_ijin_file`;

CREATE TABLE `m_lokasi_ijin_file` (
  `idijinfile` int(11) NOT NULL AUTO_INCREMENT,
  `idijin` int(11) DEFAULT NULL,
  `fileupload` varchar(255) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  PRIMARY KEY (`idijinfile`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `m_lokasi_ijin_file` */

/*Table structure for table `m_lokasi_sewa` */

DROP TABLE IF EXISTS `m_lokasi_sewa`;

CREATE TABLE `m_lokasi_sewa` (
  `idijin` int(11) DEFAULT NULL,
  `kdlokasi` varchar(75) DEFAULT NULL,
  `tgl_ijin` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `nominal` varchar(150) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `user_create` varchar(45) DEFAULT NULL,
  `nomor_ijin` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `m_lokasi_sewa` */

/*Table structure for table `m_lokasi_sewa_file` */

DROP TABLE IF EXISTS `m_lokasi_sewa_file`;

CREATE TABLE `m_lokasi_sewa_file` (
  `idijinfile` int(11) DEFAULT NULL,
  `idijin` int(11) DEFAULT NULL,
  `fileupload` varchar(765) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `m_lokasi_sewa_file` */

/*Table structure for table `m_material` */

DROP TABLE IF EXISTS `m_material`;

CREATE TABLE `m_material` (
  `idmaterial` int(11) NOT NULL AUTO_INCREMENT,
  `nama_material` varchar(30) DEFAULT NULL,
  `harga` varchar(20) DEFAULT NULL,
  `satuan` varchar(20) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  `user_create` varchar(15) DEFAULT NULL,
  `user_update` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`idmaterial`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `m_material` */

/*Table structure for table `m_provinsi` */

DROP TABLE IF EXISTS `m_provinsi`;

CREATE TABLE `m_provinsi` (
  `kdprovinsi` varchar(10) DEFAULT NULL,
  `nama_provinsi` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `m_provinsi` */

/*Table structure for table `m_setting` */

DROP TABLE IF EXISTS `m_setting`;

CREATE TABLE `m_setting` (
  `PPN` varchar(3) NOT NULL,
  `count_brg` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `m_setting` */

/*Table structure for table `m_status` */

DROP TABLE IF EXISTS `m_status`;

CREATE TABLE `m_status` (
  `kdstatus` char(2) DEFAULT NULL,
  `description` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `m_status` */

/*Table structure for table `m_suplier` */

DROP TABLE IF EXISTS `m_suplier`;

CREATE TABLE `m_suplier` (
  `kd_suplier` varchar(10) NOT NULL,
  `nama_suplier` varchar(35) DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `user_create` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`kd_suplier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `m_suplier` */

/*Table structure for table `m_user` */

DROP TABLE IF EXISTS `m_user`;

CREATE TABLE `m_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(35) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(20) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `date_create` datetime NOT NULL,
  `date_update` datetime DEFAULT NULL,
  `status` varchar(5) NOT NULL,
  `id_cabang` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `m_user` */

insert  into `m_user`(`id`,`username`,`password`,`nama`,`email`,`last_login`,`date_create`,`date_update`,`status`,`id_cabang`) values 
(1,'arvindo','202cb962ac59075b964b07152d234b70','Arvindo','arvindo@gmail.com',NULL,'2017-11-24 17:56:58',NULL,'1',NULL);

/*Table structure for table `t_angsuran` */

DROP TABLE IF EXISTS `t_angsuran`;

CREATE TABLE `t_angsuran` (
  `kdproduksi` varchar(10) DEFAULT NULL,
  `nominal` varchar(15) DEFAULT NULL,
  `tgl_bayar` datetime DEFAULT NULL,
  `tgl_jatuh_tempo` datetime DEFAULT NULL,
  `kdangsuran` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`kdangsuran`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_angsuran` */

/*Table structure for table `t_angsuran_file` */

DROP TABLE IF EXISTS `t_angsuran_file`;

CREATE TABLE `t_angsuran_file` (
  `kdangsuran` varchar(5) DEFAULT NULL,
  `fileupload` varchar(255) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_angsuran_file` */

/*Table structure for table `t_atk` */

DROP TABLE IF EXISTS `t_atk`;

CREATE TABLE `t_atk` (
  `kdatk` int(11) NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(120) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `satuan` varchar(60) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `date_alert` datetime DEFAULT NULL,
  `user_create` varchar(45) DEFAULT NULL,
  `status` char(3) DEFAULT NULL,
  `idcabang` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`kdatk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_atk` */

/*Table structure for table `t_atk_gagal` */

DROP TABLE IF EXISTS `t_atk_gagal`;

CREATE TABLE `t_atk_gagal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(50) DEFAULT NULL,
  `tgl_pakai` datetime DEFAULT NULL,
  `biaya` varchar(20) DEFAULT NULL,
  `datecreated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_atk_gagal` */

/*Table structure for table `t_barang` */

DROP TABLE IF EXISTS `t_barang`;

CREATE TABLE `t_barang` (
  `id_trx_brg` int(11) DEFAULT NULL,
  `kd_brg` varchar(24) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `action` varchar(30) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `user_create` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_barang` */

/*Table structure for table `t_gaji` */

DROP TABLE IF EXISTS `t_gaji`;

CREATE TABLE `t_gaji` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) DEFAULT NULL,
  `gaji_harian` varchar(15) DEFAULT NULL,
  `hari_kerja` char(2) DEFAULT NULL,
  `gaji_pokok` varchar(15) DEFAULT NULL,
  `over_time` char(3) DEFAULT NULL,
  `uang_makan` varchar(15) DEFAULT NULL,
  `kasbon_harian` varchar(15) DEFAULT NULL,
  `kasbon_bulanan` varchar(15) DEFAULT NULL,
  `bulan` char(2) DEFAULT NULL,
  `minggu` char(1) DEFAULT NULL,
  `tahun` char(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_gaji` */

/*Table structure for table `t_listrik` */

DROP TABLE IF EXISTS `t_listrik`;

CREATE TABLE `t_listrik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_beli` datetime DEFAULT NULL,
  `tgl_penggunaan_awal` date DEFAULT NULL,
  `tgl_penggunaan_akhir` date DEFAULT NULL,
  `nominal` varchar(50) DEFAULT NULL,
  `watt` varchar(50) DEFAULT NULL,
  `user_created` varchar(35) DEFAULT NULL,
  `user_update` varchar(35) DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `idproduksi` int(11) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_listrik` */

/*Table structure for table `t_listrik_file` */

DROP TABLE IF EXISTS `t_listrik_file`;

CREATE TABLE `t_listrik_file` (
  `idlistrik` int(11) NOT NULL AUTO_INCREMENT,
  `keterangan` varchar(100) DEFAULT NULL,
  `fileupload` varchar(255) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `user_create` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`idlistrik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_listrik_file` */

/*Table structure for table `t_pajak` */

DROP TABLE IF EXISTS `t_pajak`;

CREATE TABLE `t_pajak` (
  `kdpajak` int(11) NOT NULL AUTO_INCREMENT,
  `kdlokasi` varchar(50) DEFAULT NULL,
  `jatuh_tempo` datetime DEFAULT NULL,
  `tgl_bayar` datetime DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  PRIMARY KEY (`kdpajak`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_pajak` */

/*Table structure for table `t_penawaran_dtl` */

DROP TABLE IF EXISTS `t_penawaran_dtl`;

CREATE TABLE `t_penawaran_dtl` (
  `idpenawarandtl` int(11) NOT NULL AUTO_INCREMENT,
  `idpenawaranhdr` int(11) DEFAULT NULL,
  `keterangan` text,
  `harga` double DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  `user_create` varchar(15) DEFAULT NULL,
  `user_update` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`idpenawarandtl`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_penawaran_dtl` */

/*Table structure for table `t_penawaran_file` */

DROP TABLE IF EXISTS `t_penawaran_file`;

CREATE TABLE `t_penawaran_file` (
  `idpenawaranfile` int(11) NOT NULL AUTO_INCREMENT,
  `idpenawaran` int(11) DEFAULT NULL,
  `keterangan` text,
  `fileupload` varchar(255) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `user_create` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`idpenawaranfile`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_penawaran_file` */

/*Table structure for table `t_penawaran_hdr` */

DROP TABLE IF EXISTS `t_penawaran_hdr`;

CREATE TABLE `t_penawaran_hdr` (
  `idpenawaran` int(11) NOT NULL AUTO_INCREMENT,
  `produk` varchar(50) DEFAULT NULL,
  `ukuran` varchar(50) DEFAULT NULL,
  `kdlokasi` varchar(10) DEFAULT NULL,
  `periode` int(11) DEFAULT NULL,
  `satuan_period` varchar(5) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  `kdstatus` char(2) DEFAULT NULL,
  `user_create` varchar(15) DEFAULT NULL,
  `user_update` varchar(15) DEFAULT NULL,
  `pph` varchar(20) DEFAULT NULL,
  `total_harga` varchar(30) DEFAULT NULL,
  `id_cabang` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idpenawaran`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_penawaran_hdr` */

/*Table structure for table `t_po` */

DROP TABLE IF EXISTS `t_po`;

CREATE TABLE `t_po` (
  `idpo` int(11) NOT NULL AUTO_INCREMENT,
  `idpenawaran` int(11) DEFAULT NULL,
  `idclient` int(11) DEFAULT NULL,
  `nama_ttd` varchar(35) DEFAULT NULL,
  `jabatan_ttd` varchar(35) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `biaya_akhir` varchar(20) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  `user_create` varchar(25) DEFAULT NULL,
  `user_update` varchar(25) DEFAULT NULL,
  `pph` varchar(30) DEFAULT NULL,
  `total_harga` varchar(30) DEFAULT NULL,
  `kdstatus` char(1) DEFAULT '0',
  PRIMARY KEY (`idpo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_po` */

/*Table structure for table `t_po_detail` */

DROP TABLE IF EXISTS `t_po_detail`;

CREATE TABLE `t_po_detail` (
  `idpodtl` int(11) NOT NULL AUTO_INCREMENT,
  `idpo` int(11) DEFAULT NULL,
  `keterangan` text,
  `harga` varchar(20) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `satuan` varchar(15) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  `user_create` varchar(25) DEFAULT NULL,
  `user_update` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`idpodtl`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_po_detail` */

/*Table structure for table `t_po_file` */

DROP TABLE IF EXISTS `t_po_file`;

CREATE TABLE `t_po_file` (
  `idpofile` int(11) NOT NULL AUTO_INCREMENT,
  `idpo` int(11) DEFAULT NULL,
  `keterangan` text,
  `fileupload` varchar(225) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `user_create` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`idpofile`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_po_file` */

/*Table structure for table `t_produksi` */

DROP TABLE IF EXISTS `t_produksi`;

CREATE TABLE `t_produksi` (
  `idproduksi` int(11) NOT NULL AUTO_INCREMENT,
  `idpo` int(11) DEFAULT NULL,
  `date_realisasi` datetime DEFAULT NULL,
  `lama_produksi` date DEFAULT NULL,
  `akhir_produksi` date DEFAULT NULL,
  `perkiraan_budget` varchar(20) DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  `user_create` varchar(15) DEFAULT NULL,
  `user_update` varchar(15) DEFAULT NULL,
  `angsuran` char(5) DEFAULT NULL,
  PRIMARY KEY (`idproduksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_produksi` */

/*Table structure for table `t_produksi_dtl` */

DROP TABLE IF EXISTS `t_produksi_dtl`;

CREATE TABLE `t_produksi_dtl` (
  `idproduksidtl` int(11) NOT NULL AUTO_INCREMENT,
  `idproduksi` int(11) DEFAULT NULL,
  `idmaterial` varchar(50) DEFAULT NULL,
  `jumlah` varchar(20) DEFAULT NULL,
  `harga_satuan` varchar(20) DEFAULT NULL,
  `harga_total` varchar(20) DEFAULT NULL,
  `keterangan` text,
  PRIMARY KEY (`idproduksidtl`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_produksi_dtl` */

/*Table structure for table `t_produksi_file` */

DROP TABLE IF EXISTS `t_produksi_file`;

CREATE TABLE `t_produksi_file` (
  `idproduksifile` int(11) NOT NULL AUTO_INCREMENT,
  `idproduksi` int(11) DEFAULT NULL,
  `keterangan` text,
  `fileupload` varchar(200) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `user_create` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`idproduksifile`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_produksi_file` */

/*Table structure for table `t_realisasi_file` */

DROP TABLE IF EXISTS `t_realisasi_file`;

CREATE TABLE `t_realisasi_file` (
  `idrealisasifile` int(11) NOT NULL AUTO_INCREMENT,
  `idproduksi` int(11) DEFAULT NULL,
  `keterangan` text,
  `fileupload` varchar(200) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `user_create` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`idrealisasifile`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_realisasi_file` */

/*Table structure for table `t_realisasi_ijin` */

DROP TABLE IF EXISTS `t_realisasi_ijin`;

CREATE TABLE `t_realisasi_ijin` (
  `idijin` int(11) NOT NULL AUTO_INCREMENT,
  `idrealisasi` int(11) NOT NULL,
  `tgl_awal` date DEFAULT NULL,
  `tgl_ijin` date DEFAULT NULL,
  `user_create` varchar(15) DEFAULT NULL,
  `user_update` varchar(15) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  PRIMARY KEY (`idijin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_realisasi_ijin` */

/*Table structure for table `t_realisasi_produk` */

DROP TABLE IF EXISTS `t_realisasi_produk`;

CREATE TABLE `t_realisasi_produk` (
  `idrealisasi` int(11) NOT NULL AUTO_INCREMENT,
  `idproduksi` int(11) DEFAULT NULL,
  `idmaterial` int(11) DEFAULT NULL,
  `jumlah` varchar(20) DEFAULT NULL,
  `harga_satuan` varchar(20) DEFAULT NULL,
  `harga_total` varchar(20) DEFAULT NULL,
  `keterangan` text,
  PRIMARY KEY (`idrealisasi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_realisasi_produk` */

/*Table structure for table `t_role` */

DROP TABLE IF EXISTS `t_role`;

CREATE TABLE `t_role` (
  `kode` char(2) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_role` */

insert  into `t_role`(`kode`,`status`) values 
('1','Superuser'),
('2','Admin'),
('3','AE'),
('4','GM'),
('5','Keuangan ASMI'),
('6','Keuangan ADPI');

/*Table structure for table `t_sewa` */

DROP TABLE IF EXISTS `t_sewa`;

CREATE TABLE `t_sewa` (
  `kdsewa` int(11) NOT NULL AUTO_INCREMENT,
  `kdlokasi` varchar(50) DEFAULT NULL,
  `jatuh_tempo` datetime DEFAULT NULL,
  `tgl_bayar` datetime DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  PRIMARY KEY (`kdsewa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_sewa` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
