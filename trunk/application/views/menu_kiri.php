<?php if (!defined('BASEPATH')) exit('No direct script access allowed');?>

<?php
	$kerjasama = false;
	$master_data = false;
	$laporan = false;
	$manajemen_pengguna = false;
	$pendaftaran_pt = false;
	$ijin_kerjasama = false;
	$ijin_kerjasama2 = false;
	$ijin_kerjasama3 = false;
	$database = false;
	
	$this->load->library('session');
	$kode_role = $this->session->userdata('kode_role');
	if($kode_role == 1 ){	//untuk role admin
		$kerjasama = true;
		$master_data = true;
		$laporan = true;
		$manajemen_pengguna = true;
		$pendaftaran_pt = true;
		$ijin_kerjasama = true;
		$ijin_kerjasama2 = true;
		$ijin_kerjasama3 = false;
		$database = true;
	}
	else if($kode_role == 2){ //untuk role dikti
		$kerjasama = true;
		$master_data = true;
		$laporan = true;
		$manajemen_pengguna = true;
		$ijin_kerjasama = true;
		$pendaftaran_pt = false;
		$ijin_kerjasama2 = true;
		$ijin_kerjasama3 = false;
	}
	else if($kode_role == 3){
		$laporan = true;
	}
	else if($kode_role == 4){
		$kerjasama = false;
		$ijin_kerjasama = true;
		$ijin_kerjasama3 = true;
		$manajemen_pengguna = false;
	}


?>

<div> <!--This is the first division of left-->
  <div id="firstpane" class="menu_list"> <!--Code for menu starts here-->
		<p class="menu_head" ><?php echo anchor(site_url('home'),img(array('src'=>'images/icon/home.png','border'=>'0','alt'=>'')).' Halaman Utama',''); ?></p>
		
		<?php if($kerjasama) {?><p class="menu_head" ><?php echo anchor(site_url('pendaftaran/grid_pendaftaran'),img(array('src'=>'images/icon/dir.png','border'=>'0','alt'=>'')).' Pendataan Kerjasama',''); }?></p>
		<?php if($ijin_kerjasama) { ?><p class="menu_head"><?php echo img(array('src'=>'images/icon/dir.png','border'=>'0','alt'=>''))?>Ijin Kerjasama</p><?php ; ?>
		<div class="menu_body" align="left">
			<?php if($ijin_kerjasama3) echo anchor(site_url('daftar_ijin_kerma'),img(array('src'=>'images/icon/doc.png','border'=>'0','alt'=>'')).' Permohonan Ijin Kerma',''); ?>
			<?php if($ijin_kerjasama2) echo anchor(site_url('permohonan/daftar_permohonan'),img(array('src'=>'images/icon/doc.png','border'=>'0','alt'=>'')).' Daftar Permohonan Kerma',''); ?>
		</div><?php } ?>
		
		<?php if ($master_data) { ?><p class="menu_head"><?php echo img(array('src'=>'images/icon/dir.png','border'=>'0','alt'=>''))?> Master Data</p>
		<div class="menu_body" align="left">
			<?php echo anchor(site_url('master_data/master_region'),img(array('src'=>'images/icon/doc.png','border'=>'0','alt'=>'')).' Region',''); ?>
			<?php echo anchor(site_url('master_data/master_negara'),img(array('src'=>'images/icon/doc.png','border'=>'0','alt'=>'')).' Negara',''); ?>
			<?php echo anchor(site_url('master_data/master_jenispt'),img(array('src'=>'images/icon/doc.png','border'=>'0','alt'=>'')).' Jenis Perguruan Tinggi',''); ?>
			<?php echo anchor(site_url('master_data/master_pt'),img(array('src'=>'images/icon/doc.png','border'=>'0','alt'=>'')).' Perguruan Tinggi',''); ?>
			<?php echo anchor(site_url('master_data/master_fakultas'),img(array('src'=>'images/icon/doc.png','border'=>'0','alt'=>'')).' Fakultas',''); ?>
			<?php echo anchor(site_url('master_data/master_konsentrasi'),img(array('src'=>'images/icon/doc.png','border'=>'0','alt'=>'')).' Konsentrasi',''); ?>
			<?php echo anchor(site_url('master_data/master_jenis_kerjasama'),img(array('src'=>'images/icon/doc.png','border'=>'0','alt'=>'')).' Jenis Kerja Sama',''); ?>
			<?php echo anchor(site_url('master_data/master_jabatan'),img(array('src'=>'images/icon/doc.png','border'=>'0','alt'=>'')).' Jabatan',''); ?>
			<?php echo anchor(site_url('master_data/master_unit_kerja'),img(array('src'=>'images/icon/doc.png','border'=>'0','alt'=>'')).' Unit Kerja',''); ?>
			
		</div><?php } ?>
		
		<?php if ($laporan) { ?><p class="menu_head" ><?php echo img(array('src'=>'images/icon/dir.png','border'=>'0','alt'=>''))?> Laporan</p>
		<div class="menu_body" align="left">
			<?php echo anchor(site_url('laporan_c'),img(array('src'=>'images/icon/doc.png','border'=>'0','alt'=>'')).' Cetak Laporan',''); ?>
			<?php echo anchor(site_url('chart_data'),img(array('src'=>'images/icon/doc.png','border'=>'0','alt'=>'')).' Lihat Grafik',''); ?>
			
		</div><?php } ?>
		
		<p class="menu_head"><?php echo img(array('src'=>'images/icon/dir.png','border'=>'0','alt'=>''))?> User Menu</p>
		<div class="menu_body" align="left">
		  <?php if ($manajemen_pengguna) { ?><?php echo anchor(site_url('manajemen_user'),img(array('src'=>'images/icon/doc.png','border'=>'0','alt'=>'')).' Manajemen Pengguna',''); ?><?php } ?>
          <?php if ($pendaftaran_pt) { ?><?php echo anchor(site_url('manajemen_user/grid_pendaftaran_pt'),img(array('src'=>'images/icon/doc.png','border'=>'0','alt'=>'')).' Pendaftaran Perguruan Tinggi',''); ?><?php } ?>
          <?php if($database)echo anchor(site_url('database'),img(array('src'=>'images/icon/doc.png','border'=>'0','alt'=>'')).' Database',''); ?>
		  <?php echo anchor(site_url('login/log_out'),img(array('src'=>'images/icon/lock.png','border'=>'0','alt'=>'')).' Logout',''); ?>

		</div>
	  
  </div>  <!--Code for menu ends here-->
</div>
