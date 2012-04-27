<?php if (!defined('BASEPATH')) exit('No direct script access allowed');?>

<?php
	$master_data = true;
	$manajemen_pengguna = true;
	$surat_masuk = true;
	$catat_surat_masuk = true;
	
/*
	$this->load->library('session');
	$kode_role = $this->session->userdata('kode_role');
	if($kode_role == 1 ){	//untuk role admin
		$master_data = true;
		$manajemen_pengguna = true;
		$surat_masuk = true;
		$catat_surat_masuk = true; 
	}
	else if($kode_role == 2){ //untuk role asisten dan sekretaris
		$master_data = false;
		$manajemen_pengguna = false;
		$surat_masuk = true;
		$catat_surat_masuk = false; 
	}
	else if($kode_role == 3){ //untuk role wakil bupati dan bupati
		$master_data = false;
		$manajemen_pengguna = false;
		$surat_masuk = true;
		$catat_surat_masuk = false;
	}
	else if($kode_role == 4){ //dinas
		$master_data = false;
		$manajemen_pengguna = false;
		$surat_masuk = true;
		$catat_surat_masuk = false;
	}
*/


?>

<div> <!--This is the first division of left-->
  <div id="firstpane" class="menu_list"> <!--Code for menu starts here-->
		<p class="menu_head" ><?php echo anchor(site_url('home'),img(array('src'=>'images/icon/home.png','border'=>'0','alt'=>'')).' Halaman Utama',''); ?></p>
		<p class="menu_head"><?php echo img(array('src'=>'images/icon/dir.png','border'=>'0','alt'=>''))?>Surat Masuk</p>
		<div class="menu_body" align="left">
			<?php if($catat_surat_masuk) echo anchor(site_url('daftar_ijin_kerma'),img(array('src'=>'images/icon/doc.png','border'=>'0','alt'=>'')).' Catat Surat Masuk',''); ?>
			<?php if($surat_masuk) echo anchor(site_url('permohonan/daftar_permohonan'),img(array('src'=>'images/icon/doc.png','border'=>'0','alt'=>'')).' Daftar Surat Masuk',''); ?>
		</div>
		
		<?php if ($master_data) { ?><p class="menu_head"><?php echo img(array('src'=>'images/icon/dir.png','border'=>'0','alt'=>''))?> Master Data</p>
		<div class="menu_body" align="left">
			<?php echo anchor(site_url('master_data/jenis_surat'),img(array('src'=>'images/icon/doc.png','border'=>'0','alt'=>'')).' Jenis Surat',''); ?>
			<?php echo anchor(site_url('master_data/dinas'),img(array('src'=>'images/icon/doc.png','border'=>'0','alt'=>'')).' Dinas',''); ?>
			<?php echo anchor(site_url('master_data/instansi'),img(array('src'=>'images/icon/doc.png','border'=>'0','alt'=>'')).' Instansi',''); ?>
			<?php echo anchor(site_url('master_data/jabatan'),img(array('src'=>'images/icon/doc.png','border'=>'0','alt'=>'')).' Jabatan',''); ?>
		</div><?php } ?>
		<p class="menu_head"><?php echo img(array('src'=>'images/icon/dir.png','border'=>'0','alt'=>''))?> User Menu</p>
		<div class="menu_body" align="left">
		  <?php if ($manajemen_pengguna) { ?><?php echo anchor(site_url('manajemen_pengguna'),img(array('src'=>'images/icon/doc.png','border'=>'0','alt'=>'')).' Manajemen Pengguna',''); ?><?php } ?>
          <?php echo anchor(site_url('login/log_out'),img(array('src'=>'images/icon/lock.png','border'=>'0','alt'=>'')).' Logout',''); ?>
		</div>
	  
  </div>  <!--Code for menu ends here-->
</div>
