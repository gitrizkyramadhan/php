<?php 
$role = $this->newsession->userdata('status');
?>
<div class="col-md-3 left_col">
<div class="left_col scroll-view">
<div class="navbar nav_title" style="border: 0;">
  <a href="index.html" class="site_title">
    <!--<i class="fa fa-paw"></i>-->     
    <span> &nbsp;App E-Watch</span></a>    
</div>

<div class="clearfix"></div>

<!-- menu profile quick info -->
<div class="profile clearfix">
  <div class="profile_pic">
    <img src="<?= base_url('aset') ?>/img/user_avatar.png" alt="..." class="img-circle profile_img">
  </div>
  <div class="profile_info">
    <span>Welcome,</span>
    <h2><?= ucfirst($this->newsession->userdata('nama'));?></h2>
  </div>
</div>
<!-- /menu profile quick info -->

<br />

<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <h3>Menu</h3>

	<?php if(in_array($role , array('1', '2', '3', '4', '5', '6') )){ ?>
    <ul class="nav side-menu">
	  <li><a href="<?= site_url('dashboard') ?>"><i class="fa fa-home"></i> Dashboard</a></li>
	  <?php //if($role != '2') { ?>
      <li><a><i class="fa fa-edit"></i> Transaksi <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="<?= site_url('mockups#penawaran/getTable') ?>">Penawaran</a></li>  
          <li><a href="<?= site_url('mockups#po/getTable') ?>">Purchase Order</a></li>
          <li><a href="<?= site_url('mockups#produksi/getTable') ?>">Produksi</a></li>
		  <li><a href="<?= site_url('mockups#realisasi/getTable') ?>">Realisasi</a></li>
          <!--<li><a href="<?= site_url('mockups#lokasi/getTable') ?>">Lokasi</a></li>-->
          <li><a href="<?= site_url('mockups#listrik/getTable') ?>">Listrik</a></li>
          <li><a href="<?= site_url('mockups#ijin/getTable') ?>">Ijin</a></li>
          <li><a href="<?= site_url('mockups#pajak/getTable') ?>">Pajak</a></li>
		  <li><a href="<?= site_url('mockups#sewa/getTable') ?>">Sewa Lokasi</a></li>
          <li><a href="<?= site_url('mockups#tagihan/getTable') ?>">Tagihan</a></li>
		  <?php if(in_array($role , array('3', '6') ) == FALSE){ ?>
		  <?php if($role != '2') { ?>
          <li><a href="<?= site_url('mockups#gaji/getTable') ?>">Gaji</a></li>
		  <?php }?>
		  <li><a href="<?= site_url('mockups#master/ListData/atk') ?>">Inventaris</a></li>
		  
		  <?php }?>
          <!--<li><a href="<?= site_url('mockups#absensi/getTable') ?>">Absensi</a></li>-->
        </ul>
      </li>
	  <?php// } ?>
      <?php if(in_array($role , array('5', '6') ) == FALSE){ ?>
      <li><a><i class="fa fa-table"></i> Master <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
		<?php if(in_array($role , array('2', '3') ) == FALSE){ ?>
		  <li><a href="<?= site_url('mockups#master/ListData/suplier') ?>">Suplier</a></li>
		  <li><a href="<?= site_url('mockups#master/ListData/barang') ?>">Persedian Barang</a></li>
		<?php }
		
		if($role == '3'){
		?>
          <li><a href="<?= site_url('mockups#master/ListData/client') ?>">Client</a></li>
		<?php }else{ ?>
		<?php if(in_array($role , array('4') ) == FALSE){ ?>
		  <li><a href="<?= site_url('mockups#master/ListData/provinsi') ?>">Provinsi</a></li>
		  <li><a href="<?= site_url('mockups#master/ListData/kota') ?>">Kota/Kabupaten</a></li>
		  <li><a href="<?= site_url('mockups#master/ListData/lokasi') ?>">Lokasi</a></li>
		  <li><a href="<?= site_url('mockups#master/ListData/cabang') ?>">Cabang</a></li>
		  <li><a href="<?= site_url('mockups#master/ListData/karyawan') ?>">Karyawan</a></li>
		<?php }
		} ?>
        </ul>
      </li>
      <?php } ?>
      <?php if(in_array($role , array('1', '5', '6') )){ ?>
      
      <li><a><i class="fa fa-bar-chart-o"></i> Laporan Rekapitulasi <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="<?= site_url('mockups#rekapitulasi/form/penawaran'); ?>">Penawaran</a></li>
          <li><a href="<?= site_url('mockups#rekapitulasi/form/po'); ?>">PO</a></li>
          <li><a href="<?= site_url('mockups#rekapitulasi/form/produksi'); ?>">Produksi</a></li>
          <li><a href="<?= site_url('mockups#rekapitulasi/form/realisasi'); ?>">Realisasi</a></li>
          <li><a href="<?= site_url('mockups#rekapitulasi/form/listrik'); ?>">Listrik</a></li>
          <li><a href="<?= site_url('mockups#rekapitulasi/form/pajak'); ?>">Pajak</a></li>
        </ul>
      </li>
      <?php }} ?>
    </ul>
  </div>
  <div class="menu_section">
    <h3>Setting</h3>
    <ul class="nav side-menu">
        <!--<li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Profile</a></li>-->
		<?php if(in_array($role , array('1') )){ ?>
		<li><a href="<?= site_url('mockups#master/ListData/users'); ?>"><i class="fa fa-laptop"></i> Manage User</a></li>
		<?php } ?>
        <li><a href="<?= site_url('login/logout'); ?>"><i class="fa fa-laptop"></i> Logout</a></li>
    </ul>
  </div>

</div>