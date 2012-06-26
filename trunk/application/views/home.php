<?php
	$master_dinas = false;
	$master_instansi = false;
	$master_jenis_surat = false;
	$master_jabatan = false;
	$manajemen_pengguna = false;
	$surat_masuk = false;
	$catat_surat_masuk = false;
	$surat_masuk_disposisi = false;

	$this->load->library('session');
	$kode_role = $this->session->userdata('kode_role');
	if($kode_role == 1)
	{	
		$master_dinas = true;
		$master_instansi = true;
		$master_jenis_surat = true;
		$master_jabatan = true;
		$manajemen_pengguna = true;
		$surat_masuk = true;
		$catat_surat_masuk = true;
	}
	else
	{
		$master_dinas = false;
		$master_instansi = false;
		$master_jenis_surat = false;
		$master_jabatan = false;
		$manajemen_pengguna = false;
		$surat_masuk = true;
		$catat_surat_masuk = false;
		if($kode_role == 7 ) 
			$surat_masuk_disposisi = false;
		else
			$surat_masuk_disposisi = true;
	}


?>

<div class="border_content">
	<div class="title" align="center">Selamat Datang</div>
	<div class="inner_content">
		<fieldset>
		<legend><label><b>| Informasi umum aplikasi |</b></label></legend>
			<table width="100%" cellpadding="10">
			<tr>
				<td>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitationLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation 
				</td>
			</tr>
		</table>
		</fieldset>
		<fieldset>
		<legend><label><b>| Menu yang bisa diakses |</b></label></legend>
			<table width="100%" cellpadding="20">
			<tr>
				<td></td>
				<?php if($catat_surat_masuk){?><td width="auto"><div align="center"><?php echo anchor(site_url('surat_masuk/add'),img(array('src'=>'images/icon/catat_surat_masuk.png','border'=>'0','alt'=>'')).'<b>Catat Surat Masuk</b>',''); ?></td><?php } ?>
				<?php if($surat_masuk){?><td width="auto"><div align="center"><?php echo anchor(site_url('surat_masuk'),img(array('src'=>'images/icon/inbox.png','border'=>'0','alt'=>'')).'<b>Daftar Surat Masuk</b>',''); ?></td><?php } ?>
				<?php if($surat_masuk_disposisi){?><td width="auto"><div align="center"><?php echo anchor(site_url('surat_masuk/grid_surat_disposisi'),img(array('src'=>'images/icon/email_icon.png','border'=>'0','alt'=>'')).'<b>Daftar Surat Masuk Disposisi</b>',''); ?></td><?php } ?>
				<td></td>
			</tr>
			<tr>
				<?php if($master_dinas){?><td width="25%"><div align="center"><?php echo anchor(site_url('dinas'),img(array('src'=>'images/icon/master_dinas.png','border'=>'0','alt'=>'')).'<b>Master Dinas</b>',''); ?></td><?php } ?>
				<?php if($master_instansi){?><td width="25%"><div align="center"><?php echo anchor(site_url('instansi'),img(array('src'=>'images/icon/master_instansi.png','border'=>'0','alt'=>'')).'<b>Master Instansi</b>',''); ?></td><?php } ?>
				<?php if($master_jenis_surat){?><td width="25%"><div align="center"><?php echo anchor(site_url('jenis_surat'),img(array('src'=>'images/icon/master_jenis_surat.png','border'=>'0','alt'=>'')).'<b>Master Jenis Surat</b>',''); ?></td><?php } ?>
				<?php if($master_jabatan){?><td width="25%"><div align="center"><?php echo anchor(site_url('jabatan'),img(array('src'=>'images/icon/master_jabatan.png','border'=>'0','alt'=>'')).'<b>Master Jabatan</b>',''); ?></td><?php } ?>
				<?php if($manajemen_pengguna){?><td width="25%"><div align="center"><?php echo anchor(site_url('manajemen_pengguna'),img(array('src'=>'images/icon/manajemen_pengguna.png','border'=>'0','alt'=>'')).'<b>Manajemen Pengguna</b>',''); ?></td><?php } ?>
			</tr>
			</table>
		</fieldset>
	</div>
</div>
